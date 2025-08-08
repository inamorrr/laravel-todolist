<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">To-Do List</a>
            <div class="d-flex ms-auto align-items-center">

                @auth
                    <span class="me-2">Hello, {{ Auth::user()->name }}</span>

                    @if (request()->is('home'))
                        <a class="btn btn-outline-primary me-2" href="{{ route('tasks.index') }}">
                            <i class="bi bi-list-check"></i>
                        </a>
                    @endif


                    @if (request()->routeIs('tasks.index'))
                        <a class="btn btn-outline-primary me-2" href="{{ url('home') }}">
                            <i class="bi bi-house-door"></i>
                        </a>
                    @endif

                    <a class="btn btn-primary me-2" href="{{ route('tasks.create') }}">Add Task</a>


                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>


                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>