<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    var $p = "pages.reception."; //path
    
    public function receptionDashboard() {
        return view($this->p.'dashboard');
    }
}
