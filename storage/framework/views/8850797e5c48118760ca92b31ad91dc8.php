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
      
    
<div>
  <form id="rolesubmit" class="container" method="POST" name="rolesubmit" action="/sai_fitness/rolesindex">
    <?php echo csrf_field(); ?>
    <input type="hidden" name='user_id' id="user_id" value="<?php echo e($menus['user_id']); ?>">
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
          
            <?php $__currentLoopData = $menus['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            // dd($roles);
            $menuArray = [];
            foreach( $roles['users'] as $role){
                array_push($menuArray,$role->menu_id );
            }
            // dd($menuArray);
            $submenuArray = [];
            foreach( $roles['users'] as $role){
                array_push($submenuArray,$role->submenu_id );
            }
            // dd($submenuArray);
            $add = [];
            foreach( $roles['users'] as $role){
              $add[$role->submenu_id]= $role->add;
            }
            $edit = [];
            foreach( $roles['users'] as $role){
              $edit[$role->submenu_id]= $role->edit;
            }
            // dd($edit);
            $delete = [];
            foreach( $roles['users'] as $role){
              $delete[$role->submenu_id]= $role->delete;
            }
            // dd($delete);
            $view = [];
            foreach( $roles['users'] as $role){
              $view[$role->submenu_id]= $role->view;
            }
            // dd($view);
            // dd($add);
          //   $name='Taranjit';
          //   $data=[
          //   'name'=>$name
          // ];
          // dd($data)
          ?>
                  <?php if(in_array($menu->id,$menuArray)): ?>
                <tr>

                  <td>
                      <input checked type="checkbox" class="menu" name="menuname" for="menu" onclick="return menucheckboxes('<?php echo e($menu->Name); ?>', this.checked)" ><?php echo e($menu->Name); ?></td>
                      
                    
                    
                    

                    
                </tr>
                
                <?php $submenus = App\Http\Controllers\MyController::roles1($menu->id);
                // dd($submenus);
                foreach ($submenus as $submenu)
                { ?>
                    <?php if(in_array($submenu->id,$submenuArray)): ?>
                  <tr>
                    <td>
                      <?php echo e($submenu->list); ?> 
                    </td>
                   
                    <?php
                      $string = $menu->id . $submenu->id;
                    ?>
                    <td>
                      <?php if($add[$submenu->id] == 1): ?> 
                      <input type="checkbox" class="submenu" name="add[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" checked class="<?php echo e($menu->Name); ?>">
                      <?php else: ?>
                      <input type="checkbox" class="submenu" name="add[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" class="<?php echo e($menu->Name); ?>">
                      <?php endif; ?>
                    </td>
                     <td>
                      <?php if($edit[$submenu->id] == 1): ?>
                      <input type="checkbox" name="edit[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" checked class="<?php echo e($menu->Name); ?>">
                      <?php else: ?>
                      <input type="checkbox" name="edit[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" class="<?php echo e($menu->Name); ?>">
                      <?php endif; ?>
                    </td>
                     <td>
                      <?php if($delete[$submenu->id] == 1): ?>
                      <input type="checkbox" name="delete[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" checked class="<?php echo e($menu->Name); ?>">
                      <?php else: ?>
                      <input type="checkbox" name="delete[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" class="<?php echo e($menu->Name); ?>">
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($view[$submenu->id] == 1): ?>
                      <input type="checkbox" name="view[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" checked class="<?php echo e($menu->Name); ?>">
                      <?php else: ?>
                      <input type="checkbox" name="view[<?php echo e($menu->id); ?>][<?php echo e($submenu->id); ?>]" value="1" class="<?php echo e($menu->Name); ?>">
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endif; ?>
              <?php  } ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
          </tbody>
      </table>
      <button type="submit" value="submit" class="btn btn-dark mt-2" id="rolesubmit">Update</button>
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
      url: "<?php echo e(url('/rolesubmit')); ?>",
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
</html><?php /**PATH C:\xampp\htdocs\jeet_fitness\resources\views\auth\rolesindex.blade.php ENDPATH**/ ?>