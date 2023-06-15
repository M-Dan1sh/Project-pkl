

<?php $__env->startSection('space-work'); ?>

<h2 class="mb-4">Nilai</h2>

<table class="table">
    <thead>
        <th>#</th>
        <th>Nama Ujian</th>
        <th>Nilai / Q</th>
        <th>Total nilai</th>
        <th>KKM</th>
        <th>Edit</th>
    </thead>
    <tbody>

        <?php if(count($exams) > 0): ?>
        <?php
            $x = 1; 
        ?>
        <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($x++); ?></td>
                <td><?php echo e($exam->exam_name); ?></td>
                <td><?php echo e($exam->marks); ?></td>
                <td><?php echo e(count($exam->getQnaExam) * $exam->marks); ?></td>
                <td><?php echo e($exam->pass_marks); ?></td>
                <td>
                    <button class="btn btn-primary editMarks" data-id="<?php echo e($exam->id); ?>" data-pass-marks="<?php echo e($exam->pass_marks); ?>" data-marks="<?php echo e($exam->marks); ?>" data-totalq="<?php echo e(count($exam->getQnaExam)); ?>" data-toggle="modal" data-target="#editMarksModal">Edit</button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Ujian tidak ditemukan</td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<!-- Modal -->
  
<div class="modal fade" id="editMarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nilai</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editMarks">
        <?php echo csrf_field(); ?>
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-4">
                    <label>Nilai / Q</label>
                </div>
                <div class="col-sm-6">
                    <input type="hidden" name="exam_id" id="exam_id">
                    <input type="text"
                         onkeypress="return event.charCode >=48 && event.charCode<=57 || event.charCode == 46"
                    name="marks" placeholder="Masukan Nilai / Q" id="marks" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4">
                    <label>Total Nilai</label>
                </div>
                <div class="col-sm-6">
                    <input type="text" disabled placeholder="Total nilai" id="tmarks">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-4">
                    <label>NIlai KKM</label>
                </div>
                <div class="col-sm-6">
                    <input type="text"
                         onkeypress="return event.charCode >=48 && event.charCode<=57 || event.charCode == 46"
                    name="pass_marks" placeholder="Masukan Nilai KKM" id="pass_marks" required>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Update Nilai</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){

        var totalQna = 0;
        $('.editMarks').click(function(){

            var exam_id = $(this).attr('data-id');
            var marks = $(this).attr('data-marks');
            var totalq = $(this).attr('data-totalq');

            $('#marks').val(marks);
            $('#exam_id').val(exam_id);
            $('#tmarks').val((marks*totalq).toFixed(1));

            totalQna = totalq;

            $('#pass_marks').val($(this).attr('data-pass-marks'))
            
        });

        $('#marks').keyup(function(){

            $('#tmarks').val(($(this).val()*totalQna).toFixed(1));

        });

        $('#pass_marks').keyup(function(){

            $('.pass-error').remove();
            var tmarks = $('#tmarks').val();
            var pmarks = $(this).val();
            
            if ( parseFloat(pmarks) >= parseFloat(tmarks) ) {
                
                $(this).parent().append('<p style="color:red;" class="pass-error mt-2">KKM harus kurang dari total nilai!</p>');
                    
            }

        });

        $('#editMarks').submit(function(event){
            event.preventDefault();

            $('.pass-error').remove();
            var tmarks = $('#tmarks').val();
            var pmarks = $('#pass_marks').val();
            
            if ( parseFloat(pmarks) >= parseFloat(tmarks) ) {
                
                $('#pass_marks').parent().append('<p style="color:red;" class="pass-error mt-2">KKM harus kurang dari total nilai!</p>');
                
                    return false;
            }

            var formData = $(this).serialize();

            $.ajax({
                url:"<?php echo e(route('updateMarks')); ?>",
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
<?php echo $__env->make('layout/admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/admin/marksDashboard.blade.php ENDPATH**/ ?>