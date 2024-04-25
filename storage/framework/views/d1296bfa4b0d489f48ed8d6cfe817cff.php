<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
    
      

    <form id="user_form" name="user_form" class="row p-4" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data" action="candidate/store" >
        <?php echo csrf_field(); ?>
        <div class="col-md-6 ">
          <label for="name" class="form-label">Name</label>
          <input type="text" value="" class="form-control" name="name" id="user_name" placeholder="Please Enter Your Name">
          <?php if($errors->has('name')): ?>
          <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
          <?php endif; ?>
        </div>
        
        
        <div class="col-md-6 ">
          <label for="addrress" class="form-label">Addrress</label>
          <input type="text" value="" class="form-control" name="address" id="user_address" placeholder="Flat No./Floor No./apartment">
          <?php if($errors->has('address')): ?>
          <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
          <?php endif; ?>
        </div>

        <div class="col-md-4 p-2">
          <label for="country" class="form-label">Country</label>
          <select name="country" id="country_dd" class="form-select">
            
            <option value="" selected disabled >Choose...</option>

        
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option value="<?php echo e($data->id); ?>">
                    <?php echo e($data->name); ?>

                  </option>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('country')): ?>
          <span class="text-danger"><?php echo e($errors->first('country')); ?></span>
          <?php endif; ?>
        </div>
        <div class="col-md-4 p-2">
            <label for="state" class="form-label">State</label>
            <select name="state" id="state_dd" class="form-select">
              <option value="" selected disabled >Choose...</option>
            </select>
            <?php if($errors->has('state')): ?>
            <span class="text-danger"><?php echo e($errors->first('state')); ?></span>
            <?php endif; ?>
          </div>
          <div class="col-md-4 p-2">
            <label for="city" class="form-label">City</label>
            <select name="city[]" id="city_dd" class="form-control select2" multiple>
              <option value=""selected disabled >Choose...</option>
            </select>
            <?php if($errors->has('city')): ?>
          <span class="text-danger"><?php echo e($errors->first('city')); ?></span>
          <?php endif; ?>
          </div>
          <label for="gender">Gender:</label>
          <div>
            <div class="form-check p-2">
            <input class="form-check-input p-2" id="user_gender" value="male"  type="radio" name="gender">
            <label class="form-check-label"  for="user_gender">
              Male
            </label>
          </div>
          <div class="form-check p-2">
            <input class="form-check-input p-2" value="female" type="radio" name="gender">
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
          <input type="tel" class="form-control" value="" name="number" maxlength="10" id="number" placeholder="Enter Ten digits Number" >
          <span id="contactError" style="color: red;"></span>
          <?php if($errors->has('number')): ?>
          <span class="text-danger"><?php echo e($errors->first('number')); ?></span>
          <?php endif; ?>
        </div>
      

        <div class="col-6 ">
          <label for="age" class="form-label">Age</label>
          <input type="text" class="form-control" name="age" value="" id="user_age" maxlength="2" placeholder="Enter Age">
          <?php if($errors->has('age')): ?>
          <span class="text-danger"><?php echo e($errors->first('age')); ?></span>
          <?php endif; ?>
        </div>
        <div class="input-group mb-3 p-2">
            <input type="file" class="form-control" value="" name="file" id="User_file">
            <label class="input-group-text" for="file">Upload</label>
            <?php if($errors->has('file')): ?>
          <span class="text-danger"><?php echo e($errors->first('file')); ?></span>
          <?php endif; ?>
          </div>
       
          <div class="col-md-5 p-2 ">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" value="" name="email" id="user_email" placeholder="Enter Email">
            <?php if($errors->has('email')): ?>
          <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
          <?php endif; ?>
          </div>
          <div class="col-md-5 p-2">
            <label for="password" class="form-label">Password (Min=8,Uppercase & Lowercase)</label>
            <input type="password" class="form-control"  name="password" id="user_password" placeholder="Enter Password">
            <?php if($errors->has('password')): ?>
          <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
          <?php endif; ?>
          </div>
        
        <div class="col-12 p-2">
        
        <button type="submit" value="submit" id="submit" name="submit" class="btn btn-dark mt-2" >Sign in</button>
  
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
  document.getElementById("number").addEventListener("keypress", function(event) {
  var key = event.keyCode;
  // Only allow numbers to be entered
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

$("#user_form").on('submit', (function(e) {

    e.preventDefault();

    $(".form_error").html("");
    $(".form_error").removeClass("alert alert-danger");


    $.ajax({
        type: "POST",
        url: "<?php echo e(url('candidates/store')); ?>",
        data: new FormData(this),
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(result) {
            location.href = "<?php echo e(url('/index')); ?>";
        },
        error: function(data) {
            var responseData = data.responseJSON;
            if (responseData.error_type == 'form') {
                jQuery.each(responseData.errors, function(i, val) {
                    $("#form-error-" + i).html(val);
                });
            }
        }
    });

}));
    });

    </script>
    <script>
      $(document).ready(function() {
          $('#user_form').validate({
              rules: {
                name: {
                      required: true,
                      minlength: 8
                  },
                  address: {
                      required: true
                  },
                  country: {
                      required: true
                  },
                  state: {
                      required: true
                  },
                  city: {
                      required: true, 
                  },
                  gender: {
                      required: true
                  },
                  number: {
                      required: true
                  },
                  age: {
                      required: true
                  },
                  file: {
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
                name : 'Required',
                address: 'Required',
                country : 'Required',
                state : 'Required',
                city: 'Required',
                gender: 'Required',
                number : 'Required',
                age: 'Required',
                file: 'Required',
                email: 'Required',
                password: 'Required'
              },
          });
      });
  </script>
  <script>
$(document).ready(function() {
  $('#number').blur(function(e) {
    // console.log("Blur event triggered");
    $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      })

      e.preventDefault();
        var number = $('#number').val();
        // console.log(number);
        $.ajax({
          type: "POST",
          dataType: 'json',
          // cache:false,
          // contentType : false,
          //   processData : false,
            url: "/sai_fitness/checkContact",
            data:{
              number:number
            },

            success:function(data) {
              // console.log(data);
                // if ($.isEmptyObject(data.error)) {
                  if(data==0){
                    // window.location="<?php echo e(route('candidates.index')); ?>"
                    // alert('new user');
                    $('#contactError').html('');
                    $('#submit').prop('disabled', false);
                } else {
                  // console.log(number)
                  // alert('contact already existed')
                    $('#contactError').html('Contact number already exists.');
                    $('#submit').prop('disabled', true);
                // }
              }
            }
        });
    });

  });
  </script> 
</body>
</html>


<?php /**PATH C:\xampp\htdocs\sai_fitness\resources\views/candidates/create.blade.php ENDPATH**/ ?>