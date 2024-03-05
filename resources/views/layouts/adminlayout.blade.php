<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job-Application</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <style>
      a{
        text-decoration: none;
      }

      
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand col-lg-3 me-0" href="{{route('adminDashboard')}}">JOB-APP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
    
                <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('skillPageLoad')}}">Add Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" ></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="{{route('QApageLoad')}}"> Add Q/A</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-disabled="true"  href="{{route('examPageLoad')}}"> Add Exam</a>
                    </li>
                  
                </ul>
    
                <div class="col-lg-3 text-lg-end">
                    <span class="me-2">Akash Kumar</span>
                    <a href="/logout" class="btn btn-danger">LOGOUT</a>
                </div>
    
            </div>
        </div>
    </nav>
    
    @yield('admin-space-work')
    

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
   
</body>
</html>