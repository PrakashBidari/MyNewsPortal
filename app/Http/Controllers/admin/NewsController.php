<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;
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
                        ->rawColumns(['action','image'])
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
