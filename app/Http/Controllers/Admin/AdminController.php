<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\Request;

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

    public function storeDoctorInfo(Request $req) {

        $req->validate([
            "fname" => ['required'],
            "mname" => ['nullable'],
            "lname" => ['nullable'],
            "dob" => ['required', 'date'],
            "gender" => ['required', 'numeric'],
            "phone" => ['required', 'numeric', 'gt:13'],
            "email" => ['required', 'email', 'unique:users'],
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

        dd($data);
    }



    public  function doctorList() {

        return view($this->p."doctor-list");
    }

    public function addDepartment() {

        return view($this->p."masters.add-department");
    }

    public function storeDepartment(Request $req) {

    }

    public function getDepartments() {
        $departments = Departments::get();

        return response()->json($departments);
    }
}
