<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    var $p = "pages.patient.";
    public function patientDashboard() {
        return view($this->p.'dashboard');
    }

    public function appointments() {
        return view($this->p."appointments");
    }

    public function appointmentsHistory() {
        return view($this->p."history");
    }
}
