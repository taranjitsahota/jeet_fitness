<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid ">
          <a class="navbar-brand text-light" href="/sai_fitness/index">Registrations</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          </div>
        </div>
      </nav>
    
      <?php
      $citiesArray = [];
      foreach ($candidate->city as $city_id) {
          array_push($citiesArray, $city_id->city);
        }
        // dd($citiesArray );
      ?>

      <?php if($message = Session::get('success')): ?>
          <div class="alert alert-success alert-block">
          <strong><?php echo e($message); ?></strong>
            </div>    
      
          
      <?php endif; ?>

      <h3 class="text-muted">Candidate Edit #<?php echo e($candidate->name); ?></h3>
    <form id="user_form" class="container row p-4" method="POST" enctype="multipart/form-data" action="/candidates/update/<?php echo e($candidate->id); ?>" >
        <?php echo csrf_field(); ?>
        <div class="col-md-6 ">
          <input type="hidden" name='id' value="<?php echo e($candidate->id); ?>">
          <label for="name" class="form-label">Name</label>
          <input type="text" value="<?php echo e(old('name',$candidate->name)); ?>" class="form-control" name="name" id="user_name" placeholder="Please Enter Your Name">
          <?php if($errors->has('name')): ?>
          <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
          <?php endif; ?>
        </div>
        <div class="col-md-6 ">
          <label for="addrress" class="form-label">Addrress</label>
          <input type="text" value="<?php echo e(old('address',$candidate->address )); ?>" class="form-control" name="address" id="user_address" placeholder="Flat No./Floor No./apartment">
          <?php if($errors->has('address')): ?>
          <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
          <?php endif; ?>
        </div>

        <div class="col-md-4 p-2">
          <label for="country" class="form-label">Country</label>
          <select name="country" id="country_dd" class="form-select">
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($country->id); ?>" <?php if($country->id==$candidate->country): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('country')): ?>
          <span class="text-danger"><?php echo e($errors->first('country')); ?></span>
          <?php endif; ?>
        </div>
        <div class="col-md-4 p-2">
            <label for="state" class="form-label">State</label>
            <select name="state" id="state_dd" class="form-select">
              <option value="<?php echo e(old('state')); ?>" selected disabled >Choose...</option>
              <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($state->id); ?>" <?php if($state->id==$candidate->state): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('state')): ?>
            <span class="text-danger"><?php echo e($errors->first('state')); ?></span>
            <?php endif; ?>
          </div>
          <div class="col-md-4 p-2">
            <label for="city" class="form-label">City</label>
            <select name="city[]" id="city_dd" class="form-control select2" multiple>
              <option value=""disabled >Choose...</option>
            
                    
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($city->state_id == $candidate->state): ?>
                            <option value="<?php echo e($city->id); ?>" <?php if(in_array($city->id, $citiesArray)): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
            </select>
            </select>
            <?php if($errors->has('city')): ?>
          <span class="text-danger"><?php echo e($errors->first('city')); ?></span>
          <?php endif; ?>
          </div>
          <label for="gender">Gender:</label>
          <div>
            <div class="form-check p-2">
            <input class="form-check-input p-2" value="male" <?php echo e($candidate->gender == 'male' ? 'checked' : ''); ?>  type="radio" name="gender">
            <label class="form-check-label" for="user_gender">
              Male
            </label>
          </div>
          <div class="form-check p-2">
            <input class="form-check-input p-2" value="female" <?php echo e($candidate->gender == 'female' ? 'checked' : ''); ?> type="radio" name="gender">
            <label class="form-check-label" for="user_gender">
              Female
            </label>
          </div>
          <?php if($errors->has('gender')): ?>
          <span class="text-danger"><?php echo e($errors->first('gender')); ?></span>
          <?php endif; ?>
        </div>
        <div class="col-6 p-2">
          <label for="number" class="form-label">Contact Number:</label>
          <input type="text" class="form-control" maxlength="10" value="<?php echo e(old('number',$candidate->number)); ?>" name="number" id="user_number" placeholder="Enter Ten digits Number" >
          <?php if($errors->has('number')): ?>
          <span class="text-danger"><?php echo e($errors->first('number')); ?></span>
          <?php endif; ?>
        </div>
        <div class="col-6 ">
          <label for="age" class="form-label">Age</label>
          <input type="text" class="form-control" name="age" maxlength="2" value="<?php echo e(old('age',$candidate->age)); ?>" id="user_age" placeholder="Enter Age" >
          <?php if($errors->has('age')): ?>
          <span class="text-danger"><?php echo e($errors->first('age')); ?></span>
          <?php endif; ?>
        </div>    
        <div> 
          <img src="/images/<?php echo e($candidate->file); ?>" class="" width="80" height="60" alt="Unable to load">
        </div>
        <div class="input-group mb-3 p-2">
            <input type="file" class="form-control" value="<?php echo e(old('file')); ?>" name="file" id="User_file">
            <label class="input-group-text" for="file">Upload</label>
            <?php if($errors->has('file')): ?>
          <span class="text-danger"><?php echo e($errors->first('file')); ?></span>
          <?php endif; ?>
          </div>
          <div class="col-md-6p-2 ">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" value="<?php echo e(old('email',$candidate->email)); ?>" name="email" id="user_email" placeholder="Enter Email">
            <?php if($errors->has('email')): ?>
          <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
          <?php endif; ?>
          </div>
        <div class="col-12 p-2">
          <button id="submit" class="btn btn-dark mt-2">Update</button> 
        </div>
      </form>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script>
  document.getElementById("user_age").addEventListener("keypress", function(event) {
  var key = event.keyCode;
  // Only allow numbers to be entered
  if (key < 48 || key > 57) {
    event.preventDefault();
  }
});
</script>
<script>
  document.getElementById("user_number").addEventListener("keypress", function(event) {
  var key = event.keyCode;
  if (key < 48 || key > 57) {
    event.preventDefault();
  }
});
</script>
      <script>
          $(document).ready(function () {
              $('#country_dd').on('change', function () {
                  var idCountry = this.value;
                  $("#state_dd").html('');
                  $.ajax({
                      url: "<?php echo e(url('api/fetch-states')); ?>",
                      type: "POST",
                      data: {
                          country_id: idCountry,
                          _token: '<?php echo e(csrf_token()); ?>'
                      },
                      dataType: 'json',
                      success: function (result) {
                          $('#state_dd').html('<option value="">Select State</option>');
                          $.each(result.states, function (key, value) {
                              $("#state_dd").append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                          $('#city_dd').html('<option value="">Select City</option>');
                      }
                  });
              });
              $('#state_dd').on('change', function () {
                  var idState = this.value;
                  $("#city_dd").html('');
                  $.ajax({
                      url: "<?php echo e(url('api/fetch-cities')); ?>",
                      type: "POST",
                      data: {
                          state_id: idState,
                          _token: '<?php echo e(csrf_token()); ?>'
                      },
                      dataType: 'json',
                      success: function (res) {
                          $('#city_dd').html('<option value="">Select City</option>');
                          $.each(res.cities, function (key, value) {
                              $("#city_dd").append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                      }
                  });
              });
              $('#city_dd').select2({
            closeOnSelect: false
              });
              $('#user_form').on('submit',function(yo){
                yo.preventDefault();
                
                $.ajax({
                  type: "POST",
                  url: "<?php echo e(url('candidates/update')); ?>",
                  data: new FormData(this),
                  dataType: 'json',
                  processData:false,
                  contentType:false,
                  success: function(result) {
                    console.log('yoyoyo');
          },error: function(data) {
            window.location = "<?php echo e(route('candidates.index')); ?>"
          }
                });
              });
             
          });
      </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\jeet_fitness\resources\views\candidates\edit.blade.php ENDPATH**/ ?>