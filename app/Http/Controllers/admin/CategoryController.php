<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Service\CategoryService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index(){
        try{
            return view("backend.category.index");
        }catch(\Throwable $th){

        }
    }
}
