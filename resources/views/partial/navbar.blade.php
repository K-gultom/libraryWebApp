<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              @if(Auth::check() && Auth::user()->role == 'user')
                <li class="nav-item">
                  <a class="nav-link" href="/catalog">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/keranjang">Keranjang</a>
                </li>
              @endif

              
              @if(Auth::check() && Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="/user">User</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/add/book">Add Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/add/category">Add Category</a>
                </li>
              @endif
            </ul>
            <div class="d-flex ">
              @if(!Auth::check())
                  <a href="/login" class="btn btn-success mx-2">Login</a>
                  <a href="/register" class="btn btn-warning">Register</a>
              @endif

              @if (Auth::user())
                  <a href="/logout" class="btn btn-warning">Logout</a>
              @endif
            </div>
        </div>
    </div>
</nav>