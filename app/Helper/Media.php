<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;

trait Media {

    public function uploads($file, $path)
    {

        if($file) {

            $fileName   = time() . $file->getClientOriginalName();
            File::makeDirectory("images/$path", $mode = 0777, true, true);
            $file->move("images/$path",$file->getClientOriginalName());
            $file_name  = $file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $filePath   ="images/$path" . $file->getClientOriginalName();
            return $file = [
                'fileName' => $file_name,
                'fileType' => $file_type,
                'filePath' => $filePath,
           
            ];
        }
    }

    public function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ( $size > 0 ) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
