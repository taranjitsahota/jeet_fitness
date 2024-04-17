<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\{country,state, city};
use Illuminate\Support\Facades\DB;

class Mycontroller extends Controller

{
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
    return view("auth.login");
}
    public function loginPost(Request $request){

        $data['users']= Candidate::loginPost($request);
        return response()->json($data);
    }
public function register(){
    return view("auth.register");
}
function registerPost(Request $request){
    $request->validate([
       "name"=>"required",
       "email"=>"required|email",
       "password"=>['required', Password::min(8)->mixedCase()]
    ]);
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
      if($user->save()){
           return redirect(route("login"))->with ("success","User registered successfully");
      }
      return redirect("register")->with ("error","Failed to register User");
}
  function changepassword(){
    return view('auth.changepassword');
  }
  function updatepassword(Request $request){
    $request->validate([
        'oldpassword' => 'required'
    ]);
    if(!Hash::check($request->oldpassword, auth()->user()->password)){
        return back()->with("error", "Old Password Doesn't match!");
    }
    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->newpassword)
    ]);

    return back()->with("status", "Password changed successfully!");
  }

    public function checkContact(Request $request){
        // dd($request->all());
    $data= Candidate::checkContact($request);
    return response()->json($data);
}

}