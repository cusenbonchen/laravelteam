<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container">
        <a class="navbar-brand" href="/" data-language="homepage"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" data-language="document"></a>
                </li>
            </ul>
            @if (Session::get('user.last_name') !== null)
            <div class="user">
                <form action="{{ route('auth.logout') }}" method="get">
                    <span>
                        <span data-language="hello" data-id="{{ Session::get('user.id') }}" id="userName"></span>:
                        {{ Session::get('user.last_name')  }}
                    </span>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            @else
                {{ Session::get('user.username') }}
            @endif
                
            </div>
        </div>
    </div>
</nav>