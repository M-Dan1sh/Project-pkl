


<?php $__env->startSection('space-work'); ?>

<?php if($errors->any()): ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<p style="color:red;"><?php echo e($error); ?></p>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
<?php endif; ?>


<?php if(Session::has('error')): ?>

<p style="color: red;"><?php echo e(Session::get('error')); ?></p>
    
<?php endif; ?>

    <form action="<?php echo e(route('userLogin')); ?>" method="POST">
    
        <?php echo csrf_field(); ?>

        <style>
          div.solid {
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
                      <div class="logo">
                        <img src="asset_login/images/user.png">
                      </div>
                      
                      <div class="form-group">
                    <input type="email" name="email" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan email">
                      </div>

                    <div class="form-group">
                    <input type="password" name="password" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan password">
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                        <input type="submit" class="btn" value="Login">
                        </div>
                    <div class="form-group pt-0">
      </div>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/layout-common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project-PKL\web-pkl\resources\views/login.blade.php ENDPATH**/ ?>