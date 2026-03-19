<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



class ImageManger
{
    public static function uploadImages($request, $post = null, $user = null)
    {
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $fileName = self::generateImageName($image);
                $path = self::storeImageLocal($image, 'posts', $fileName);

                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            if(File::exists(public_path($user->image)))
            {
                File::delete(public_path($user->image));
            }

            $fileName = self::generateImageName($image);
            $path = self::storeImageLocal($image, 'users', $fileName);

            $user->update(['image'=>$path]);
        }

    }

    public static function deleteImages($post)
    {
        if ($post->images()->count() > 0) {
            foreach ($post->images() as $image) {
                if (File::exists(public_path($image->path))) {
                    File::delete(public_path($image->path));
                }
            }
        }
    }

    private static function generateImageName($image)
    {
        $fileName = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $fileName;
    }

    private static function storeImageLocal($image, $path, $fileName)
    {
        $path = $image->storeAs('uploads/'.$path, $fileName, ['disk' => 'uploads']);
        return $path;
    }

}
