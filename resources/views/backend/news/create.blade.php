@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Add News</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add News</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('news.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="title" class="form-label">News Title</label>
                                <input type="text" class="form-control" id="name" name="title"
                                    value="{{ old('title') }}" oninput="generateSlug()" placeholder="News Title">
                            </div>

                            <div class="col-12">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug"name="slug"
                                    value="{{ old('slug') }}" placeholder="Slug">
                            </div>

                            <div class="col-12">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author"name="Author"
                                    value="{{ old('author') }}" placeholder="Author Name" readonly>
                            </div>

                            {{-- {{ Auth::user()->name }}" --}}

                            <div class="col-md-12">
                                <label for="category" class="form-label">Category</label>
                                <select id="inputState" class="form-select" name="category" value="{{ old('category') }}">
                                    <option value="" selected="">Choose...</option>
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="ckeditor" cols="30" placeholder="Description Here...." rows="10" name="description">{{ old('description') }}</textarea>
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
<script>
	ClassicEditor
		.create( document.querySelector( '#ckeditor' ) )
		.catch( error => {
			console.error( error );
		} );
</script>
@endsection
