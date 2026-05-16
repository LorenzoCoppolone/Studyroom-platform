<?php

namespace Controller;

use Spatie\PdfToImage\Pdf;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use RuntimeException;
use InvalidArgumentException;

class AnteprimaPdfServices
{
    private const RESOLUTION   = 60;
    private const JPEG_QUALITY = 70;
    private const ALLOWED_MIME = 'application/pdf';

    public function __construct()
    {
        if (!extension_loaded('imagick')) {
            throw new RuntimeException('Estensione Imagick non disponibile.');
        }
    }


    /**
     * Genera l'anteprima (prima pagina) di un PDF passato come contenuto binario.
     * @return array{mimeType: string, contenuto: string}
     */
    public function generaAnteprima(
        string $fileContent,
        string $mimeType = self::ALLOWED_MIME
    ): array {
        $this->validateMimeType($mimeType);

        $tmpPdf = $this->writeTempFile($fileContent, '.pdf');
        $tmpPng = sys_get_temp_dir()
            . DIRECTORY_SEPARATOR
            . uniqid('preview_png_', true)
            . '.png';

        try {
            // ── 1. Spatie: PDF → PNG (mantiene alpha) ─────────────
            $pdf = new Pdf($tmpPdf);
            $pdf->setPage(1);
            $pdf->setOutputFormat('png');
            $pdf->setResolution(self::RESOLUTION);
            $pdf->saveImage($tmpPng);

            if (!file_exists($tmpPng)) {
                throw new RuntimeException('Spatie non ha prodotto alcun output.');
            }

            // restituisce un blob JPEG con sfondo bianco
            $jpegBlob = $this->pngToJpeg($tmpPng);

    
            return [
                'mimeType'  => 'image/jpeg',
                'contenuto' => base64_encode($jpegBlob),
            ];

        } catch (PdfDoesNotExist $e) {
            throw new RuntimeException('PDF non trovato da Spatie: ' . $e->getMessage());
        } finally {
            // Pulizia garantita anche in caso di eccezione
            $this->cleanupTempFiles($tmpPdf, $tmpPng);
        }
    }


    /**
     * Genera l'anteprima di più PDF passati come contenuti binari.
     * @param  array<int|string, array{content: string, mimeType?: string}> $materials
     * @return array<int|string, array{mimeType: string, contenuto: string}|array{error: string}>
     */
    public function generaArrayAnteprime(array $materiali): array
    {
        $results = [];

        foreach ($materiali as $key => $material) {
            try {
                $results[$key] = $this->generaAnteprima(
                    $material['content'],
                    $material['mimeType'] ?? self::ALLOWED_MIME
                );
            } catch (\Throwable $e) {
                $results[$key] = [
                    'mimeType'  => null,
                    'contenuto' => null,
                    'error'     => $e->getMessage(),
                ];
            }
        }

        return $results;
    }


    /**
     * Legge un PNG e restituisce un blob JPEG con sfondo bianco, serve in quanto imagick genera sfondo nero.
     * @param  string $pngPath
     * @return string
     */
    private function pngToJpeg(string $pngPath): string
    {
        $imagick = new \Imagick($pngPath);

        // Canvas bianco delle stesse dimensioni del PNG
        $background = new \Imagick();
        $background->newImage(
            $imagick->getImageWidth(),
            $imagick->getImageHeight(),
            new \ImagickPixel('white')
        );
        $background->setImageFormat('jpeg');

        // Compone il PNG (con alpha) sopra il canvas bianco
        $background->compositeImage(
            $imagick,
            \Imagick::COMPOSITE_OVER,
            0,
            0
        );

        $background->setImageCompressionQuality(self::JPEG_QUALITY);
        $background->stripImage(); // rimuove metadati EXIF → blob più leggero

        // Blob in memoria — nessuna scrittura su disco
        $blob = $background->getImageBlob();

        $imagick->destroy();
        $background->destroy();

        return $blob;
    }


    // funzioni private per la gestione dei file temporanei
    private function validateMimeType(string $mimeType): void
    {
        if ($mimeType !== self::ALLOWED_MIME) {
            throw new InvalidArgumentException(
                "MIME type '{$mimeType}' non supportato. Atteso: " . self::ALLOWED_MIME
            );
        }
    }


    private function writeTempFile(string $content, string $extension): string
    {
        $path = sys_get_temp_dir()
            . DIRECTORY_SEPARATOR
            . uniqid('pdf_preview_', true)
            . $extension;

        if (file_put_contents($path, $content) === false) {
            throw new RuntimeException("Impossibile scrivere il file temporaneo: {$path}");
        }

        return $path;
    }

    private function cleanupTempFiles(string ...$paths): void
    {
        foreach ($paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
            }
        }
    }
}