<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    var $p = "pages.doctor.";
    public function doctorDashboard() {
        return view($this->p.'dashboard');
    }
}
