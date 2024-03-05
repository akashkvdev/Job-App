@extends('layouts.userslayout')

@section('space-work')
<div class="mt-3">
    <a href="javascript:history.back()" class="mt-3 ms-4 fs-5">BACK</a>
</div>
    <div class="container mt-3">
        @if (!is_null($questions) && count($questions) > 0)
        <div class="card mx-auto" style="width: 60%; border: none;">
            <div class="card-header bg-transparent" style="border: none;">
                <h4 class="text-center">{{ $exam->exam_name ?? '' }}</h4>
                <div class="text-center text-md-end">
                    <span class="fw-bolder">Date:</span><span class="ms-2">{{ now()->format('d:M:Y') }}</span>
                </div>
            </div>
        </div>
        <div class="card" style="max-height: 400px; overflow-y: auto;">
            <form id="examForm">
                @csrf
                <div class="card-body">
                    {{-- Check if $questions is not null and not empty --}}
                    
                        {{-- Loop through questions and options --}}
                        @foreach ($questions as $question)
                            <div class="mb-3">
                                <p><span>{{ $question->question_id }} . </span> {{ $question->question_text }}</p>
        
                                {{-- Loop through options --}}
                                @for ($i = 1; $i <= 4; $i++)
                                    @if (!is_null($question['option_' . $i]))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $question['option_' . $i] }}" id="option{{ $question->question_id }}_{{ $i }}" data-question="{{ $question->question_id }}">
                                            <label class="form-check-label" for="option{{ $question->question_id }}_{{ $i }}">
                                                {{ $question['option_' . $i] }}
                                            </label>
                                        </div>
                                    @endif
                                @endfor
        
                                <!-- Hidden input for correct answer -->
                                <input type="hidden" id="correct_answer_{{ $question->question_id }}" value="{{ $question->correct_option }}" />
                            </div>
                        @endforeach
                  
                </div>
                <div class="card-footer">
                    <button id="submitBtn" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        @else
        <p class="text-center fw-bolder fs-3 text-danger">Question not found !</p>
    @endif
    </div>

    <script>
        $(document).ready(function () {
            $('#submitBtn').on('click', function (e) {
                e.preventDefault();

                // Initialize score
                var score = 0;

                // Array to store selected options for logging
                var selectedOptions = [];

                // Check if at least one checkbox is selected
                if ($('input[type="checkbox"]:checked').length === 0) {
                    alert('Please select at least one option before submitting.');
                    return;
                }

                // Loop through checked options
                $('input[type="checkbox"]:checked').each(function () {
                    var selectedOption = $(this).val();
                    var questionId = $(this).data('question');
                    var correctOption = $('#correct_answer_' + questionId).val();

                    // Log selected option with question ID and correct option
                    selectedOptions.push({ questionId: questionId, selectedOption: selectedOption, isCorrect: selectedOption == correctOption, correctOption: correctOption });

                    // Check if the selected option is correct and increment score accordingly
                    if (selectedOption == correctOption) {
                        score += 1;
                    }
                });

                // Log selected options to console
                console.log('Selected Options:', selectedOptions);

                // Access total marks from $exam
                var totalMarks = {{ $exam->total_marks ?? 0 }};

                // Display the score
                // console.log('Score:', score);
                // console.log('Total Marks:', totalMarks);
                // alert('Your score: ' + score + ' out of ' + totalMarks);
                sessionStorage.setItem('score', score);
            sessionStorage.setItem('totalMarks', totalMarks);
                
            });
        });
    </script>
@endsection
