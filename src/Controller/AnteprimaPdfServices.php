<?php

namespace Controller;

use Imagick;

/**
 * Classe AnteprimaPdfServices
 * Gestisce la creazione dell'anteprima di un file PDF
 * restituendo l'anteprima in formato JPEG, utilizzando la libreria Imagick
 */
class AnteprimaPdfServices {

    public function generaAnteprima(string $pdfBlob): array {

        // 1) crea file temporaneo PDF
        $tempPdf = tempnam(sys_get_temp_dir(), 'pdf_');
        file_put_contents($tempPdf, $pdfBlob);

        // 2) crea oggetto Imagick
        $imagick = new Imagick();
        $imagick->setResolution(100, 100);
        $imagick->readImage($tempPdf . "[0]");
        $imagick->setImageFormat("jpeg");
        $imagick->setImageCompressionQuality(65);

        // 3) crea file temporaneo JPEG
        $tempJpg = tempnam(sys_get_temp_dir(), 'preview_');
        rename($tempJpg, $tempJpg .= ".jpg");
        $imagick->writeImage($tempJpg);

        // 4) leggi contenuto JPEG
        $contenuto = file_get_contents($tempJpg);

        // 5) pulisce e rimuove file temporanei
        $imagick->clear();
        $imagick->destroy();
        unlink($tempPdf);
        unlink($tempJpg);

        return [
            "contenuto" => base_64_encode($contenuto),
            "mimeType"  => "image/jpeg"
        ];
    }
    
}
