

<?php $__env->startSection('space-work'); ?>
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
            <?php if(count($attempts) > 0): ?>
            <?php
                $x = 1;
            ?>
            <?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($x++); ?></td>
                <td><?php echo e($attempt->exam->exam_name); ?></td>
                <td>
                    <?php if($attempt->status == 0): ?>
                        Belum ditentukan    
                    <?php else: ?>

                        <?php if($attempt->marks >= $attempt->exam->pass_marks ): ?>
                            <span style="color:green;">Tuntas</span>
                        <?php else: ?>
                            <span style="color:red;">Gagal</span>
                        <?php endif; ?>
                        
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($attempt->status == 0): ?>
                        <span style="color:red;">Pending</span>
                    <?php else: ?>
                        <a href="#" data-id="<?php echo e($attempt->id); ?>" class="reviewExam" data-toggle="modal" data-target="#reviewQnaModal">Review QNA</a>
                    <?php endif; ?>
                </td>
            </tr>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
                <tr>
                    <td colspan="4">Anda belum mengikuti ujian</td>
                </tr>
            <?php endif; ?>
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
                url:"<?php echo e(route('resultStudentQna')); ?>",
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/student-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/student/results.blade.php ENDPATH**/ ?>