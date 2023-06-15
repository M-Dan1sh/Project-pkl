

<?php $__env->startSection('space-work'); ?>
    <h2>Ujian</h2>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Nama Ujian</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Percobaan Total</th>
            <th>Percobaan Tersedia</th>
            <th>Copy Link</th>
        </thead>

        <tbody>
            <?php if(count($exams) > 0): ?>
            <?php $count = 1; ?>
            <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="display:none;"><?php echo e($exam->id); ?></td>
                    <td><?php echo e($count++); ?></td>
                    <td><?php echo e($exam->exam_name); ?></td>
                    <td><?php echo e($exam->subjects[0]['subject']); ?></td>
                    <td><?php echo e($exam->time); ?></td>
                    <td><?php echo e($exam->attempt); ?> Kali</td>
                    <td><?php echo e($exam->attempt_counter); ?></td>
                    <td><a href="#" data-code="<?php echo e($exam->enterance_id); ?>" class="copy"><i class="fa fa-copy"></i></a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            <?php else: ?>

            <tr>
                <td colspan="8">Ujian tidak ada</td>
            </tr>
                
            <?php endif; ?>
        </tbody>
    </table>

    <script>

        $(document).ready(function(){

            $('.copy').click(function(){

                $(this).parent().prepend('<span class="copied_text">Copied</span>');

                var code = $(this).attr('data-code');
                var url = "<?php echo e(URL::to('/')); ?>/exam/"+code;

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                setTimeout(() => {
                    $('.copied_text').remove();
                }, 1000);

            });

        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/student-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/student/dashboard.blade.php ENDPATH**/ ?>