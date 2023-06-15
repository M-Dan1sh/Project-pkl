

<?php $__env->startSection('space-work'); ?>

<h2 class="mb-4">Mata Pelajaran</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModel">
    Tambahkan Mapel
  </button>

  <br><br>

  <!-- Table -->

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Mapel</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
    
        <?php if(count($subjects) > 0): ?>
        <?php
            $x = 1;
        ?>

        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($x++); ?> </td>
                <td> <?php echo e($subject->subject); ?> </td>
                <td>
                    <button class="btn btn-info editButton" data-id="<?php echo e($subject->id); ?>" data-subject="<?php echo e($subject->subject); ?>" data-toggle="modal" data-target="#editSubjectModel">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger deleteButton" data-id="<?php echo e($subject->id); ?>" data-toggle="modal" data-target="#deleteSubjectModel">Delete</button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        <?php else: ?>
            <tr>
                <td colspan="4">Mapel tidak ditemukan!</td>
            </tr>
        <?php endif; ?>

    </tbody>
  </table>
  
  <!-- Modal -->
  
    <div class="modal fade" id="addSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

    <form id="addSubject">
        <?php echo csrf_field(); ?>
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Mapel</h1>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>Mata Pelajaran:- </label>
              <input type="text" name="subject" placeholder=" Masukan nama mapel" required>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
          </div>
        </div>
    </form>
      </div>
  </div>


    <!--Edit Subject Modal -->
  
    <div class="modal fade" id="editSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Mapel</h1>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <form id="editSubject">
                <?php echo csrf_field(); ?>
            <div class="modal-body">
              <label>Mata Pelajaran:- </label>
              <input type="text" name="subject" placeholder=" Masukan nama mapel" id="edit_subject" required>
              <input type="hidden" name="id" id="edit_subject_id">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
      </div>
  </div>

  <!--delete Subject Modal -->
  
  <div class="modal fade" id="deleteSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Mapel</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form id="deleteSubject">
            <?php echo csrf_field(); ?>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus mapel ini?</p>
          <input type="hidden" name="id" id="delete_subject_id">
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
        
        $("#addSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url:"<?php echo e(route('addSubject')); ?>",
            type:"POST",
            data:formData,
            success:function(data){
                if (data.success == true) 
                {
                location.reload();    
                } else {
                    alert(data.msg);
                }
            }
        });
    });

    $(".editButton").click(function(){
        var subject_id = $(this).attr('data-id');
        var subject = $(this).attr('data-subject');
        $("#edit_subject").val(subject);
        $("#edit_subject_id").val(subject_id);
    })

$("#editSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url:"<?php echo e(route('editSubject')); ?>",
            type:"POST",
            data:formData,
            success:function(data){
                if (data.success == true) 
                {
                location.reload();    
                } else {
                    alert(data.msg);
                }
            }
        });
    });

    //delete subject
    $(".deleteButton").click(function(){
        var subject_id = $(this).attr('data-id');
        $("#delete_subject_id").val(subject_id);
    });

    $("#deleteSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url:"<?php echo e(route('deleteSubject')); ?>",
            type:"POST",
            data:formData,
            success:function(data){
                if (data.success == true) 
                {
                location.reload();    
                } else {
                    alert(data.msg);
                }
            }
        });
    });

});

  </script>
  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>