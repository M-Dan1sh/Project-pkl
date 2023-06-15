


<?php $__env->startSection('space-work'); ?>

<?php if($errors->any()): ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<p style="color:red;"><?php echo e($error); ?></p>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
<?php endif; ?>

    <form action="<?php echo e(route('studentRegister')); ?>" method="POST">
    
        <?php echo csrf_field(); ?>

        <style>

            div.solid{
                border-style: solid;
                color: #0056b3;
                padding: 4%;
            }

            input[type=submit]{
                display: inline-block;
                width: 100%;
                padding: 10px 0px;
                background-color : #0056b3;
                border-radius: 20px;
                text-align: center;
                font-size: 16px;
                color: white;
            }
        </style>

        <section class="form-02-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="_lk_de">
                            <div class="form-03-main">

                                <div class="solid">
                                <div class="text-center">
                                <h2>Register</h2>
                                </div>

                            <div class="form-group">
                            <input type="text" name="name" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan nama">
                            </div>

                            <div class="form-group">
                            <input type="email" name="email" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan email">
                            </div>

                            <div class="form-group">
                            <input type="password" name="password" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan password">
                            </div>
        
                            <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control _ge_de_ol" aria-required="true" placeholder="Confirmasi password">
                            </div>
        
                            <div class="form-group">
                                <div class="">
                                    <input type="submit" class="btn" value="Register">
                                </div>
                              </div>

                              <div class="login-button">
                                <a href="/">Login</a>
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </section>

    </form>
    
    <?php if(Session::has('success')): ?>

    <p style="color: green;"><?php echo e(Session::get('success')); ?></p>
        
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/register.blade.php ENDPATH**/ ?>