<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    var $p = "pages.reception."; //path
    
    public function receptionDashboard() {
        $appointments_count = Appointments::whereDate('created_at', Carbon::today())->count();

        $appointments = Appointments::whereDate('created_at', Carbon::today())->orderBy("time_slot", "ASC")->get();
        foreach($appointments as $app) {
            $app['patient_name'] = $app->getPatient->name;
            $app['doctor_name'] = $app->getDoctor->name;
            $app->time_slot = Controller::amPm($app->time_slot);
        }

        return view($this->p.'dashboard')->with(['appointments_count' => $appointments_count, "appointments" => $appointments]);
    }
}
