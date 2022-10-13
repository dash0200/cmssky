<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Alert;
use App\Models\Receptions;
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
                'password' => Hash::make($req->phone),
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
            "email" => ['required', 'email', 'unique:users,email,'.$req->id.',user_id', 'unique:doctors,email,'.$req->id.',id'],
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

            $updated = Doctors::where("id", $req->id)->update($data);
            if($updated) {
                User::where("user_id", "$req->id")->update(["email" => $req->email]);
            }

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

    public function addReception() {
        return view($this->p."reception-form");
    }

    public function listReception() {
        $receptions = Receptions::select('id', 'name', 'lname', 'email', 'phone')->orderBy("id", "DESC")->get();

        foreach($receptions as $reception) {
            $reception['ide'] = Crypt::encryptString($reception->id);
            $reception['id'] = null;
        }
        return view($this->p."reception-list")->with([
            "receptions" => $receptions
        ]);
    }

    public function storeReception(Request $req) {
        $req->validate([
            "fname" => ['required'],
            "mname" => ['nullable'],
            "lname" => ['nullable'],
            "dob" => ['required', 'date'],
            "gender" => ['required', 'numeric'],
            "phone" => ['required', 'numeric', 'unique:receptions,phone'],
            "email" => ['required', 'email', 'unique:users,email', 'unique:receptions,email'],
            "city" => ['required'],
            "address" => ['required', 'max:455'],
        ]);
        
        $data = [
            "name" => $req->fname,
            "mname" => $req->mname,
            "lname" => $req->lname,
            "gender" => $req->gender,
            "dob" => $req->dob,
            "phone" => $req->phone,
            "email" => $req->email,
            "address" => $req->address,
            "city" => $req->city,
        ];

        try {
            $reception = Receptions::create($data);
            if(isset($reception->id)) {
                User::create([
                    'name' => $req->fname,
                    'email' => $req->email,
                    'password' => Hash::make($req->phone),
                    'user_type' => 'reception',
                    'user_id' => $reception->id
                ]);
            }
            return response()->json(200);
        } catch(\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function editReception(Request $req) {
        $id = Crypt::decryptString($req->id);

        $reception = Receptions::where("id", $id)->first();

        return view($this->p."reception-edit")->with(['reception' => $reception]);
    }

    public function updateReception(Request $req) {
        $req->validate([
            "fname" => ['required'],
            "mname" => ['nullable'],
            "lname" => ['nullable'],
            "dob" => ['required', 'date'],
            "gender" => ['required', 'numeric'],
            "phone" => ['required', 'numeric', 'gt:13', 'unique:receptions,phone,'.$req->id.',id'],
            "email" => ['required', 'email', 'unique:users,email,'.$req->id.',user_id', 'unique:receptions,email,'.$req->id.',id'],
            "city" => ['required'],
            "address" => ['required', 'max:455'],
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
        ];

        try {

            $updated = Receptions::where("id", $req->id)->update($data);

            if($updated) {
                User::where("user_id", "$req->id")->update(["email" => $req->email]);
            }

            return redirect()->route("admin.reception.list");

        } catch(\Exception $e) {

            return $e->getMessage();
        }
    }
}