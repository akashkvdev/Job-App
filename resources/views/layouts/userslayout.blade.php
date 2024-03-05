<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job-Application</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Eleventh navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('userdashboard')}}">JOB-APP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{route('userdashboard')}}">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('makeProfileVisible')}}">ENHANCE WORK PROFILE</a>
              </li>
            </ul>
            <form role="search">
              @if(session()->has('userName'))
                <span>Welcome, {{ session('userName') }}</span>
              @endif
              <a href="/logout" class="btn btn-danger">LOGOUT</a>
            </form>
          </div>
        </div>
      </nav>
    @yield('space-work')

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
   
</body>
</html>