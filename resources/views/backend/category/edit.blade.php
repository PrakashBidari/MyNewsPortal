@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Category</h5>

                        <!-- Vertical Form -->
                        <form action="{{ route('categories.update', $category) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $category->name }}" oninput="generateSlug()" placeholder="Category Name">
                            </div>

                            <div class="col-12">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug"name="slug"
                                    value="{{ $category->slug }}" placeholder="Slug">
                            </div>

                            <div class="col-md-12">
                                <label for="slug" class="form-label">Parent Category</label>
                                <select id="inputState" class="form-select" name="parent_id" value="{{ old('parent_id') }}">
                                    <option value="" selected="">Choose...</option>
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category_list)
                                            @if ($category_list->parent_id == null)
                                                <option value="{{ $category_list->id }}"
                                                    {{ $category->parent_id == $category_list->id ? 'selected' : '' }}>
                                                    {{ $category_list->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif

                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="slug" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                        </form><!-- Vertical Form -->


                        <div class="all-images mt-5">
                            <div class="mt-3 position-relative pb-3" style="margin-top:30px;">
                                <label>Current Images:</label>
                                <div class="row">
                                    @if (!empty($category->image) && !is_null($category->image))
                                        <img src="{{ Storage::url($category->image->url . '/' . $category->image->saved_name) }}"
                                            style="height: 150px;width: 150px; border:1px solid #D9D9D9" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection

@section('customjs')
@endsection
