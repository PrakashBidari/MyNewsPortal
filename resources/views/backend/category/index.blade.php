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
                                    <table class="table datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th data-sortable="true" style="width: 5.625717566016074%;"><a
                                                        href="#" class="datatable-sorter">#</a></th>
                                                <th data-sortable="true" style="width: 28.013777267508612%;"><a
                                                        href="#" class="datatable-sorter">Name</a></th>
                                                <th data-sortable="true" style="width: 37.772675086107924%;"><a
                                                        href="#" class="datatable-sorter">Position</a></th>
                                                <th data-sortable="true" style="width: 9.299655568312284%;"><a
                                                        href="#" class="datatable-sorter">Age</a></th>
                                                <th data-sortable="true" style="width: 19.288174512055107%;"><a
                                                        href="#" class="datatable-sorter">Start Date</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-index="0">
                                                <td>1</td>
                                                <td>Brandon Jacob</td>
                                                <td>Designer</td>
                                                <td>28</td>
                                                <td>2016-05-25</td>
                                            </tr>
                                            <tr data-index="1">
                                                <td>2</td>
                                                <td>Bridie Kessler</td>
                                                <td>Developer</td>
                                                <td>35</td>
                                                <td>2014-12-05</td>
                                            </tr>
                                            <tr data-index="2">
                                                <td>3</td>
                                                <td>Ashleigh Langosh</td>
                                                <td>Finance</td>
                                                <td>45</td>
                                                <td>2011-08-12</td>
                                            </tr>
                                            <tr data-index="3">
                                                <td>4</td>
                                                <td>Angus Grady</td>
                                                <td>HR</td>
                                                <td>34</td>
                                                <td>2012-06-11</td>
                                            </tr>
                                            <tr data-index="4">
                                                <td>5</td>
                                                <td>Raheem Lehner</td>
                                                <td>Dynamic Division Officer</td>
                                                <td>47</td>
                                                <td>2011-04-19</td>
                                            </tr>
                                           
                                        </tbody>
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
