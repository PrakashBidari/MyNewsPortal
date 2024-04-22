<?php

namespace App\Services;


use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Imagick\Driver;



class ImageService
{
    public function addImages($model, $images = [], $directory)
    {
        $directory = preg_replace('/[^A-Za-z0-9\-]/', '', $directory);
        $this->saveImages($model, $images, '/images/' . $directory);
        return;
    }

    private function saveImages($model, $images, $directory)
    {
        if (!empty($images)) {
            $imageArr = [];
            $this->makeDirectory($directory);
            foreach ($images as $image) {
                $imageNames = $this->makeName($image['image']);
                $this->moveImage($image['image'], $directory, $imageNames['saveName']);

                //                // store image details as array
                $image_instance = new Image();

                $image_instance->image_type = $model;
                $image_instance->image_id = $model->image();
                $image_instance->saved_name = $imageNames['saveName'];
                $image_instance->original_name = $imageNames['originalName'];
                $image_instance->url = $directory;
                $imageArr[] = $image_instance;
            }



            $model->image()->saveMany($imageArr);
        }
        return;
    }
    public function moveImage($image, $directory, $saveName)
    {
        try{
            Storage::disk('local')->put($directory . '/' . $saveName, file_get_contents($image), [
                'visibility' => 'public'
            ]);
            $manager = new ImageManager(new Driver());
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image = $manager->read($image);
            $image = $image->resize(200, 200);
            dd($image);
            // $destinationPathThumbnail = storage_path('app/images/category/thumbnail/');
            $destinationPathThumbnail = storage_path('app' . $directory . '/thumbnail');
            $image->save($destinationPathThumbnail . $imageName);
        }catch(\Exception $e){

            dd($e);

        }
    }

    private function makeDirectory($path)
    {
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        return;
    }
    public function makeName($image)
    {
        $originalName = Str::replace(' ', '-', trim($image->getClientOriginalName()));
        $NameWithoutExtension = Str::limit(pathinfo($originalName, PATHINFO_FILENAME), 200);
        $saveName = time() . '-' . $NameWithoutExtension . '.' . $image->getClientOriginalExtension();

        return [
            'saveName' => $saveName,
            'originalName' => $originalName,
        ];
    }

    public function updateImages($model, $images = [], $directory, $deleteImage = false)
    {
        if ($deleteImage) {
            $this->deleteAllImages($model);
        }

        $this->saveImages($model, $images, '/images/' . $directory);
        return;
    }

    public function deleteAllImages($service)
    {
        // $images = $service
        //     ->image()
        //     ->selectRaw("*,CONCAT(url,'/',saved_name) AS url")
        //     ->get();

        $images = $service
            ->image()
            ->selectRaw("*, CONCAT(url,'/',saved_name) AS original_url, CONCAT(url,'/thumbnail/',saved_name) AS thumbnail_url")
            ->get();


        $originalUrls = $images->pluck('original_url')->toArray();
        $thumbnailUrls = $images->pluck('thumbnail_url')->toArray();

        foreach ($images as $image) {
            $image->delete();
        }

        Storage::delete(array_merge($originalUrls, $thumbnailUrls));

        // Storage::delete($images->pluck('url')->toArray());

        return;
    }

    public  function delete($image)
    {
        // dd($image);
        $imagePaths = [
            $image->url . '/' . $image->saved_name,
            $image->url . '/thumbnail/' . $image->saved_name,
        ];

        // Delete images
        Storage::delete($imagePaths);

        try {
            $image->delete();
        } catch (\Exception $e) {
            // \Log::error('Error deleting product:' . $e->getMessage());
            throw $e;
        }
    }
}
