<li class="nav-item {{ request()->is(['home','/']) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item {{ request()->is('*categories') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('categories.index') }}">Category</a>
</li>
<li class="nav-item {{ request()->is('*books') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('books.index') }}">Book</a>
</li>
