<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Candidate extends Model
{
    use HasFactory;
    
    public static function index(){
        $users = DB::table('candidates')
        ->select("candidates.*",
        "countries.name as Countries_name",
        "states.name as state_name",
        "cities.name as city_name"
        )
        ->leftJoin('countries','countries.id','=','candidates.country')
        ->leftJoin('states','states.id','=','candidates.state')
        ->leftJoin('cities','cities.id','=','candidates.city')
        ->whereNULL('is_deleted')
        ->get();
        // $query = user::select("*")->toSql();
        // dd($query);
        // $query=DB::table('candidates')->toSql();
        // dd($query);
        // $query=$users->toSql();
        // dd($query);
        // dd($users);
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
            // "city"=>$request->city,
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
        if($candidateID){
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
    public static function loginPost($request){
        $email = $request->input('email');
    $password = $request->input('password');
            $users=DB::table('users')
            ->where('email',$email)->first();
            if ($users) {
                if (Hash::check($password, $users->password)) {
                    return 1;
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
    
}







