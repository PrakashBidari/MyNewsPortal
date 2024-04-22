<?php

namespace App\Services;

use App\Models\Category;
use App\Services\ImageService;

class CategoryService{

    private $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }



    public function index(){
        try{
            $category =  Category::latest();
            return $category;
        }catch(\Exception $e){
            // \Log::error('Error fetching messages:', $e->getMessage());
            throw $e;
        }
    }

    public function add($data){
        // dd($data);
        try{
            $category = Category::create($data);

            if (isset($data['image'])) {
                $images[0]['image'] =  $data['image'];
                $this->imageService->addImages($category, $images, 'category');
            }

            return $category;
        }catch(\Exception $e){
            throw $e;
        }
    }

}
