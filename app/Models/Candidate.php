<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Candidate extends Model
{
    use HasFactory;

    public static function loginindex(){
        $email = session()->get('email');
        $user =DB::table('users')
        ->where('email', $email)
        ->first();

        if($user->role==1){
        $users = DB::table('users')
        ->get();
        }
        return $users;
    }
    public static function index(){
        DB::enableQueryLog();

        // $email = session()->get('email');
        // $user =DB::table('users')
        // ->where('email', $email)
        // ->first();
 
        // if($user->role==1){
            $users = DB::table('candidates')
        ->select("candidates.*",
         "countries.name as Countries_name",
        "states.name as state_name"
        //  "cities.name as city_name"
         )
         ->Join('countries','countries.id','=','candidates.country')
             ->Join('states','states.id','=','candidates.state')
            //  ->join('cities','cities.id','=','candidates.city')
            ->whereNull('is_deleted')
        ->get();
        foreach($users as $user){
            $cityArray=[];
            $candidatecities = DB::table('multiplecities')
            ->select('cities.name')
            ->join('cities','cities.id','=','multiplecities.city')
            ->where('multiplecities.candidate_id',$user->id)
            ->get();
            foreach( $candidatecities as $cities){
                array_push($cityArray,$cities->name );
            }
            $usercity = implode(',', $cityArray);
            $user->city=$usercity;
        }
        $query=(DB::getQueryLog());
        // dd($query);
        return $users;
    }
    public static function create(){
        $users = DB::table('countries')
        ->select('name','id')
        ->get();
        return $users;
    }
    public static function store($request){
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('images'),$fileName);
       
        $data=array(
            "name"=>$request->name,
            "address"=>$request->address,
            "country"=>$request->country,
            "state"=>$request->state,
            "gender"=>$request->gender,
            "number"=>$request->number,
            "age"=>$request->age,
            "file"=>$fileName,
            "email"=>$request->email,
            "password"=>$request->password
        );
        // dd($request->number);
        $candidateID = DB::table('candidates')
        ->insertGetId($data);
        $citydata=$request->input('city');
        foreach($citydata as $city){

           $user1=[
                'candidate_id' =>$candidateID,
                'state' =>$request->state,
                'city' =>$city
           ];
            $users = DB::table('multiplecities')
            ->insert($user1);
            // dd($user1);
        }
        // dd($data);
        if($data){
            return 'Candidate registred!!';
        }else{
            return 'Candidate not registred!!';
        }
    }
    public static function edit($id){
        $users = DB::table('candidates')
        ->where('id',$id) 
        ->first();
        // dd($users);
          $users->city = DB::table('multiplecities')
        ->where('candidate_id',$id)
        ->get();
        return $users;
    }
    public static function allState(){
        $users = DB::table('states')
        ->get();
        return $users;
    }
    public static function allCities(){
        $users = DB::table('cities')
        ->get();
        return $users;
    }
    public static function update1($request){
         if(isset($request->file)){
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'),$fileName);
            }
        $data=[
            "name"=>$request->name,
            "address"=>$request->address,
            "country"=>$request->country,
            "state"=>$request->state,
            "gender"=>$request->gender,
            "number"=>$request->number,
            "age"=>$request->age,
            // "file"=>$fileName,
            "email"=>$request->email
        ];
        // dd($data);
        $user = DB::table('candidates')
        ->where('id',$request->id)
        ->update($data);
        $citydata=$request->input('city');
        // dd($request->id);
        // dd($citydata);
        //    dd($user);
           $user=DB::table('multiplecities')
           ->where('candidate_id',$request->id)
           ->delete();
        
            foreach($citydata as $city){
                $user1=[
                    'candidate_id' =>$request->id,
                    'state' =>$request->state,
                    'city' =>$city
               ];
        //    dd($users);
           $users = DB::table('multiplecities')
           ->where('candidate_id',$request->id)
            ->insert($user1);
         }
     return 'done';
    }
    public static function dest($id){
           $users = DB::table('candidates')
           ->where('id',$id)
           ->update(["is_deleted"=>1]);
           return $users;
    }
    public static function state($country_id){
        $users = DB::table('states')
        ->where('country_id', $country_id)
        ->get();
        return $users;
    }
    public static function city($state_id){
        $users = DB::table('cities')
        ->where('state_id', $state_id)
        ->get();
        // dd($users);
        return $users;
    }
    // public static function registerpost($request){
    //     $data=[
    //     $name = $request->name,
    //     $email = $request->email,
    //     $password = Hash::make($request->password)
    //     ];
    //     $user = DB::table('users')
    //     ->insert($data);
        // if($user)
    // }
    public static function loginPost($request){
        $email = $request->input('email');
    $password = $request->input('password');
            $users=DB::table('users')
            ->where('email',$email)->first();

            // dd($users);
            // Session::put('email',$users->email);
            // Session::put('password',$users->password);
            if ($users) {
                if (Hash::check($password, $users->password)) {
                    return $users;
                } else {
                    return 0;
                }
            } else {
                return 0; 
            }
    }
    public static function checkContact($request)
    {

        $number = $request->number;
        // dd($number);
        $users=DB::table('candidates')
        ->where('number',$number)
        ->first();
        // dd($users);
        if ($users) {
            return 1; // number exists
        } else {
            return 0; //  number does not exist
        }
    }
    public static function statecity($state_id){
        $users = DB::table('cities')
        ->where('state_id',$state_id)
        ->get();
        // dd($users);
        return $users;
    }
    public static function roles($id){
        // dd($id);
        $data = DB::table('candidates')
        ->where('id',$id) 
        ->first();
        // dd($users);
        $users = DB::table('menu')
        ->select('menu.*')
        // ->Join('submenu','submenu.menu_id','=','menu.id')
        ->get();

        foreach($users as $user){
            $roleArray=[];
            $roles = DB::table('menu')
            ->select('submenu.*','submenu.list')
            ->join('submenu','submenu.menu_id','=','menu.id')
            ->where('submenu.menu_id',$user->id)
            ->get();
            // dd($roles);
            foreach( $roles as $role){
                array_push($roleArray,$role->list );
            }
            // $userrole = implode(',', $roleArray);
            $user->menu_id=$roleArray;
        }
        $finalData = [
            "user_id" =>$data->id,
            "roles" =>[...$users],
        ];
        // dd($finalData);
        return $finalData;
        // dd($users);
        // return $users;
    }
    public static function roles1($menu_id){
    $users = DB::table('submenu')
        ->select('submenu.*')
        ->where('menu_id',$menu_id)
        ->get();
      $r =  json_decode($users);
        // dd( $users );
        return $r;
    }
    public static function rolesubmit($dataArray,$userID){
        // dd($id);
        $roleRecords = [];
        // dd($dataArray);
        foreach ($dataArray as $submenuId => $menus){
        if(!is_array($menus)){
            continue;
        }
            foreach ($menus as $menuId => $submenus) {
                if(!is_array($submenus)){
                    continue;
                }
                foreach($submenus as $submenuId => $data){
                $add = isset($dataArray['add'][$menuId][$submenuId]) ? 1 : 0;
                $edit = isset($dataArray['edit'][$menuId][$submenuId]) ? 1 : 0;
                $delete = isset($dataArray['delete'][$menuId][$submenuId]) ? 1 : 0;
                $view = isset($dataArray['view'][$menuId][$submenuId]) ? 1 : 0;
                $roleRecord = [
                    'candidate_id' => $userID,
                    'menu_id' => $menuId,
                    'submenu_id' => $submenuId,
                    'add' => $add,
                    'edit' =>$edit,
                    'delete' =>$delete,
                    'view' =>$view,
            ];
            $roleRecords[] = $roleRecord;
            // dd($roleRecord);     
            
        }
    }
        $users = DB::table('roles')
        ->insert($roleRecords);
        return $users;
    }
}
    }