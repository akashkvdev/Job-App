@extends('layouts/adminlayout')

@section('admin-space-work')

<div class="mt-3">
    <a href="javascript:history.back()" class="mt-3 ms-4 fs-5">BACK</a>
</div>
<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Skills</h5>
            <button class="btn btn-light fw-bolder" data-bs-toggle="modal" data-bs-target="#addSkillModal">ADD SKILL</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th scope="col">SL.no</th>
                            <th scope="col">Skill</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($skills) >0)
                        @foreach ($skills as $sub)
                        <tr>
                            <th scope="row">{{$sub->tech_skill_id}}</th>
                            <th scope="row">{{$sub->skill_name}}</th>
                            
                            <td>
                                <button class="btn btn-sm btn-primary editButton"  data-bs-toggle="modal" data-bs-target="#EditModalLabel" style="cursor:pointer" data-id="{{$sub->tech_skill_id}}" data-skill_name="{{$sub->skill_name}}">Edit</button>

                                <button class="btn btn-sm btn-danger deleteButton"  data-bs-toggle="modal" data-bs-target="#DeleteModalLabel" style="cursor:pointer" data-id="{{$sub->tech_skill_id}}" data-skill_name="{{$sub->skill_name}}">Delete</button>
                                
                            </td>
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

<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="addSkillModalLabel" aria-hidden="true">
   <form id="addSkills">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="addSkillModalLabel">Add Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="text" name="skill_name" class="form-control fw-bolder" placeholder="Enter Skill Name...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info text-white fw-bolder">Save Skill</button>
            </div>
        </div>
    </div>
   </form>
</div>



{{-- ============Edit Model Form== Start======== --}}
<div class="modal fade" id="EditModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="editSkills">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Skill Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" name="tech_skill_id" id="tech_skill_id">
         
                <input type="text" class="form-control fw-bolder" name="skill_name" id="editSKILL" placeholder="Enter Skills..">
        
              <div class="text-center">
              <button type="submit" class="btn btn-info text-white fw-bolder mt-3">Skill Update</button>
              </div>
        </div>
      </div>
    </form>
    </div>
  </div>
{{-- ============Edit Model Form===End======= --}}

{{-- ============Delete Model Form== Start======== --}}
<div class="modal fade" id="DeleteModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="deleteSkill">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Skills</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" name="delete_skill_id" id="delete_skill_id">
          <p>Are You Sure you want to delete Skill ?</p>
              <div class="text-center">
              <button type="submit" class="btn btn-danger mt-2">Delete</button>
              <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
        </div>
      </div>
    </form>
    </div>
  </div>
{{-- ============Delete Model Form===End======= --}}


<script>
     $(document).ready(function(){
        $("#addSkills").submit(function(e){
            e.preventDefault();
            var formData=$(this).serialize();
            $.ajax({
                url: "{{route('addSkillss')}}",
                type: "POST",
                data: formData,
                // dataType: "dataType",
                success: function (res) {
                    // console.log(res);
                    if(res.success==true){
                        alert(res.msg);
                        location.reload();
                    }else{
                        alert(res.msg);
                    }
                }
            });
        });



  // Edit Subject=============>
  $(".editButton").click(function () {
    var skillID = $(this).attr('data-id');
    var skill_name = $(this).attr('data-skill_name');

    $("#tech_skill_id").val(skillID);
    $("#editSKILL").val(skill_name);

    // Reset the form submission event handler
    $("#editSkills").off('submit').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('editSkills') }}",
            type: "POST",
            data: formData,
            success: function (res) {
                console.log(res);
                if (res.success == true) {
                    alert(res.msg);
                    location.reload();
                } else {
                    alert(res.msg);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while updating the skill.");
            }
        });
    });
});



  //Delete Subject====================>
  $('.deleteButton').click(function(){
            var skill_id=$(this).attr('data-id');
            $('#delete_skill_id').val(skill_id);

            $("#deleteSkill").submit(function(e){
            e.preventDefault();
            var formData=$(this).serialize();
            $.ajax({
                url: "{{route('deleteSkill')}}",
                type: "POST",
                data: formData,
                // dataType: "dataType",
                success: function (res) {
                    // console.log(res);
                    if(res.success==true){
                        alert(res.msg);
                        location.reload();
                    }else{
                        alert(res.msg);
                    }
                }
            });
        });
    });




    });
</script>

@endsection