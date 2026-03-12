<?php

namespace App\Utils;

use Illuminate\Support\Str;



class ImageManger
{
    public static function uploadImages($request, $post)
    {
        if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $fileName = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('uploads/posts', $fileName, ['disk' => 'uploads']);

                    $post->images()->create([
                        'path' => $path,
                    ]);
                }
            }
    }
}