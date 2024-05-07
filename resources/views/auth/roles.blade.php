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
    {{-- <h1>Users</h1> --}}
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid ">
          <a class="navbar-brand text-light" href="/sai_fitness/index">Registrations</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          </div>
        </div>
      </nav>
      {{-- <div class="container">
        <a href="/create" class="btn btn-dark mt-2">New Registration</a>
      </div>
      <div class="container">
        <a href="{{ url("/logout") }}" class="btn btn-dark mt-2">Logout</a>
      </div> --}}
    
<div>
  <form id="rolesubmit" class="container" method="POST" name="rolesubmit" action="/sai_fitness/rolesindex">
    @csrf
    <input type="hidden" name='user_id' id="user_id" value="{{ $menus['user_id'] }}">
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
            @foreach ($menus['roles'] as $menu)
            @php
            // dd($menu);
          //   $name='Taranjit';
          //   $data=[
          //   'name'=>$name
          // ];
          // dd($data);
            // $menuArray = [];
            // foreach( $menus['roles'] as $role){
            //   array_push($menuArray,$role->menu_id );
            // }
            // dd($menuArray);
            @endphp
                <tr>

                  <td><input type="checkbox" id="{{ $menu->Name }}" name="menuname" for="menu" onclick="return menucheckboxes('{{ $menu->Name }}', this.checked)" >{{ $menu->Name }}</td>
        
                </tr>         
                <?php $submenus = App\Http\Controllers\MyController::roles1($menu->id);
                // dd($submenus);
                foreach ($submenus as $submenu)
                { ?>
                {{-- @php
                  dd($submenu->list);
                @endphp --}}
                  <tr>
                    <td>
                      {{   $submenu->list; }} 
                    </td>
                    
                    <td><input type="checkbox" onclick="return submenucheckbox('{{ $menu->Name }}', this.checked)" name="data[{{ $menu->id }}][{{ $submenu->id }}][add]" value="1" class="{{ $menu->Name }}"></td>
                     <td><input type="checkbox" onclick="return submenucheckbox('{{ $menu->Name }}', this.checked)" name="data[{{ $menu->id }}][{{ $submenu->id }}][edit]" value="1" class="{{ $menu->Name }}"></td>
                     <td><input type="checkbox" onclick="return submenucheckbox('{{ $menu->Name }}', this.checked)" name="data[{{ $menu->id }}][{{ $submenu->id }}][delete]" value="1" class="{{ $menu->Name }}"></td>
                    <td><input type="checkbox" onclick="return submenucheckbox('{{ $menu->Name }}', this.checked)" name="data[{{ $menu->id }}][{{ $submenu->id }}][view]" value="1" class="{{ $menu->Name }}"></td>
              </tr>

          <?php  } ?>
            @endforeach
           
          </tbody>
      </table>
      <button type="submit" value="submit" class="btn btn-dark mt-2" onclick="return validateForm()" id="rolesubmit">Submit</button>
    </form>
    </div>


<script>
  const menucheckboxes = (className, isChecked) => {
      const subMenuCheckboxes = document.querySelectorAll(`.${className}`);
      subMenuCheckboxes.forEach(checkbox => {
          checkbox.checked = isChecked;
      });
  }
</script>
<script>
  const submenucheckbox = (className, isChecked) => {
      const menuCheckbox = document.querySelector(`#${className}`);
      menuCheckbox.checked = isChecked;
    }
</script>
<script>
  function validateForm() {
    // Get all checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let isChecked = false;

    // Check if at least one checkbox is checked
    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        isChecked = true;
      }
    });

    // If no checkbox is checked, display an alert
    if (!isChecked) {
      alert('Please select at least one checkbox.');
      return false; // Prevent form submission
    }
    
    // If at least one checkbox is checked, allow form submission
    return true;
  }
</script>

 {{--<script>
  function validateForm() {
    var menuCheckboxes = (className, isChecked) => {
    var submenuCheckboxes = document.querySelectorAll(`.${className}`);
    if (!isMenuChecked || !isSubmenuChecked) {
      alert("Please select at least one submenu for each checked menu.");
    } else {
      document.getElementById('rolesubmit').submit();
    }
  }
  }
</script> --}}

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
      url: "{{ url('/rolesubmit') }}",
      data: new FormData(this),
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
          location.href = "{{ url('/index') }}";
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
</htm>