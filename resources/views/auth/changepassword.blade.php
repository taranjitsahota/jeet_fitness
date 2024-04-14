@extends("layouts.layout")
@section("title","Change Password")
@section("content")

<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          @if (session('status'))
          <div class="alert alert-success">
             {{ session("status") }}
          </div>
        
          @elseif (session("error"))
          <div class="alert alert-danger">
             {{ session("error") }}
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
  
                  <form method="POST" action="{{ route('updatepassword') }}">
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Change your account Password</h5>
  
                    <div class="form-outline mb-4">
                      <input type="text" name="oldpassword" id="form2Example17" class="form-control form-control-lg" />
                      <label class="form-label"  for="form2Example17">Old Password</label>
                      @if($errors->has('oldpassword'))
                    <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                 @endif
                    </div>
                    
  
                    <div class="form-outline mb-4">
                      <input type="text" name="newpassword" id="form2Example27" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">New Password</label>
                      @if($errors->has('newpassword'))
                      <span class="text-danger">{{ $errors->first('newpassword') }}</span>
                   @endif
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="newpassword" id="form2Example27" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example27">Confirm Password</label>
                        @if($errors->has('newpassword'))
                        <span class="text-danger">{{ $errors->first('newpassword') }}</span>
                     @endif
                      </div>
  

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Update Password</button>
                    </div>
                    
  
                    
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



@endsection