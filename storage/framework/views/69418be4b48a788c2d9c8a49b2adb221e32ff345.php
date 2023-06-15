

<?php $__env->startSection('space-work'); ?>

<h2 class="mb-4">Review Ujian</h2>

<table class="table">
<thead>
    <th>#</th>
    <th>Nama</th>
    <th>Ujian</th>
    <th>Status</th>
    <th>Review</th>
</thead>
<tbody>

    <?php if(count($attempts) > 0): ?>
        <?php
            $x = 1;
        ?>
        <?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td><?php echo e($x++); ?></td> 
            <td><?php echo e($attempt->user->name); ?></td>
            <td>
                
                    <?php echo e($attempt->exam->exam_name); ?>

                
            </td>
            <td>
                <?php if($attempt->status == 0): ?>
                <span style="color:red">Pending</span>    
                <?php else: ?>
                <span style="color:green">Approved</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($attempt->status == 0): ?>
                    <a href="#" class="reviewExam" data-id="<?php echo e($attempt->id); ?>" data-toggle="modal" data-target="#reviewExamModal">Review</a>
                <?php else: ?>
                    Completed
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Peserta tidak mengikuti ujian</td>
        </tr>
    <?php endif; ?>

</tbody>
</table>

<!-- Modal -->
  
<div class="modal fade" id="reviewExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 mt-1 mb-1" id="exampleModalLabel">Review Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="reviewForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="attempt_id" id="attempt_id">
        <div class="modal-body review-exam">
            Loading...
        </div>
        <div class="modal-footer">
            <span class="error" style="color: red;"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Approve</button>
        </div>
    </form>
      </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.reviewExam').click(function(){
           
            var id = $(this).attr('data-id');
            $('#attempt_id').val(id);

            $.ajax({
                url:"<?php echo e(route('reviewQna')); ?>",
                type:"GET",
                data:{attempt_id: id},
                success:function(data){
                    
                    var html = '';

                    if(data.success == true){

                        var data = data.data;
                        if (data.length > 0) {


                            for(let i = 0; i < data.length; i++){

                                let isCorrect = '<span style="color:red;" class="fa fa-close"></span>';

                                if (data[i]['answers']['is_correct'] == 1) {
                                    isCorrect = '<span style="color:green;" class="fa fa-check"></span>';
                                }

                                let answer = data[i]['answers']['answer'];

                                html +=`
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6>Q(`+(i+1)+`). `+data[i]['question']['question']+`</h6>
                                        <p>Jwb:- `+answer+` `+isCorrect+`</p>
                                    </div>
                                </div>
                                `;
                            }
                            
                        } else {
                            html +=`
                            <h6>Peserta tidak menjawab soalan</h6>
                            <p>jika di approve maka peserta akan gagal</p>
                            `;
                        }

                    }
                    else{
                        html +=`
                        <p>Maaf ada kesalahan teknis</p>
                        `;
                    }

                    $('.review-exam').html(html);

                }
            }); 
        });

        //approved exam
        $('#reviewForm').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"<?php echo e(route('approvedQna')); ?>",
                type:"POST",
                data:formData,
                success:function(data){
                    if (data.success == true) {
                        location.reload();
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/admin/review-exams.blade.php ENDPATH**/ ?>