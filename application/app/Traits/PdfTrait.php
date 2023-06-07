<?php

namespace App\Traits;

use PDF;

trait PdfTrait
{
    public static function loadPdfFromView(string $view_name, array $data)
    {
        return PDF::loadView($view_name, $data);//->setPaper('a4', 'portrait');
    }
}
