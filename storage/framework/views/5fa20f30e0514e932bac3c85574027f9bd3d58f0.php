


<?php $__env->startSection('space-work'); ?>

    <form action="<?php echo e(route('studentRegister')); ?>" method="POST">
    
        <?php echo csrf_field(); ?>

        <input type="text" name="name" placeholder="Masukan nama">
        <br><br>
        <input type="text" name="email" placeholder="Masukan email">
        <br><br>
        <input type="text" name="password" placeholder="Masukan password">
        <br><br>
        <input type="text" name="password_confirmation" placeholder="Comfirmasi password">
        <br><br>
        <input type="button" value="Register">

    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views//register.blade.php ENDPATH**/ ?>