@extends('layouts/userslayout')

@section('space-work')
<div class="mt-3">
  <a href="javascript:history.back()" class="mt-3 ms-4 fs-5">BACK</a>
</div>
<div class="container mt-3">
    <form id="alluserData" >
        @csrf
        @if(session()->has('userId'))
        <input type="hidden" name="user_id" value="{{ session('userId') }}">
        @endif

    <div class="row mb-3">
        <div class="col-md-2 mt-2">
            <label for="skills" class="form-label fw-bolder">Choose Skills </label>
        </div>
        @for ($i = 1; $i <= 5; $i++)
            <div class="col-md-2 mb-2">
                <select name="skill{{$i}}" id="skill{{$i}}" class="form-select skill-dropdown fw-bolder">
                    <option selected disabled>Choose a Skill {{$i}}</option>
                    @foreach ($skills as $skill)
                        <option value="{{ $skill->tech_skill_id }}">{{ $skill->skill_name }}</option>
                    @endforeach
                </select>
            </div>
        @endfor
    </div>
          
    <div class="card bg-info">
        
            
      <div class="card-body">
        
        <div class="row">
          <!-- Left part for education qualifications -->
          <div class="col-md-4">
            <h5 class="text-white fw-bolder">Education Qualifications</h5>
           
              <!-- Add your form fields for education here -->
              <div class="mb-3">
                <label for="degree_name" class="form-label fw-bolder">Degree Name</label>
                <input type="text" class="form-control fw-bolder" id="degree_name" name="degree_name" placeholder="Enter Your Degree Name...">
              </div>
              <div class="mb-3">
                <label for="degree_name" class="form-label fw-bolder">Field of Study</label>
                <input type="text" class="form-control fw-bolder" id="field_of_study" name="field_of_study" placeholder="Enter Your Field Of Study">
              </div>
              <div class="mb-3">
                <label for="degree_name" class="form-label fw-bolder">University/Institute</label>
                <input type="text" class="form-control fw-bolder" id="university" name="university" placeholder="University or Institute Name...">
              </div>
              <div class="mb-3">
                <label for="degree_name" class="form-label fw-bolder">Passout Year</label>
                <input type="text" class="form-control fw-bolder" id="passout_year" name="passout_year" placeholder="Your Passout Year">
              </div>
              <div class="mb-3">
                <label for="degree_name" class="form-label fw-bolder">Grade</label>
                <input type="text" class="form-control fw-bolder" id="grade" name="grade" placeholder="Enter Your Grade">
              </div>
              <!-- Add other fields for education here -->
  
            
          </div>
  
          <!-- Right part for work experience -->
          <div class="col-md-4">
            <h5 class="text-white fw-bolder">Work Experience</h5>
              <!-- Add your form fields for work experience here -->
              <div class="mb-3">
                <label for="company_name" class="form-label fw-bolder">Company Name</label>
                <input type="text" class="form-control fw-bolder" id="company_name" name="company_name" placeholder="Enter Employeer Name...">
              </div>
              <div class="mb-3">
                <label for="job_title" class="form-label fw-bolder">Job Title</label>
                <input type="text" class="form-control fw-bolder" id="job_title" name="job_title" placeholder="Enter Your Designation">
              </div>
              <div class="mb-3">
                <label for="start_date" class="form-label fw-bolder">Start Date</label>
                <input type="date" class="form-control fw-bolder" id="start_date" name="start_date" placeholder="Enter Start Date">
              </div>
              <div class="mb-3">
                <label for="end_date" class="form-label fw-bolder">End Date</label>
                <input type="date" class="form-control fw-bolder" id="end_date" name="end_date" >
              </div>
              <div class="mb-3">
                <label for="end_date" class="form-label fw-bolder">Responsibilities</label>
                <input type="text" class="form-control fw-bolder" id="responsibilities" name="responsibilities" placeholder="Enter Responsibilities..." >
              </div>
              <!-- Add other fields for work experience here -->
  
        
          </div>
          <div class="col-md-4">
            <h5 class="text-white fw-bolder">Additional Information</h5>
       
              <!-- Add your form fields for work experience here -->
              <div class="mb-3">
                <label for="certification" class="form-label fw-bolder">Certification</label>
                <input type="text" class="form-control fw-bolder" id="certification" name="certification" placeholder="Enter Employeer Name...">
              </div>
              <div class="mb-3">
                <label for="language_spoken" class="form-label fw-bolder">Language Spoken</label>
                <input type="text" class="form-control fw-bolder" id="language_spoken" name="language_spoken" placeholder="Enter Your Designation">
              </div>
              <div class="mb-3">
                <label for="hobbies" class="form-label fw-bolder">Hobbies</label>
                <input type="text" class="form-control fw-bolder" id="hobbies" name="hobbies" placeholder="Enter Your Hobbies">
              </div>
              <div class="mb-3">
                <label for="cover_letter" class="form-label fw-bolder">Cover Letter</label>
                <textarea class="form-control fw-bolder" id="cover_letter" rows="3" placeholder="Write Cover Letter Here....."></textarea>
              </div>
              
              <!-- Add other fields for work experience here -->
  
         <div class="text-end">
            <button type="submit" id="submitBtn" class="btn btn-secondary fw-bolder">SUBMIT</button>
         </div>
          </div>
          <div>
      

      </div>
   
    </div>
</form>
  </div>
  


  <script>
  $(document).ready(function () {
    $('#alluserData').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serializeArray();

        // Additional handling for skill dropdowns
        // var selectedSkillIds = [];
        // $('.skill-dropdown').each(function () {
        //     var selectedSkillId = $(this).val();
        //     if (selectedSkillId) {
        //         selectedSkillIds.push(selectedSkillId);
        //     }
        // });

        // Append skill IDs to the formData
        // formData.push({ name: 'selectedSkillIds[]', value: selectedSkillIds });

        $.ajax({
            url: '{{ route('add_rest_data_of_user') }}',
            method: 'POST',
            data: formData,
            success: function (response) {
                // Handle success response
                alert(response.msg);
                location.reload();
            },
            error: function (error) {
                // Handle error response
                alert(error.msg);
                // location.reload();
            }
        });
    });
});

</script>
@endsection