<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Upload
{
    public static function UploadFile($image, $path)
    {
        $name = time().'_'.rand(1000, 10000).'.webp';
        $path = $path.'/'.$name;
        if (str_contains($image->getClientMimeType(), 'image')) {
            $name = time().'_'.rand(1000, 10000).'.webp';
            $imgFile = Image::make($image->getRealPath())->encode('webp');
            if(!str_contains($_SERVER['REQUEST_URI'],'settings') && !str_contains($_SERVER['REQUEST_URI'],'images') && !str_contains($_SERVER['REQUEST_URI'],'mail_offer')){
                // $imgFile = $imgFile->fit(2048);
            }
            $imgFile = $imgFile->stream();
        } else {
            $name = time().'_'.rand(1000, 10000).'.'.$image->extension();
            $imgFile = File::get($image);
        }
        Storage::disk('public')->put($path, $imgFile);

        if (tenant()) {
            return '/uploads/tenant'.tenant()->id.'/'.$path;
        } else {
            return '/uploads/Central/'.$path;
        }
    }

    public static function UploadFiles($images, $path)
    {
        $imagesName = [];
        foreach ($images as $image) {
            $imagesName[] = self::UploadFile($image, $path);
        }

        return $imagesName;
    }

    public static function StoreUrlImage($url, $path)
    {
        $name = time().'_'.rand(1000, 10000).'.webp';

        if (tenant()) {
            $path = '/uploads/tenant'.tenant()->id.'/'.$path.'/'.$name;
        } else {
            $path = '/uploads/Central'.$path.'/'.$name;
        }
        $imgFile = Image::make(file_get_contents($url))->encode('webp')->stream();
        Storage::disk('public')->put($path, $imgFile);

        return $path;
    }

    public static function deleteImage($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    public static function deleteImages($paths = [])
    {
        foreach ($paths as $path) {
            self::deleteImage($path);
        }
    }

    public static function CopyFolderFromPublicToTenant($foldername, $destination)
    {
        if (! Storage::exists('public/'.$destination)) {
            Storage::makeDirectory('public/'.$destination, 0777, true, true);
        }
        File::copyDirectory(public_path($foldername), public_path('/uploads/'.$destination));
    }

    public static function DeleteTenantFolder($destination)
    {
        if (Storage::exists('public/'.$destination)) {
            Storage::deleteDirectory('public/'.$destination);
        }
    }
}
