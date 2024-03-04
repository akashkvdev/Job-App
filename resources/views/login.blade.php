@extends('layouts/userslayout')

@section('space-work')

@if ($errors->any())
    @foreach ($errors->all() as $err)
    <div class="text-center">
        <span class="fw-bolder text-danger">{{$err}}</span>
    </div>
        
    @endforeach
@endif

<div class="container">
    @if (Session::has('error'))
    <div class="text-center">
        <span class="fw-bolder text-danger">{{Session::get('error')}}</span>
    </div>

    
@endif
    
    <div class="card shadow-lg mx-auto" style="max-width: 400px; margin-top: 10%;">
        <div class="card-header bg-info text-white">
            <h4 class="text-center">Login Here</h4>
        </div>
        <div class="card-body">
            <form action="{{route('userLogin')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter your password" required>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-info fw-bolder text-white fs-5"  name="submit" type="submit">LOGIN</button>
                    <div class="text-end mt-2">
                        <span class="">
                            <a href="" class="fw-bolder ">Dont Have An Account</a>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection