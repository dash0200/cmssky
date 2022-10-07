<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    var $p = "pages.admin.";
    public function adminDashboard() {
        return view($this->p.'dashboard');
    }

    public  function addDoctor() {
        $departments = Departments::get();
        return view($this->p."add-doctor")->with(['departments' => $departments]);
    }

    public  function editDoctorInfo(Request $req) {
        $id = Crypt::decryptString($req->id);
        $doctor = Doctors::where('id', $id)->first();
        $departments = Departments::get();
        return view($this->p."edit-doctor")->with(['departments' => $departments, "doctor" => $doctor]);
    }

    public function storeDoctorInfo(Request $req) {

        $req->validate([
            "fname" => ['required'],
            "mname" => ['nullable'],
            "lname" => ['nullable'],
            "dob" => ['required', 'date'],
            "gender" => ['required', 'numeric'],
            "phone" => ['required', 'numeric', 'gt:13', 'unique:doctors,phone'],
            "email" => ['required', 'email', 'unique:users,email', 'unique:doctors,email'],
            "city" => ['required'],
            "address" => ['required', 'max:455'],
            "departments" => ['required', 'numeric'],
        ]);
        
        $data = [
            "name" => $req->fname,
            "mname" => $req->mname,
            "lname" => $req->lname,
            "dob" => $req->dob,
            "gender" => $req->gender,
            "phone" => $req->phone,
            "email" => $req->email,
            "city" => $req->city,
            "address" => $req->address,
            "department_id" => $req->departments,
        ];
        try {
            $doctor = Doctors::create($data);

            User::create([
                'name' => $req->fname,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'user_type' => 'doctor',
                'user_id' => $doctor->id

            ]);
            return redirect()->route("admin.d.doctorList");
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }



    public  function doctorList() {
        $doctors = Doctors::select('id', 'name', 'lname', 'department_id', 'email', 'phone')->orderBy("id", "DESC")->get();

        foreach($doctors as $doctor) {
            $doctor['department'] = $doctor->department->department_name;
            $doctor['ide'] = Crypt::encryptString($doctor->id);
            $doctor['id'] = null;
        }
        return view($this->p."doctor-list")->with(['doctors' => $doctors]);
    }

    public function addDepartment() {

        return view($this->p."masters.add-department");
    }

    public function storeDepartment(Request $req) {
        $req->validate([
            "department" => ["required", "unique:departments,department_name"]
        ]);

        try{

            Departments::create([
                "department_name" => $req->department
            ]);

            return response()->json(200);

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDepartments() {
        $departments = Departments::get();

        return response()->json($departments);
    }

    public function updateDoctorInfo(Request $req) {
        $req->validate([
            "fname" => ['required'],
            "mname" => ['nullable'],
            "lname" => ['nullable'],
            "dob" => ['required', 'date'],
            "gender" => ['required', 'numeric'],
            "phone" => ['required', 'numeric', 'gt:13', 'unique:doctors,phone,'.$req->id.',id'],
            "email" => ['required', 'email', 'unique:users,email', 'unique:doctors,email,'.$req->id.',id'],
            "city" => ['required'],
            "address" => ['required', 'max:455'],
            "departments" => ['required', 'numeric'],
        ]);
        
        $data = [
            "name" => $req->fname,
            "mname" => $req->mname,
            "lname" => $req->lname,
            "dob" => $req->dob,
            "gender" => $req->gender,
            "phone" => $req->phone,
            "email" => $req->email,
            "city" => $req->city,
            "address" => $req->address,
            "department_id" => $req->departments,
        ];
        try {
            Doctors::where("id", $req->id)->update($data);
            return redirect()->route("admin.d.doctorList");
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteDoctorInfo(Request $req) {
        $id = Crypt::decryptString($req->id);

        try {
            Doctors::where("id", $id)->delete();
            return response()->json(200);
        } catch(\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
