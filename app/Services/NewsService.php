<?php

namespace App\Services;

use Exception;
use App\Models\News;
use App\Services\ImageService;


class NewsService{

    private $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }


    public function index(){
        try{
            $allNews =  News::latest();
            return $allNews;
        }catch(\Exception $e){
            // \Log::error('Error fetching messages:', $e->getMessage());
            throw $e;
        }
    }

    public function add($data){
        // dd($data);
        try{
            $news = News::create($data);

            if (isset($data['image'])) {
                $images[0]['image'] =  $data['image'];
                $this->imageService->addImages($news, $images, 'news');
            }

            return $news;
        }catch(Exception $e){
            throw $e;
        }
    }


    public function update($validated_data, $news)
    {
        $images = [];

        try {
            $news->update($validated_data);


            if (isset($validated_data['image'])) {
                $images[0]['image'] =  $validated_data['image'];
                if ($news->image) {
                    $this->imageService->updateImages($news, $images, 'news', true);
                } else {
                    $this->imageService->addImages($news, $images, 'news');
                }
            }
            return back();
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function destroy($news){
        $news->delete();
        $this->imageService->delete($news->image);
    }

}
