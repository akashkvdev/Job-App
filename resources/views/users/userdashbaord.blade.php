@extends('layouts/userslayout')

@section('space-work')

<div class="container mt-5">
    <div class="row">
        @foreach($exams as $exam)
            <div class="col-md-3 mb-3">
                <a href="{{ route('SkillExam', ['id' => $exam->exam_id]) }}">
                    <div class="card" style="height: 300px; overflow: hidden;">
                        <div class="card-header text-center bg-transparent">
                            <img src="{{ asset('storage/exam_images/' . $exam->examImage) }}" alt="" class="img-fluid" style="object-fit: cover; height: 100%;" width="200px">
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">{{ $exam->exam_name }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>






 


@endsection