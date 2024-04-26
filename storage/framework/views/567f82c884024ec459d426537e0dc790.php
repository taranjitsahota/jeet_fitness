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
      <div class="container">
        <a href="/create" class="btn btn-dark mt-2">New Registration</a>
      </div>
      <div class="container">
        <a href="<?php echo e(url("/logout")); ?>" class="btn btn-dark mt-2">Logout</a>
      </div>
    
<div>
    <table class="table container table-hover mt-2">
        <thead>
            <tr>
              <th scope="col">Menu</th>
            </tr>
          </thead>
          <tbody>
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td><?php echo e($menu->Name); ?></td>
                </tr>
                
                <?php $submenus = App\Http\Controllers\MyController::roles1($menu->id);
                // dd($submenus);
                foreach ($submenus as $i => $submenu)
                { ?>
                  <tr>
                    <td>
                      <?php echo e($submenu->list); ?> 
                    </td>
              </tr>

          <?php       }
                 ?>
                  
                
                    
                    
                      
                        
                      
                    
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
          </tbody>
      </table>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\sai_fitness\resources\views/auth/roles.blade.php ENDPATH**/ ?>