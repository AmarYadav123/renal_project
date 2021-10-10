<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use rtrim;
use PhpParser\Node\Stmt\Echo_;

class UserController extends Controller
{
    public function index(){
        $role=Auth::user()->role;

        // adminlogin
        if($role=='2'){

            $name=Auth::user()->name;

            return view('admin.dashboard',compact('name'));
        }

        // doctorlogin
        else if($role=='1')
        {
            $name=Auth::user()->name;

            return view('doctor.showwork',compact('name'));


        }

        // staff
        else if($role=='0')
        {

            $namestaff=Auth::user()->name;

            return view('Staff.showworkstaff',compact('namestaff'));

        }



    }






// doctor add------------------------------------------------------------------>
    public function adddoctor(){

        $name=Auth::user()->name;

        $doctor=User::where('role','1')->get();

        return view('doctor.adddoctor',compact('doctor','name'));
    }

    public function doctor_insert(Request $a){


        $user_count=User::where('email',$a->email)->count();
        if($user_count>0){
            return redirect()->back()->with('message','Email already present');
        }


        else{


            $data= new User();
            $data->name=$a->name;
            $data->email=$a->email;
            $data->phone=$a->phone;
            $data->role=$a->role;
            $data->password=Hash::make($a->password);
            $data->save();


            }

        // echo"<pre>";
        // print_r($a->all());


        if($data){
            return redirect('adddoctor');
        }

    }




// add staff----------------------------------------------------------------->
    public function addstaff(){
        $staff=User::where('role','0')->get();
        $name=Auth::user()->name;


        return view('Staff.staff',compact('staff','name'));
    }

    public function staff_insert(Request $a){

        $user_count=User::where('email',$a->email)->count();
        if($user_count>0){
            return redirect()->back()->with('message','Email already present');
        }


        else{


            $data= new User();
            $data->name=$a->name;
            $data->email=$a->email;
            $data->phone=$a->phone;
            $data->role=$a->role;
            $data->password=Hash::make($a->password);
            $data->save();


            }




        if($data){
            return redirect('addstaff');
        }
    }


// register patient ------------------------------------------------------------>



    public function registerpatient(){
       $pa=Patient::all();
       $namestaff=Auth::user()->name;

    //    echo"<pre>";
    //    print_r($pa);
        return view('Staff.registerpatient',compact('pa','namestaff'));
    }

    public function patient_insert(Request $a){
        $user_count=User::where('email',$a->email)->count();
        if($user_count>0){
            return redirect()->back()->with('message','Email already present');
        }

        else{


        $data= new patient();
        $data->name=$a->name;
        $data->phone=$a->phone;
        $data->age=$a->age;

        $data->dob=$a->dob;
        $data->save();

        }




        if($data){
            return redirect('registerpatient');
        }



    }

// add admin--------------------------------------------------------------------------->
     public function addadmin(){
        $name=Auth::user()->name;
        $admin=User::where('role','2')->get();



         return view('admin.addadmin',compact('admin','name'));
     }

     public function admin_insert(Request $a){
        $user_count=User::where('email',$a->email)->count();
        if($user_count>0){
            return redirect()->back()->with('message','Email already present');
        }
        else{

            $data= new User();
            $data->name=$a->name;
            $data->email=$a->email;
            $data->phone=$a->phone;
            $data->role=$a->role;
            $data->password=Hash::make($a->password);
            $data->save();

        }





        if($data){
            return redirect('addadmin');
        }


    }



// showing data with graph in doctor dashboard----------------------------------------------------->

    public function graph_page(){
        $name=Auth::user()->name;

        $result=DB::select(DB::raw("SELECT count(*) as perday_patients,created_at from patients group by created_at"));
        // dd($result);
        $chartdata="";
        foreach($result as $list){
            $chartdata.="['".$list->created_at."', ".$list->perday_patients."]";
        }
        $chartdata=rtrim($chartdata,"");

        // echo $chartdata;
        // $arr['char']
        return view('doctor.graph',compact('chartdata','name'));
    }
}
