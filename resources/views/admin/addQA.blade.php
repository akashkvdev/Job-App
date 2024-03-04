@extends('layouts/adminlayout')

@section('admin-space-work')
<div class="mt-3">
    <a href="javascript:history.back()" class="mt-3 ms-4 fs-5">BACK</a>
</div>

<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Q/A</h5>
            <button class="btn btn-light fw-bolder" data-bs-toggle="modal" data-bs-target="#addQAModel">ADD QUESTIONS</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th scope="col">SL.no</th>
                            <th scope="col">Questions</th>
                            <th scope="col">Options</th>
                            <th scope="col">Correct Option</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if (count($questions) >0)
                            @foreach ($questions as $q)
                            <tr>
                                <th scope="row">{{$q->question_id}}</th>
                                <td scope="row">{{$q->question_text}}</td>
                                <td scope="row"><span class="text-danger fw-bolder">Option1</span>: {{$q->option_1}} <br> <span class="text-danger fw-bolder">Option2</span>: {{$q->option_2}} <br> <span class="text-danger fw-bolder">Option3</span>: {{$q->option_3}} <br><span class="text-danger fw-bolder">Option4</span>: {{$q->option_4}} <br><span class="text-danger fw-bolder">Option1</span>: {{$q->option_1}}</td>

                                <td  scope="row">{{$q->correct_option}}</td>
                                
                                {{-- <td>
                                    <button class="btn btn-sm btn-primary editButton"  data-bs-toggle="modal" data-bs-target="#EditModalLabel" style="cursor:pointer" data-id="{{$sub->tech_skill_id}}" data-skill_name="{{$sub->skill_name}}">Edit</button>
    
                                    <button class="btn btn-sm btn-danger deleteButton"  data-bs-toggle="modal" data-bs-target="#DeleteModalLabel" style="cursor:pointer" data-id="{{$sub->tech_skill_id}}" data-skill_name="{{$sub->skill_name}}">Delete</button>
                                    
                                </td> --}}
                            </tr>
    
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">Skills Not Found !</td>
                            </tr>
                        @endif
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>


<!-- Add QA Modal -->
<div class="modal fade" id="addQAModel" tabindex="-1" aria-labelledby="addQAModalLabel" aria-hidden="true">
    <form id="addQuestions">
     @csrf
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-info text-white">
                 <h5 class="modal-title" id="addQAModalLabel">Add Qyestions And Answers</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <select name="exam_id" id="exam_id" class="form-select mb-3 fw-bolder">
                    <option selected  disabled>Select Exam</option>
                    <option value="1">Angular Exam</option>
                    <option value="2">Python Exam</option>
                    <option value="3">Javascript Exam</option>
                    <option value="4">SQl Exam</option>
                </select>
                <input type="text" name="question_text" id="question_text" class="form-control fw-bolder" placeholder="Write Here Question...">
                <div class="mt-2 text-end">
                    <button class="btn btn-warning text-dark fw-bolder" id="addOptionsbtn">ADD Options</button>
                </div>
                <div class="mt-2 mb-3">
                    <div class="input-group mb-3">
                       
                        <input type="text" class="form-control fw-bolder" placeholder="Enter Options1" aria-label="Username" aria-describedby="basic-addon1" name="option" id="options">
                        <span class="input-group-text fw-bolder bg-danger text-white" id="basic-addon1" style="cursor: pointer">REMOVE</span>
                      </div>
                   
                </div>
             </div>
             
                <div class="px-3 mb-3">
                    <input type="text" class="form-control fw-bolder" name="correct_option" id="correct_option" placeholder="Enter Correct Answer">
                </div>
            
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-info text-white fw-bolder" id="submitQA">Save Skill</button>
             </div>
         </div>
     </div>
    </form>
 </div>




 <script>
    $(document).ready(function () {
        var maxOptions = 4;
        var minOptions = 2;

        // Add Options button click event
        $('#addOptionsbtn').click(function (e) {
            e.preventDefault();
            var optionCount = $('.modal-body input[name="option"]').length;

            // Check the maximum limit
            if (optionCount < maxOptions) {
                // Clone the input group and reset its value
                var newOptionGroup = $('.modal-body .input-group').first().clone();
                newOptionGroup.find('input').val('').attr('placeholder', 'Enter Options' + (optionCount + 1));
                newOptionGroup.find('.input-group-text').text('REMOVE');
                
                // Add line break before the new option group
                $('.modal-body').append('<br>'); 
                $('.modal-body').append(newOptionGroup);
            } else {
                alert('Maximum limit of options reached (4)');
            }
        });

        // Remove Option button click event
        $('.modal-body').on('click', '.input-group-text', function () {
            var optionCount = $('.modal-body input[name="option"]').length;

            // Check if the number of options is greater than the minimum required
            if (optionCount > minOptions) {
                $(this).closest('.input-group').remove();
            } else {
                alert('Minimum limit of options reached (' + minOptions + ')');
            }
        });

        // Save Skill button click event with AJAX
        $('#submitQA').click(function (e) {
         e.preventDefault(); // Prevent form submission

    // Collect all skill data
    var question_text = $('#question_text').val();
    var options = [];

    $('input[name="option"]').each(function () {
        options.push($(this).val());
    });

    var correctOption = $('#correct_option').val();
    var examId = $('#exam_id').val();

    // Validate the minimum number of options
    if (options.length >= minOptions) {
        // Send data to the backend using AJAX
        $.ajax({
            type: 'POST',
            url: "{{ route('addQuesAns') }}", // Replace with your actual backend endpoint
            data: JSON.stringify({
                _token: $('input[name="_token"]').val(), // CSRF token
                question_text: question_text,
                options: options,
                correct_option: correctOption,
                exam_id: examId
            }),
            contentType: 'application/json', // Set the content type
            success: function (response) {
                // Handle success response from the server
                console.log('Success:', response);
            },
            error: function (error) {
                // Handle error response from the server
                console.log('Error:', error);
            }
        });
    } else {
        alert('Please enter at least ' + minOptions + ' options.');
    }
});
    });
</script>




>




@endsection