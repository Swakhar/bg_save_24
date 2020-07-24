<?php

namespace App\Helper;

use Intervention\Image\Facades\Image;

class ImageManipulation
{
    public function UploadImage($file, $path)
    {
        $pathh = public_path() . $path;
        $height_arr = [];
        $width_arr = [];
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $name = $filename . '.' . $file->getClientOriginalExtension();
        $dimension = [200, 500];

        list($width, $height, $type, $attr) =  getimagesize($file);
        for ($i = 0; $i < count($dimension); $i++) {
            $maxDim = $dimension[$i];
            $ratio = $width/$height;
            if( $ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim/$ratio;
                $height_arr[] = $new_height;
                $width_arr[] = $new_width;
            } else {
                $new_width = $maxDim*$ratio;
                $new_height = $maxDim;
                $height_arr[] = $new_height;
                $width_arr[] = $new_width;
            }
        }

        $img = Image::make($file);
        $img->backup();

        for ($i = 0; $i < count($dimension); $i++) {
            $new_path = $pathh . ($i == 0 ? 'small/' : 'medium/');
            if (!file_exists($new_path)) {
                mkdir($new_path, 0777, true);
            }
            $img->resize($width_arr[$i], $height_arr[$i]);
//            $img->invert();
            $img->save($new_path.$name);

            $img->reset();

        }
        $img->save($pathh.$name);
        return $name;
    }
}