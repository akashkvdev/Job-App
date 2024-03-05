@extends('layouts/adminlayout')

@section('admin-space-work')



<div class="container mt-5">
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="{{route('skillPageLoad')}}">
                <div class="card">
                    <div class="card-header text-center bg-transparent">
                        <img src="https://media.mktg.workday.com/is/image/workday/illustration-shape-scene-man-walk-graph-FoW-1?fmt=png-alpha&wid=1000" alt="" class="img-fluid"  width="200px">
                    </div>
                    <div class="card-body">
                        <h4 class="text-center">Add Skills</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
           <a href="{{route('QApageLoad')}}">
            <div class="card">
                <div class="card-header text-center">
                    <img src="https://resumegenius.com/wp-content/uploads/interview-questions-answers-500x333.png" class="img-fluid" alt=""  width="200px">
                </div>
                <div class="card-body">
                    <h4 class="text-center">Add Q/A</h4>
                </div>
            </div>
           </a>
        </div>
        <div class="col-md-3 mb-3">
          <a href="{{route('examPageLoad')}}">
            <div class="card">
                <div class="card-header text-center">
                    <img src="https://img.freepik.com/premium-vector/web-development-programming-languages-css-html-it-ui-programmer-cartoon-character-developing-website-coding-flat-illustration-banner_128772-862.jpg" alt="" class="img-fluid"  width="200px">
                </div>
                <div class="card-body">
                    <h4 class="text-center">Add Exam</h4>
                </div>
            </div>
          </a>
        </div>
    </div>
  </div>
  

@endsection