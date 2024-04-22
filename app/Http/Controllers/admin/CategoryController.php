<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AddCategoryRequest;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index(Request $request)
    {
        try {
            if ($request->expectsJson()) {
                try {
                    $categories = $this->categoryService->index();
                    return DataTables::of($categories)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                            // $deleteUrl = route('categories.destroy', ['category' => $row]);
                            $updateUrl = route('categories.edit', ['category' => $row]);
                            return '
                            <div class="btn-group" role="group">
                                <a href="' . $updateUrl . '" class="btn btn-info btn-sm mr-2 editButton me-2">
                                <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger delButton btn-sm" data-slug="' . $row->slug . '"><i class="bi bi-trash-fill"></i></a>
                            </div>
                    ';
                        })
                        ->editColumn('parent_id', function ($category) {
                            return $category->parent ? $category->parent->name : '-';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } catch (\Exception $e) {
                    // \Log::error('Error deleting product:' . $e->getMessage());
                    throw $e;
                }
            }

            return view('backend.category.index');
        } catch (\Throwable $th) {
            toastify()->error($th);
        }
    }


    public function create(){
        try{
            $categories = Category::select('id', 'name', 'parent_id')
                ->orderBy('name')
                ->get();
            return view("backend.category.create", compact("categories"));
        }catch(\Throwable $th){
            toastify()->error($th);
            return;
        }
    }

    public function store(AddCategoryRequest $request){
        try {
            $validated_data = $request->validated();
            $this->categoryService->add($validated_data);

            toastify()->success('Category Added Successful!');
            return back()->with('success', 'Category Added');
        } catch (\Throwable $th) {
            // dd($th);
            toastify()->error($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($slug){
        try{
            $category = Category::where('slug', $slug)->first();
            $categories = Category::select('id', 'name', 'parent_id')
                ->orderBy('name')
                ->get();
            return view("backend.category.edit", compact("category","categories"));
        }catch(\Throwable $th){
            toastify()->error($th);
            return;
        }
    }

    public function update(AddCategoryRequest $request, Category $category)
    {
        // dd($request);
        try {
            $this->categoryService->update($request->validated(), $category);
            toastify()->success('Category successfully updated');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            toastify()->error($th->getMessage());
            return back();
        }
    }





    public function destroy(Category $category){
       try{
        $this->categoryService->destroy($category);
        return response()->json([
            'success' => 'Product Deleted Successfully'
        ], 201);
       }catch (\Throwable $e) {
        // toastify()->error($e);
        return response()->json([
            'success' =>'Something Went Wrong'
        ], 201);
       }
    }


}
