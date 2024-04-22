@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Add Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vertical Form</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('categories.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" oninput="generateSlug()" placeholder="Category Name">
                            </div>

                            <div class="col-12">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug"name="slug"
                                    value="{{ old('slug') }}" placeholder="Slug">
                            </div>

                            <div class="col-md-12">
                                <label for="slug" class="form-label">Parent Category</label>
                                <select id="inputState" class="form-select" name="parent_id" value="{{ old('parent_id') }}">
                                    <option value="" selected="">Choose...</option>
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id == null)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('customjs')

@endsection
