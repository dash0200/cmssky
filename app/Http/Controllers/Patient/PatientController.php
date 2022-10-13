<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Departments;
use App\Models\Doctors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    var $p = "pages.patient.";
    public function patientDashboard() {
        $appointment = Appointments::whereDate('created_at', Carbon::today())->first();

        $appointment->time_slot = Controller::amPm($appointment->time_slot);

        $appointment['doctor'] = $appointment->getDoctor->name;
        return view($this->p.'dashboard')->with(['appointment' => $appointment]);
    }

    public function appointments() {
        $doctors = Doctors::get();
        $departments  = Departments::get();
        return view($this->p."appointments")->with(['doctors' => $doctors, 'departments' => $departments]);
    }

    public function appointmentsHistory() {
        $session = Auth::user();
        $appointments = Appointments::where("patient_id", $session->user_id)->get();

        foreach($appointments as $app) {
            $app['docttor'] = $app->getDoctor;
            $app['patient'] = $app->getPatient;
            $app['department'] = $app->getDepartment;
        }

        return view($this->p."history")->with([
            "appointments" => $appointments
        ]);
    }

    public function storeAppointment(Request $req) {

        $req->validate(['reason' => ["required"]]);

        $data = [
            "patient_id" => $req->id,
            "doctor_id" => $req->doctor,
            "department_id" => $req->department,
            "reason" => $req->reason,
            "status" => "booked",
            "time_slot" => $req->time,
            "date" => $req->date,
        ];

        try {
            Appointments::create($data);
            return redirect()->route('patient.dashboard');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
