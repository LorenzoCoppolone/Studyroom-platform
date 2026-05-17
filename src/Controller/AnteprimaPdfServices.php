<?php

namespace Controller;

use RuntimeException;
use InvalidArgumentException;

class AnteprimaPdfServices
{
    private const RESOLUTION   = 150;   // DPI più alti = anteprima nitida
    private const JPEG_QUALITY = 50;
    private const ALLOWED_MIME = 'application/pdf';

    // Larghezza target dell’anteprima (ridotta in modo nitido)
    private const PREVIEW_WIDTH = 600;

    public function __construct()
    {
        if (!extension_loaded('imagick')) {
            throw new RuntimeException('Estensione Imagick non disponibile. Installare php-imagick.');
        }
    }

    public function generaAnteprima(
        string $fileContent,
        string $mimeType = self::ALLOWED_MIME
    ): array {
        $this->validateMimeType($mimeType);

        // Sempre usare file temporaneo: metodo più stabile su Windows
        $tmpPdf = $this->writeTempFile($fileContent, '.pdf');

        try {
            $jpegBlob = $this->pdfToJpeg($tmpPdf);

            return [
                'mimeType'  => 'image/jpeg',
                'contenuto' => base64_encode($jpegBlob),
            ];

        } finally {
            $this->cleanupTempFiles($tmpPdf);
        }
    }

    private function pdfToJpeg(string $pdfPath): string
    {
        try {
            $imagick = new \Imagick();
            $imagick->setResolution(self::RESOLUTION, self::RESOLUTION);

            // Legge solo la prima pagina
            $imagick->readImage($pdfPath . '[0]');
            $imagick->setImageFormat('jpeg');

            // Ridimensionamento nitido (Lanczos)
            $imagick->resizeImage(
                self::PREVIEW_WIDTH,
                0,
                \Imagick::FILTER_LANCZOS,
                1
            );

            // Canvas bianco (metodo stabile)
            $background = new \Imagick();
            $background->newImage(
                $imagick->getImageWidth(),
                $imagick->getImageHeight(),
                new \ImagickPixel('white')
            );
            $background->setImageFormat('jpeg');

            // Composizione
            $background->compositeImage(
                $imagick,
                \Imagick::COMPOSITE_OVER,
                0,
                0
            );

            $background->setImageCompressionQuality(self::JPEG_QUALITY);
            $background->stripImage();

            $blob = $background->getImageBlob();

            $imagick->destroy();
            $background->destroy();

            if (empty($blob)) {
                throw new RuntimeException('Blob JPEG vuoto dopo la conversione.');
            }

            return $blob;

        } catch (\Throwable $e) {
            throw new RuntimeException('Errore durante la conversione PDF a JPEG: ' . $e->getMessage());
        }
    }

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
