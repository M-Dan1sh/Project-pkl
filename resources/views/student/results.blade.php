@extends('layout/student-layout')

@section('space-work')
    <h2>Hasil</h2>
    <table class="table">

        <thead>
            <tr>
                <th>#</th>
                <th>Ujian</th>
                <th>Hasil</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @if (count($attempts) > 0)
            @php
                $x = 1;
            @endphp
            @foreach ($attempts as $attempt)

            <tr>
                <td>{{ $x++ }}</td>
                <td>{{ $attempt->exam->exam_name }}</td>
                <td>
                    @if ($attempt->status == 0)
                        Belum ditentukan    
                    @else

                        @if ($attempt->marks >= $attempt->exam->pass_marks )
                            <span style="color:green;">Tuntas</span>
                        @else
                            <span style="color:red;">Gagal</span>
                        @endif
                        
                    @endif
                </td>
                <td>
                    @if ($attempt->status == 0)
                        <span style="color:red;">Pending</span>
                    @else
                        <a href="#" data-id="{{ $attempt->id }}" class="reviewExam" data-toggle="modal" data-target="#reviewQnaModal">Review QNA</a>
                    @endif
                </td>
            </tr>
                
            @endforeach

            @else
                <tr>
                    <td colspan="4">Anda belum mengikuti ujian</td>
                </tr>
            @endif
        </tbody>

    </table>

    <!-- Modal -->
  
<div class="modal fade" id="reviewQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Review Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body review-qna">
            Loading...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.reviewExam').click(function(){

            var id = $(this).attr('data-id');

            $.ajax({
                url:"{{ route('resultStudentQna') }}",
                type:"GET",
                data:{ attempt_id:id },
                success:function (data){
                    console.log(data);

                    var html = '';

                    if (data.success == true) {

                        var data = data.data;
                        if (data.length > 0) {

                            for(let i = 0; i < data.length; i++){

                                let is_correct = '<span style="color:red;" class="fa fa-close"></span>';

                                if (data[i]['answers']['is_correct'] == 1) {
                                     is_correct = '<span style="color:green;" class="fa fa-check"></span>';
                                }

                                let answer = data[i]['answers']['answer'];

                                html +=`
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6>Q(`+(i+1)+`). `+data[i]['question']['question']+`</h6>
                                        <p>Jwb:- `+answer+` `+is_correct+` </p>
                                    </div>
                                </div>
                                `;

                            }
                            
                        } else {
                            html +=`<h6>anda tidak mengikuti ujian</h6>`;
                        }
                        
                    } else {

                        html +=`
                        <p>ada kesalahan teknis</p>
                        `;
                        
                    }

                    $('.review-qna').html(html);
                    
                }
            });
        });
    });
</script>

@endsection