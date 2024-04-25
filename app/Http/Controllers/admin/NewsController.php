<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddNewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{

    protected $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->expectsJson()) {
                try {
                    $allNews = $this->newsService->index();
                    return DataTables::of($allNews)
                        ->addIndexColumn()
                        ->addColumn('image', function ($row) {
                            if ($latestImage = $row->image) {
                                $imageUrl = Storage::url($latestImage->url . '/' . $latestImage->saved_name);
                                return '<img src="' . $imageUrl . '" style="height: 50px;width:50px;" alt="">';
                            }
                        })
                        ->addColumn('action', function ($row) {
                            // $deleteUrl = route('categories.destroy', ['category' => $row]);
                            $updateUrl = route('news.edit', ['news' => $row]);
                            return '
                            <div class="btn-group" role="group">
                                <a href="' . $updateUrl . '" class="btn btn-info btn-sm mr-2 editButton me-2">
                                <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger delButton btn-sm" data-slug="' . $row->slug . '"><i class="bi bi-trash-fill"></i></a>
                            </div>
                    ';
                        })
                        ->editColumn('category', function ($news) {
                            return Category::find($news->category)->name;
                        })
                        ->rawColumns(['action','image'])
                        ->make(true);
                } catch (\Exception $e) {
                    // \Log::error('Error deleting product:' . $e->getMessage());
                    throw $e;
                }
            }

            return view('backend.news.index');
        } catch (\Throwable $th) {
            toastify()->error($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $categories = Category::select('id', 'name')
                ->orderBy('name')
                ->get();
            return view("backend.news.create", compact("categories"));
        }catch(\Throwable $th){
            toastify()->error($th);
            return;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewsRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $this->newsService->add($validated_data);
            toastify()->success('News Added Successful!');
            return back()->with('success', 'News Added');
        } catch (\Throwable $th) {
            // dd($th);
            toastify()->error($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try{
            $this->newsService->destroy($news);
            return response()->json([
                'success' => 'News Deleted Successfully'
            ], 201);
           }catch (\Throwable $e) {
            // toastify()->error($e);
            return response()->json([
                'success' =>'Something Went Wrong'
            ], 201);
           }
    }
}
