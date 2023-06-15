@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Q&A</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
    Tambahkan Soalan dan Jawaban
  </button>
  
  <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#importQnaModal">
    Import Q&A dari Excel
  </button>
<br><br>

<table class="table">
<thead>
    <th>#</th>
    <th>Pertanyaan</th>
    <th>Jawaban</th>
    <th>Edit</th>
    <th>Delete</th>
</thead>
<tbody>
    @if (count($questions) > 0)
        @php
            $x = 1;
        @endphp
        @foreach ($questions as $question)

        <tr>
            <td>{{ $x++ }}</td>
            <td>{{ $question->question }}</td>
            <td>
                <a href="#" class="ansButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#showAnsModal">Lihat jawaban</a>
            </td>
            <td>
                <button class="btn btn-info editButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#editQnaModal">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger deleteButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#deleteQnaModal">Delete</button>
            </td>
        </tr>
            
        @endforeach
    @else
        <tr>
            <td colspan="3">Pertanyaan dan jawaban tidak ditemukan</td>
        </tr>
    @endif
</tbody>
</table>

  <!-- Modal -->
  
  <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Tambahkan Q&A</h5>

          <button id="addAnswer" class="ml-5 btn btn-info">Tambahkan Jawaban</button>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addQna">

            @csrf

        <div class="modal-body addModalAnswers">

            <div class="row">
                <div class="col">

                    <input type="text" class="w-100" name="question" placeholder="Beri Pertanyaan" required>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <span class="error" style="color: red;"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Excel Modal -->
  
<div class="modal fade" id="importQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Import Excel File</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="importQna" enctype="multipart/form-data">

            @csrf

        <div class="modal-body">

            <div class="row">
                <div class="col">

                    <input type="file" name="file" id="fileUpload" required accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ,application/vnd.ms.excel">

                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Edit QNA Modal -->
  
  <div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Update Q&A</h5>

          <button id="addEditAnswer" class="ml-5 btn btn-info">Tambahkan Jawaban</button>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editQna">

            @csrf

        <div class="modal-body editModalAnswers">

            <div class="row">
                <div class="col">
                    
                    <input type="hidden" name="question_id" id="question_id">
                    <input type="text" class="w-100" name="question" id="question" placeholder="Beri Pertanyaan" required>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <span class="editError" style="color: red;"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!--Show ans Modal -->
  
<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Lihat Jawaban</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Jawaban</th>
                    <th>Nilai</th>
                </thead>
                <tbody class="showAnswers">

                </tbody>
            </table>

        </div>
        <div class="modal-footer">
            <span class="error" style="color: red;"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>

<!-- Delete Qna Modal -->
  
<div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Q&A</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteQna">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id" id="delete_qna_id">
            <p>Apakah anda yakin ingin menghapus Q&A ini?</p>
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

        //form submit
        $("#addQna").submit(function(e){
            e.preventDefault();

            if($(".answers").length < 2) {
                $(".error").text("Minimal 2 jawaban")
                setTimeout(function(){
                    $(".error").text("");
                }, 2000);
            } else {

                var checkIsCorrect = false;

                for(let i = 0; i < $(".is_correct").length; i++){
                    if($(".is_correct:eq("+i+")").prop('checked') == true)
                    {
                        checkIsCorrect = true;
                        $(".is_correct:eq("+i+")").val( $(".is_correct:eq("+i+")").next().find('input').val());
                    }
                }

                if (checkIsCorrect) {

                    var formData = $(this).serialize();

                    $.ajax ({
                        url:"{{ route('addQna') }}",
                        type:"POST",
                        data:formData,
                        success:function(data){
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                    
                } else {
                    $(".error").text("Tolong pilih jawaban yang benar")
                    setTimeout(function(){
                        $(".error").text("");
                    },2000);
                }
                
            }
        });

        //add answers
        $("#addAnswer").click(function(){

            if($(".answers").length >= 6) {
                $(".error").text("Maximal 6 jawaban")
                setTimeout(function(){
                    $(".error").text("");
                }, 2000);
            } else {

                var html = `
            <div class="row mt-3 ml-1 mr-1 answers">
                <input type="radio" name="is_correct" class="is_correct">
                <div class="col">
            
                    <input type="text" class="w-100" name="answers[]" placeholder="Masukan Jawaban" required>

                </div>
                <button class="btn btn-danger removeButton">Hapus</button>
            </div>
            `;

            $(".addModalAnswers").append(html);

            }
        });

        $(document).on("click",".removeButton",function(){
            $(this).parent().remove();
        });


        //show answers

        $(".ansButton").click(function(){

            var questions = @json($questions);
            var qid = $(this).attr('data-id');
            var html = '';

            for(let i=0;i < questions.length; i++){

                if(questions[i]['id'] == qid){

                    var answersLength = questions[i]['answers'].length;
                    for(let j=0; j< answersLength; j++){
                        let is_correct = 'Salah';
                        if(questions[i]['answers'][j]['is_correct'] == 1){
                            is_correct = 'Benar';
                        }

                        html += `
                        <tr>
                            <td>`+(j+1)+`</td>
                            <td>`+questions[i]['answers'][j]['answer']+`</td>
                            <td>`+is_correct+`</td>
                        </tr>
                        `;

                    }
                    break;
                }
            }
            $('.showAnswers').html(html);

        });

        //edit qna
        $("#addEditAnswer").click(function(){

            if($(".editAnswers").length >= 6) {
                $(".editError").text("Maximal 6 jawaban")
                setTimeout(function(){
                    $(".editError").text("");
                }, 2000);
            } else {

                var html = `
            <div class="row mt-3 ml-1 mr-1 editAnswers">
                <input type="radio" name="is_correct" class="edit_is_correct">
                <div class="col">
            
                    <input type="text" class="w-100" name="new_answers[]" placeholder="Masukan Jawaban" required>

                </div>
                <button class="btn btn-danger removeButton">Hapus</button>
            </div>
            `;

            $(".editModalAnswers").append(html);

            }
        });

        $(".editButton").click(function(){
            var qid = $(this).attr('data-id');

            $.ajax({
                url:"{{ route('getQnaDetails') }}",
                type:"GET",
                data:{qid:qid},
                success:function(data){
                    console.log(data);

                    var qna = data.data[0];
                    $("#question_id").val(qna['id']);
                    $("#question").val(qna['question']);
                    $(".editAnswers").remove();

                    var html = '';

                    for(let i = 0; i < qna['answers'].length; i++){

                        var checked = '';
                        if(qna['answers'][i]['is_correct'] == 1){
                            checked = 'checked';
                        }

                        html += `

                        <div class="row mt-3 ml-1 mr-1 editAnswers">
                <input type="radio" name="is_correct" class="edit_is_correct" `+checked+`>
                <div class="col">
            
                    <input type="text" class="w-100" name="answers[`+qna['answers'][i]['id']+`]"
                     placeholder="Masukan Jawaban" value="`+qna['answers'][i]['answer']+`" required>

                </div>
                <button class="btn btn-danger removeButton removeAnswer" data-id="`+qna['answers'][i]['id']+`">Hapus</button>
            </div>      
                        
                        `;

                    }
                    $(".editModalAnswers").append(html);

                }   
            });
        });

        //form submit update
        $("#editQna").submit(function(e){
            e.preventDefault();

            if($(".editAnswers").length < 2) {
                $(".editError").text("Minimal 2 jawaban")
                setTimeout(function(){
                    $(".editError").text("");
                }, 2000);
            } else {

                var checkIsCorrect = false;

                for(let i = 0; i < $(".edit_is_correct").length; i++){
                    if($(".edit_is_correct:eq("+i+")").prop('checked') == true)
                    {
                        checkIsCorrect = true;
                        $(".edit_is_correct:eq("+i+")").val( $(".edit_is_correct:eq("+i+")").next().find('input').val());
                    }
                }

                if (checkIsCorrect) {

                    var formData = $(this).serialize();

                    $.ajax({
                url:"{{ route ('updateQna') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if (data.success == true){
                        location.reload();
                        
                    } else {
                        alert(data.msg)
                    }
                }
            });        

                } else {
                    $(".editError").text("Tolong pilih jawaban yang benar")
                    setTimeout(function(){
                        $(".editError").text("");
                    },2000);
                }
                
            }
        });

        //remove Answers
        $(document).on('click','.removeAnswer',function(){

            var ansId = $(this).attr('data-id');

            $.ajax({
                url:"{{ route ('deleteAns') }}",
                type:"GET",
                data:{ id:ansId },
                success:function(data){
                    if (data.success == true){
                        console.log(data.msg);
                        
                    } else {
                        alert(data.msg)
                    }
                }
            });

        });

        //delete QNA

        $('.deleteButton').click(function(){

            var id = $(this).attr('data-id');
            $('#delete_qna_id').val(id);

        });

        $('#deleteQna').submit(function(e){

            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('deleteQna') }}",
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

        $('#importQna').submit(function(e){
            e.preventDefault();

            let formData = new FormData();

            formData.append("file",fileUpload.files[0]);

            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                }
            });

            $.ajax({
                url:"{{ route('importQna') }}",
                type:"POST",
                data:formData,
                processData:false,
                contentType:false,
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