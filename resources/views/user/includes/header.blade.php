<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">Cinema Star</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('films.list') }}">Admin </a>
                </li>
            </ul>
        </div>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search for anything..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>
