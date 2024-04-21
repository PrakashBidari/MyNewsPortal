<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
                        ->rawColumns(['action'])
                        ->make(true);
                } catch (\Exception $e) {
                    // \Log::error('Error deleting product:' . $e->getMessage());
                    throw $e;
                }
            }

            return view('backend.category.index');
        } catch (\Throwable $th) {
        }
    }

    public function destroy(Category $category){
       try{
        $category->delete();
        return response()->json([
            'success' => 'Product Deleted Successfully'
        ], 201);
       }catch (\Throwable $e) {

       }
    }


}
