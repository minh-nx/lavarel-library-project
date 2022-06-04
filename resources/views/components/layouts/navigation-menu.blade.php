<nav id="nav-bar">
    <ul>
        <li>
            <a class="nav-link" href="{{ route('home') }}" {!! $checkSelected('Home') !!}>Home</a>
        </li>
        @can('access admin pages')
            <li>
                <a class="nav-link" href="{{ route('admin.dashboard') }}" {!! $checkSelected('Admin') !!}>Admin</a>
            </li>
        @endcan
        <li>
            <a class="nav-link" href="{{ route('dashboard') }}" {!! $checkSelected('User') !!}>User</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('books.intro') }}" {!! $checkSelected('Book') !!}>Book</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('about-us') }}" {!! $checkSelected('About') !!}>About</a>
        </li>
    </ul>
</nav>