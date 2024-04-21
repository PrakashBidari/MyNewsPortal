@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Category List</h5>
                            <!-- Table with stripped rows -->
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-container">
                                    <table class="table mt-5  user-table  w-100 "
                                        style=" border-collapse: separate;  border-spacing: 0 10px;" id="testimonies-table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                {{-- <th>Image</th> --}}
                                                <th>Name</th>
                                                <th>Parent Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            console.log("checking");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#testimonies-table').DataTable({
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ordering": false,
                searchDelay: 3000,
                "ajax": {
                    url: "{{ route('categories.index') }}",
                    type: 'GET',
                    dataType: 'JSON'
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    // {
                    //     data: 'image',
                    //     name: 'image',
                    // },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'parent_id',
                        name: 'parent_id',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }

                ],

                "lengthMenu": [
                    [5, 10, 20, 50, -1],
                    [5, 10, 20, 50, "All"]
                ],
                "pagingType": "simple_numbers"

            });





            // ================DELETE BLOG==============================//
            $('body').on('click', '.delButton', function() {
                let slug = $(this).data('slug');
                let url = '{{ url('admin/categories', '') }}' + '/' + slug;

                if (confirm('Are you sure you want to delete it')) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            // refresh the table after delete
                            table.draw();
                            // display the delete success message
                            // toastify().success(response.success);

                            Toastify({
                                text: response.success,
                                offset: {
                                    x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                    y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                                },
                            }).showToast();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });

        });
        // =====================================================================//
    </script>
@endsection
