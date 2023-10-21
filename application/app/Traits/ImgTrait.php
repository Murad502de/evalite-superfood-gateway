<?php

namespace App\Traits;

trait ImgTrait
{
    public static function imageToBase64(string $full_path)
    {
        $type   = pathinfo($full_path, PATHINFO_EXTENSION);
        $data   = file_get_contents($full_path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
