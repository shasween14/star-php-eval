<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">

    <title>@yield('title', 'News Portal')</title>

    <style>
        body { background-color: var(--bs-tertiary-bg); }
        .article-card { transition: transform .15s ease, box-shadow .15s ease; }
        .article-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1) !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="bg-body border-bottom">
        <div class="container py-3">
            <a class="fs-4 fw-bold text-reset text-decoration-none" href="{{ url('/articles') }}">News Portal</a>
        </div>
    </header>

    <main class="container flex-grow-1 py-4 py-md-5">
        @yield('content')
    </main>

    <footer class="border-top py-3 text-center text-secondary small">
        &copy; {{ date('Y') }} News Portal
    </footer>

    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
</body>
</html>
