<?php $__env->startSection("title","Register"); ?>
<?php $__env->startSection("content"); ?>

<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <?php if(session()->has("success")): ?>
          <div class="alert alert-success">
             <?php echo e(session()->get("success")); ?>

          </div>
          <?php endif; ?>
          <?php if(session()->has("error")): ?>
          <div class="alert alert-danger">
             <?php echo e(session()->get("error")); ?>

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
  
                  <form id="user_form" method="POST" action="<?php echo e(route("register.post")); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register into your account</h5>

                    <div class="form-outline mb-4">
                        
                        <input type="text" value="<?php echo e(old('name')); ?>" name="name" id="name" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example17">FullName</label>
                        <?php if($errors->has('name')): ?>
                           <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                        
                      </div>
                      
                     
                      
  
                    <div class="form-outline mb-4">
                      <input type="text" name="email" value="<?php echo e(old('email')); ?>" id="email" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Email address</label>
                      <?php if($errors->has('email')): ?>
                      <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                   <?php endif; ?>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="password" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                      <?php if($errors->has('password')): ?>
                      <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                   <?php endif; ?>
                    </div>
                    <label for="role">Role</label>
                    <div class="form-check">
                      <input class="form-check-input" value="1" type="radio" name="role" id="role">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Admin
                      </label>
                    </div>
                   
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                    </div>
  
                    
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Have an account? <a href="/"
                        style="color: #393f81;">Login here</a></p>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
  <script>
    $(document).ready(function() {
        $('#user_form').validate({
            rules: {
              name:{
                required: true
              },
              email: {
                    required: true
                },
                password: {
                    required: true
                },
               

            },
            messages: {
              name: 'Required',
              email: 'Required',
              password: 'Required',
            
             

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jeet_fitness\resources\views\auth\register.blade.php ENDPATH**/ ?>