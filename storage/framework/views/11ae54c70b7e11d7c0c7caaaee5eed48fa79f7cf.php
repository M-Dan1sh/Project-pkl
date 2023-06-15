

<?php $__env->startSection('space-work'); ?>
    
    <div class="container">
        <div class="text-center">
            <h2 class="mt-3">Terimakasih sudah submit ujian, <?php echo e(Auth::user()->name); ?> </h2>
            <p>bla bla bla</p>
            <a href="/dashboard" class="btn btn-info">Kembali</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/thank-you.blade.php ENDPATH**/ ?>