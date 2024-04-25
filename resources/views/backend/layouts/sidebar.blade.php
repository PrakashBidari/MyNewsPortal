<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/admin">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('categories.index') }}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("categories.create") }}">
                        <i class="bi bi-circle"></i><span>Add Category</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav -->

        {{-- <li class="nav-heading">Pages</li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('news.index') }}">
                <i class="bi bi-person"></i>
                <span>News</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>

</aside>
