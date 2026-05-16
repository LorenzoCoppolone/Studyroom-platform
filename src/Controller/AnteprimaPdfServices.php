<?php

namespace Controller;


use Spatie\PdfToImage\Pdf;
class AnteprimaPdfServices {
    
/**
 * Genera l'anteprima del pdf e la restituisce in base64
 * @param string $pdfBlob il blob del pdf
 * @return array l'anteprima in base64 più il mime type
 */
public function generaAnteprima(string $pdfBlob): array {
    $tempPdf = null;
    $tempJpg = null;
    try {

    //salva il PDF nella cartella temporanea
    $tempPdf = tempnam(sys_get_temp_dir(), 'pdf_');
    file_put_contents($tempPdf, $pdfBlob);

    //creazione di una cartella temporanea, e salvataggio dell'anteprima del pdf in questa cartella (salvata come jpg)
    $tempJpg = tempnam(sys_get_temp_dir(), 'preview_') . ".jpg";
    $pdf = new Pdf($tempPdf);
    $pdf->setPage(1)->setOutputFormat('jpg')->setResolution(60)->saveImage($tempJpg);

    //lettura del contenuto del file jpg
    $contenuto = file_get_contents($tempJpg);

        //ritorno l'anteprima in base64 il contenuto così che la view possa gestirlo
        return [
            "contenuto" => base64_encode($contenuto),
            "mimeType"  => "image/jpeg"
        ];
    }

    // pulizia cartelle temporanee
    finally {
        if (file_exists($tempPdf)) unlink($tempPdf);
        if (file_exists($tempJpg)) unlink($tempJpg);
    }
}
}