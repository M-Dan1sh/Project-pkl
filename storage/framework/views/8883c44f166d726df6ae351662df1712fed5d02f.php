

<?php $__env->startSection('space-work'); ?>

<?php
    $time = explode(':',$exam[0]['time'] );
?>

<div class="container">

    <p style="color:black" class="mt-2">Selamat datang, <?php echo e(Auth::user()->name); ?></p>
    <h1 class="text-center"><?php echo e($exam[0]['exam_name']); ?></h1>
    
    <?php $qcount = 1; ?>
<?php if($success == true): ?>
    
<?php if(count($qna) > 0): ?>
    <h4 class="text-right time"><?php echo e($exam[0]['time']); ?></h4>
    <form action="<?php echo e(route('examSubmit')); ?>" method="POST" id="exam_form" class="mb-5">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="exam_id" value="<?php echo e($exam[0]['id']); ?>">
        <?php $__currentLoopData = $qna; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <h5>Q<?php echo e($qcount++); ?>. <?php echo e($data['question'][0]['question']); ?> </h5>
                <input type="hidden" name="q[]" value="<?php echo e($data['question'][0]['id']); ?>">
                <input type="hidden" name="ans_<?php echo e($qcount-1); ?>" id="ans_<?php echo e($qcount-1); ?>">
                <?php $acount = 1; ?>
                <?php $__currentLoopData = $data['question'][0]['answers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><b><?php echo e($acount++); ?>).</b> <?php echo e($answer['answer']); ?>

                    <input type="radio" name="radio_<?php echo e($qcount-1); ?>" data-id="<?php echo e($qcount-1); ?>" class="select_ans" value="<?php echo e($answer['id']); ?>">
                    </p>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="text-center">
        <input type="submit" class="btn btn-info">
    </div>
    </form>

    <?php else: ?>
        <h3 style="color:red;" class="text-center">QNA tidak ditemukan</h3>
    <?php endif; ?>

    <?php else: ?>
        <h4 style="color:red;" class="text-center"><?php echo e($msg); ?></h4>
    <?php endif; ?>

</div>

<script>
    $(document).ready(function(){

        $('.select_ans').click(function(){
            var no = $(this).attr('data-id');
            $('#ans_'+no).val($(this).val());
        });

        var time = <?php echo json_encode($time, 15, 512) ?>;
        $('.time').text(time[0]+':'+time[1]+':00');

        var seconds = 0;
        var hours = parseInt(time[0]);
        var minutes = parseInt(time[1]);

        var timer = setInterval(() => {

            if (hours == 0 && minutes == 0 && seconds == 0){
                clearInterval(timer);
                $('#exam_form').submit();
            }
            console.log(hours+" -=- "+minutes+" -=- "+seconds);

            if (seconds <= 0) {
                minutes--;
                seconds = 59;
            }
            
            if (minutes <= 0 && hours != 0) {
                hours--;
                minutes = 59;
                seconds = 59;
            }

            let temptHours = hours.toString().length > 1? hours:'0'+hours;
            let temptMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
            let temptSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

            $('.time').text(temptHours+':'+temptMinutes+':'+temptSeconds);

            seconds--;
        }, 1000);
        
    });

    function isValid(){
            var result = true;

            var qlength = parseInt("<?php echo e($qcount); ?>")-1;
            //$('.error_msg').remove();
            for(let i = 1; i <= qlength; i++){
                if ($('#ans_'+i).val() == "" ){
                    result = false;
                    $('#ans_'+i).parent().append('<span style="color:red;" class="error_msg">Tolong Pilih Jawaban!</span>')
                    setTimeout(() => {
                        $('.error_msg').remove();
                    }, 5000);
                }
            }

            return result;
        }
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/student/exam-dashboard.blade.php ENDPATH**/ ?>