<?php $__env->startSection("title","Change Password"); ?>
<?php $__env->startSection("content"); ?>

<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <?php if(session('success')): ?>
          <div class="alert alert-success">
             <?php echo e(session("success")); ?>

          </div>
        
          <?php elseif(session("error")): ?>
          <div class="alert alert-danger">
             <?php echo e(session("error")); ?>

          </div>
          <?php endif; ?>
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form method="POST" action="<?php echo e(route('updatepassword')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Change your account Password</h5>
  
                    <div class="form-outline mb-4">
                      <input type="email" name="email" id="email" class="form-control form-control-lg" />
                      <label class="form-label"  for="email">Email</label>
                      <?php if($errors->has('email')): ?>
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                 <?php endif; ?>
                    </div>
                    <p>Please enter registered Email,<br>
                    We will provide a link on your Email.</p>

                    
  

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Send a link</button>
                    </div>
                    
  
                    
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jeet_fitness\resources\views\auth\changepassword.blade.php ENDPATH**/ ?>