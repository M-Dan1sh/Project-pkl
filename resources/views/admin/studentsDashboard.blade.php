@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Peserta</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
    Tambahkan Perserta
  </button>
  <br><br>

<table class="table">
<thead>
    <th>#</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Delete</th>
</thead>
<tbody>
    @if (count($students) > 0)
        @php
            $x = 1;
        @endphp
        @foreach ($students as $student)

        <tr>
            <td>{{ $x++ }}</td>  
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>
              <button type="button" data-id="{{ $student->id }}" class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteStudentModal">
                Delete
              </button>
            </td>
        </tr>
            
        @endforeach
    @else
        <tr>
            <td colspan="3">Peserta tidak ditemukan</td>
        </tr> 
    @endif
</tbody>
</table>

  <!-- Modal -->
  
  <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Tambahkan Peserta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addStudent">

            @csrf

        <div class="modal-body">

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="w-100" name="name" placeholder="Masukan Nama Peserta" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="email" class="w-100" name="email" placeholder="Masukan Email Peserta" required>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--delete student-->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Peserta</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteStudent">
      @csrf
      <div class="modal-body">
          <p>Apakah anda yakin ingin menghapus Peserta ini?</p>
          <input type="hidden" name="id" id="student_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>


<script>
  $(document).ready(function(){
    $("#addStudent").submit(function(e){
      e.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        url:"{{ route('addStudent') }}",
        type:"POST",
        data:formData,
        success:function(data){
          if (data.success == true) {
            location.reload();
          } else {
            alert(data.msg);
          }
        }
        });
      });

      $(".deleteButton").click(function(){
        var id = $(this).attr('data-id');
        $("#student_id").val(id);
      });

      $("#deleteStudent").submit(function(e){
      e.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        url:"{{ route('deleteStudent') }}",
        type:"POST",
        data:formData,
        success:function(data){
          if (data.success == true) {
            location.reload();
          } else {
            alert(data.msg);
          }
        }
        });
      });

    });
  
</script>

@endsection