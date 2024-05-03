<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\{country,state, city};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Mycontroller extends Controller
{
    public function admin(){
        return view('auth.admin');
    }
    public function loginindex(){
        $user['users']=Candidate::loginindex();
        return view('auth.loginindex',$user);
    }
    public function index(){
        $user1['candidates'] =  Candidate::index();
        return view('candidates.index',$user1);
    }
    public function create(){
        $data['countries']=Candidate::create();
        return view('candidates.create',$data);
    }
    public function store(Request $request){
        $request->validate([
           'name'=>'required',
           'address'=>'required',
           'country'=>'required',
           'state'=>'required',
           'city'=>'required',
           'gender'=>'required',
           'number'=>'required',
           'age'=>'required',
           'file'=>'required|mimes:jpeg,jpg,png|max:10000',
           'email'=>'required|email',
        'password' => 'required'
        ]);
        $data['candidates']=Candidate::store($request);

        return true;
        // redirect("/");
        // back()->withSuccess($data);   
    }
    public function edit($id){
        $userdata=Candidate::edit($id);
        $data['candidate']= $userdata;
        // dd($data);
        $data['cities'] = Candidate::statecity($userdata->state);
        $data['countries']=Candidate::create();
        $data['states']=Candidate::allState();
        $data['cities']=Candidate::allCities();
        return view('candidates.edit',$data);
    }
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'country'=>'required',
            'state'=>'required',
            // 'city'=>'required',
            'gender'=>'required',
            'number'=>'required',
            'age'=>'required',
            // 'file'=>'required|mimes:jpeg,jpg,png|max:10000',
            'email'=>'required|email',
         ]);
        $data=Candidate::update1($request);
            return $data;
    }
    public function destroy($id){
        $data['candidate']=Candidate::dest($id);
        return back();
    }
    public function fetchState(Request $request)
    {
        $data['states'] = Candidate::state($request->country_id);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities']= Candidate::city($request->state_id);
        return response()->json($data);
    }
public function login(){
    // dd('hello');
     if(session::has('email','password')){
    return redirect("/index");
    }
    else{
        return view("auth.login");
    }
    
    return view("auth.login");
}
public function logout(){
    Session::flush();
    return redirect("/userlogin");
}
    public function loginPost(Request $request){
        $request->validate([
            "email"=>"required|email",
            "password"=>['required', Password::min(8)->mixedCase()],
         ]);

        $data= Candidate::loginPost($request);
        if($data){
        Session::put('email',$data->email);
        Session::put('password',$data->password);
        Session::put('role',$data->role);

    }
    // if($data){
    //          Session::put('role',$data->role);
    //      }
        // dd($data);
        return response()->json($data);
    }


    
public function register(){
    return view("auth.register");
}
function registerPost(Request $request){
    $request->validate([
       "name"=>"required",
       "email"=>"required|email",
       "password"=>['required', Password::min(8)->mixedCase()],
   
    ]);
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = $request->role;
      if($user->save()){
           return redirect(route("login"))->with ("success","User registered successfully");
      }
      return redirect("register")->with ("error","Failed to register User");
}
  function changepassword(){
    // dd('hello');
    return view('auth.changepassword');
  }
  function updatepassword(Request $request){
    // dd('hello');
    $request->validate([
        'email' => 'required|email|exists:users'
    ]);
    $token = Str::random(64);
    DB::table('password_reset_tokens')
    ->insert([
        'email'=> $request->email,
        'token' => $token,
        'created_at'=> Carbon::now()
    ]);
    Mail::send("email.changepassword",['token'=>$token],function($message)use($request){
        $message->to($request->email);
        $message->subject("Reset Password");
    });
    // if(!Hash::check($request->oldpassword, auth()->user()->password)){
    //     return back()->with("error", "Old Password Doesn't match!");
    // }
    // User::whereId(auth()->user()->id)->update([
    //     'password' => Hash::make($request->newpassword)
    // ]);

    return back()->with("success", "We sent an email to change password");
  }
  public function resetpassword($token){
    return view('auth.newpassword',compact('token'));
  }

    public function checkContact(Request $request){
        // dd($request->all());
    $data= Candidate::checkContact($request);
    return response()->json($data);
}
    public function resetpasswordpost(Request $request){
        // DB::enableQueryLog();
        $request->validate([
            "email"=>"required|email|exists:users",
            "password"=>"required",
            "confirm_password"=>"required"
        ]);
        // dd($request->all());
        // dd('hello');
        $users=DB::table('password_reset_tokens')
        ->where([
            "email"=>$request->email,
            "token"=>$request->token
        ])
        ->first();
        // dd($users);
        if(!$users){
            return redirect()->to(route("resetpassword"))->with('error','Invalid');
        }
        DB::table('users')
        ->where('email',$request->email)
        ->update([
            "password"=>Hash::make($request->password)
        ]);
        $data=DB::table('password_reset_tokens')
        ->where('email',$request->email)
        ->delete();
        // $query=(DB::getQueryLog());
        // dd($query);
        return redirect()->to(route('login'))->with("success","Password reset success");
    }
    public function roles($id){
        $users['menus']=Candidate::roles($id);
        // dd( $users);
        return view('auth.roles',$users);
    }
    public static function roles1($menu_id){
        // echo $master_id;
        $test = Candidate::roles1($menu_id);
        return $test;
    }
    public function rolesubmit(Request $request){
        // dd($request); 

     
    $role=$request->user_id;
    $users['candidate']=Candidate::rolesubmit($request->data,$role);
        return $users;
    }
    public function rolesindex($id){
        $users['roles'] = Candidate::rolesindex($id);
                $users['menus']=Candidate::roles($id);
        // dd($users);
        return view("auth.rolesindex",$users);
    }
    public function rolesupdate($dataArray, $userID){
        // dd($request);
        
        $data = Candidate::rolesupdate($dataArray, $userID);
        // dd($data);
        return $data;
    }
}