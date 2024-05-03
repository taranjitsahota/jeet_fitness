<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  

  <style>
    .table{
      border: 2px solid black;
      width: 20%;
      float: left;
    }
    td,
    th{
      border: 1px solid black;
    }
  </style>
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
      <h3 class="text-muted">Role Edit #<?php echo e($roles['user_id']); ?></h3>
<div>
  <form id="rolesubmit" class="container" method="POST" name="rolesubmit" action="/sai_fitness/rolesupdate">
    <?php echo csrf_field(); ?>
    
    <input type="hidden" name='user_id' id="user_id" value="<?php echo e($roles['user_id']); ?>">
   <input type="hidden" name='menu_id' id="menu_id" value="<?php echo e(($roles['users'][0]->menu_id)); ?>">
     <input type="hidden" name='submenu_id' id="submenu_id" value="<?php echo e($roles['users'][0]->submenu_id); ?>">
    <table class="table container table-hover mt-2">
      <thead> 
            <tr>
              <th scope="col">Menu</th>
              <th scope="col">add</th>
              <th scope="col">edit</th>
              <th scope="col">delete</th>
              <th scope="col">view</th>
            </tr>
          </thead>
          <tbody>
          
            
            <?php $__currentLoopData = $roles['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <tr>
                    <td><input value="1"<?php echo e($user->menu_name == $user->menu_name ? 'checked' : ''); ?> type="checkbox" ><?php echo e($user->menu_name); ?> </td>
                </tr>
                <tr>
                    <td><?php echo e($user->submenu_name); ?></td>
                
                    <td><input type="checkbox" name="add" value="1"<?php echo e($user->add =='1' ? 'checked' : ''); ?>></td>
                     <td><input type="checkbox" name="edit" value="1"<?php echo e($user->edit =='1' ? 'checked' : ''); ?>></td>
                     <td><input type="checkbox" name="delete" value="1"<?php echo e($user->delete =='1' ? 'checked' : ''); ?>></td>
                    <td><input type="checkbox" name="view" value="1"<?php echo e($user->view =='1' ? 'checked' : ''); ?>></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
          </tbody>
      </table>
      <button type="submit" value="submit" class="btn btn-dark mt-2" id="roleupdate">update</button>
    </form>
    </div>
    
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
$("#rolesubmit").on('submit', (function(e) {
 console.log("hey")

  e.preventDefault();

  $(".form_error").html("");
  $(".form_error").removeClass("alert alert-danger");

  $.ajax({
      type: "POST",
      url: "<?php echo e(url('/rolesupdate')); ?>",
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
</body>
</html><?php /**PATH C:\xampp\htdocs\sai_fitness\resources\views\auth\rolesindex.blade.php ENDPATH**/ ?>