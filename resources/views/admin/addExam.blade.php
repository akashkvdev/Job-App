@extends('layouts/adminlayout')

@section('admin-space-work')

<div class="mt-3">
    <a href="javascript:history.back()" class="mt-3 ms-4 fs-5">BACK</a>
</div>

<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Q/A</h5>
            <button class="btn btn-light fw-bolder" data-bs-toggle="modal" data-bs-target="#addExamModel">ADD EXAM</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th scope="col">SL.no</th>
                            <th scope="col">Exam Image</th>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Exam Date</th>
                            <th scope="col">Total Marks</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            @if (count($exam) >0)
                            @foreach ($exam as $sub)
                            <tr>
                                <th scope="row">{{$sub->exam_id}}</th>
                                <th scope="row">
                                    <img src="{{ asset('storage/exam_images/' . $sub->examImage) }}" alt="" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                </th>
                                



                                <th scope="row">{{$sub->exam_name}}</th>
                                <th scope="row">{{$sub->exam_date}}</th>
                                <th scope="row">{{$sub->total_marks}}</th>
                                
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
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>



<!-- Add QA Modal -->
<div class="modal fade" id="addExamModel" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true">
    <form id="addExams" enctype="multipart/form-data">
     @csrf
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-info text-white">
                 <h5 class="modal-title" id="addExamModalLabel">Add Exams Name</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <div class="img-container text-center">
                    <img id="imagePreview" src="https://w7.pngwing.com/pngs/527/625/png-transparent-scalable-graphics-computer-icons-upload-uploading-cdr-angle-text-thumbnail.png" alt="Preview" class="img-fluid rounded-circle" width="100px">
                </div>
                <div class="text-center mb-3">
                    <div class="input-group">
                        <input type="file" name="examImage" class="form-control" id="examImage">
                        <button class="btn btn-outline-secondary" type="button" id="uploadBtn">Upload Image</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="examName" class="form-label">Exam Name</label>
                    <input type="text" name="exam_name" class="form-control" id="examName" placeholder="Enter Exam Name">
                </div>
                <div class="mb-3">
                    <label for="examDate" class="form-label">Exam Date</label>
                    <input type="date" name="exam_date" class="form-control" id="examDate" placeholder="Enter Exam Date">
                </div>
                <div class="mb-3">
                    <label for="totalMarks" class="form-label">Total Marks</label>
                    <input type="text" name="total_marks" class="form-control" id="totalMarks" placeholder="Enter Total Marks">
                </div>
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
   $(document).ready(function(){
    // Image Read Properly
    $("#examImage").change(function () {
        readURL(this);
    });

    // Trigger file input when the "Upload" button is clicked
    $('#uploadBtn').click(function(){
        $('#examImage').click();
    });

    // Handle file input change event
    $('#examImage').change(function(){
        readURL(this);
    });

    // Function to display the image preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Set the src attribute of the image tag to the uploaded image
                $('#imagePreview').attr('src', e.target.result);
            };

            // Read the uploaded image as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form submission
    $("#addExams").submit(function(e){
        e.preventDefault();

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "{{ route('addExams') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if(res.success == true){
                    alert(res.msg);
                    location.reload();
                } else {
                    alert(res.msg);
                }
            }
        });
    });
});

 </script>
@endsection