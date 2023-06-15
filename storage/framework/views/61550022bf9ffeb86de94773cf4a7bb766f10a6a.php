


<?php $__env->startSection('space-work'); ?>

<h1>Lupa Password</h1>

<?php if($errors->any()): ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<p style="color:red;"><?php echo e($error); ?></p>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
<?php endif; ?>


<?php if(Session::has('error')): ?>

<p style="color: red;"><?php echo e(Session::get('error')); ?></p>
    
<?php endif; ?>

<?php if(Session::has('success')): ?>

<p style="color: green;"><?php echo e(Session::get('success')); ?></p>
    
<?php endif; ?>

    <form action="<?php echo e(route('forgetPassword')); ?>" method="POST">
    
        <?php echo csrf_field(); ?>

        <input type="email" name="email" placeholder="Masukan email">
        <br><br>
        <input type="submit" value="Lupa Password">

    </form>

    <a href="/">Login</a>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/forget-password.blade.php ENDPATH**/ ?>