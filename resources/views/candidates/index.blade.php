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
        <div class="container-fluid ">
          <a class="navbar-brand text-light" href="/">Registrations</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          </div>
        </div>
      </nav>
      <div class="container">
        <a href="/create" class="btn btn-dark mt-2">New Registration</a>
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
            </tr>
          </thead>
          <tbody>
            @foreach ($candidates as $candidate)
            <tr>
              <td>{{ $loop->index+1 }}</td>   
              <td>{{ $candidate->name }}</td>
              <td>{{ $candidate->address }}</td>
              <td>{{  $candidate->Countries_name }}</td>
              <td>{{  $candidate->state_name }}</td>
              <td>{{ $candidate->city_name }}</td>
              <td>{{ $candidate->gender }}</td>
              <td>{{ $candidate->number}}</td>
              <td>{{ $candidate->age }}</td>
              <td>
                <img src="images/{{ $candidate->file }}" class="" width="80" height="60" alt="Unable to load">
              </td>
              
              
                
              <td>{{ $candidate->email }}</td>
              <td>{{ $candidate->password }}</td>
              <td>
                <a href="edit/{{ $candidate->id }}" class="btn btn-dark btn-sm">Edit</a>
                <a href="candidates/{{ $candidate->id }}/delete" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
            @endforeach
           
          </tbody>
          
      </table>
     
    </div>
</body>
</html>