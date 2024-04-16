@extends("layouts.layout")
@section("title","Login")
@section("content")

<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          @if (session()->has("success"))
          <div class="alert alert-success">
             {{ session()->get("success") }}
          </div>
          @endif
          @if (session()->has("error"))
          <div class="alert alert-danger">
             {{ session()->get("error") }}
          </div>
          @endif
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form id="user_form" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
  
                    <div class="form-outline mb-4">
                      <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control form-control-lg" />
                      <label class="form-label"  for="form2Example17">Email address</label>
                      @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                 @endif
                    </div>
                    
  
                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="password" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                      @if($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                   @endif
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" id="login" type="submit">Login</button>
                    </div>
  
                    <a class="small text-muted" href="/changepassword">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/register"
                        style="color: #393f81;">Register here</a></p>
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
                email: {
                    required: true
                },
                password: {
                    required: true
                },

            },
            messages: {
              email: 'Required',
              password: 'Required'
             

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    $('#login').click(function(e){

      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      })

      e.preventDefault();
      var email = $('#email').val();
      var password = $('#password').val();

      $.ajax({
        url:"{{ url('login') }}",
        type:'POST',

        data:{
          email:email,
          password:password

        },
        success:function(data){
        console.log(data.users);
         
          if($.isEmptyObject(data.error)){
            if(data.users==1){
              window.location="{{ route('candidates.index') }}"
            }
            else{
            alert('Not registered or invalid credentials')
          } 
           
        }
          else{
            alert('Not registered or invalid credentials')
          }
        }

      });
    });
  });
</script>
@endpush

