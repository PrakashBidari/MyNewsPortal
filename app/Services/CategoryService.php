<?php

namespace App\Services;

use App\Models\Category;

class CategoryService{

    public function index(){
        try{
            $category =  Category::latest();
            return $category;
        }catch(\Exception $e){
            // \Log::error('Error fetching messages:', $e->getMessage());
            throw $e;
        }
    }

}
