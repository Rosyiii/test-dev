<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Post
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item {{ ($tittle === "Home" ) ? 'active' : '' }}" href="/">Daftar Post</a></li>
        <li><a class="dropdown-item {{ ($tittle === "Tambah Post" ) ? 'active' : '' }}" href="/tambah_post">Tambah
                Post</a></li>
    </ul>
</li>

@can('admin')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Post
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item {{ ($tittle === "Home" ) ? 'active' : '' }}" href="/data_user">Data User</a></li>
        <li><a class="dropdown-item {{ ($tittle === "Registrasi" ) ? 'active' : '' }}" href="/registasi">Tambah
                User</a></li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="/registrasi">
        Tambah User
    </a>
</li>
@endcan

<li class="nav-item">
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="dropdown-item btn btn-secondary">Keluar</button>
    </form>
</li>
