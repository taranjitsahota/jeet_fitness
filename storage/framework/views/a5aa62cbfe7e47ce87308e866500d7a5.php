<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  <style>
    .table{
      border: 2px solid black;
    }
    td,
    th{
      border: 1px solid black;
    }
  </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-dark">

      <?php
  // dd(Session::has('role'));
  ?>

<?php if(Session::has('role')): ?>
<a class="navbar-brand text-light" href="/sai_fitness/loginindex">Users</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    
<?php endif; ?>


        

          <a class="navbar-brand text-light" href="/sai_fitness/index">Registrations</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          </div>
        </div>
      </nav>
      <div class="container">
        <a href="/sai_fitness/create" class="btn btn-dark mt-2">New Registration</a>
      </div>
      <div class="container">
        <a href="<?php echo e(url("/logout")); ?>" class="btn btn-dark mt-2">Logout</a>
      </div>
    
<div>
    <table class="table container table-hover mt-2">
        <thead>
            <tr>
              <th scope="col">Sr No.</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Country</th>
              <th scope="col">State</th>
              <th scope="col">City</th>
              <th scope="col">Gender</th>
              <th scope="col">Number</th>
              <th scope="col">Age</th>
              <th scope="col">File</th>
              <th scope="col">E-mail</th>
              <th scope="col">Password</th>
              <th scope="col">Actions</th>
              <th scope="col">Roles</th>
            </tr>
          </thead>
          <tbody>
            
            <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
              <td><?php echo e($loop->index+1); ?></td>   
              <td><?php echo e($candidate->name); ?></td>
              <td><?php echo e($candidate->address); ?></td>
              <td><?php echo e($candidate->Countries_name); ?></td>
              <td><?php echo e($candidate->state_name); ?></td>
              <td><?php echo e($candidate->city); ?></td>
              <td><?php echo e($candidate->gender); ?></td>
              <td><?php echo e($candidate->number); ?></td>
              <td><?php echo e($candidate->age); ?></td>
              <td>
                <img src="images/<?php echo e($candidate->file); ?>" class="" width="80" height="60" alt="Unable to load">
              </td>
              <td><?php echo e($candidate->email); ?></td>
              <td><?php echo e($candidate->password); ?></td>
              <td class="container">
                <a href="edit/<?php echo e($candidate->id); ?>" class="btn btn-dark btn-sm">Edit</a>
                <a href="candidates/<?php echo e($candidate->id); ?>/delete" class="btn btn-danger btn-sm">Delete</a>
              </td>
              <td class="container">
                <a href="/sai_fitness/roles/<?php echo e($candidate->id); ?>" class="btn btn-dark btn-sm">Add</a>
                <a href="/sai_fitness/rolesupdate/<?php echo e($candidate->id); ?>" class="btn btn-dark btn-sm">Update</a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
          </tbody>
          
      </table>
     
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\sai_fitness\resources\views/candidates/index.blade.php ENDPATH**/ ?>