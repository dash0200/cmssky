<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function profile() {

        return view("auth.profile");
    }

    public function updatePassword(Request $req) {
        $session = Auth::user();

        $req->validate([
            'old' => ['required'],
            'new' => 'min:6|required_with:cnf|same:cnf',
        ]);

        if ((Hash::check($req->old, $session->password))) {
            
            User::where("id", $session->id)->update([
                "password" => Hash::make($req->new)
            ]);

            return response()->json(200);
        }
    }

    public function dashboard() {
        $session = Auth::user();

        switch($session->user_type) {
            case "doctor":
                return redirect()->route("doctor.dashboard");
                break;
            case "patient":
                return redirect()->route("patient.dashboard");
                break;
            case "reception":
                return redirect()->route("reception.dashboard");
                break;
            case "admin":
                return redirect()->route("admin.dashboard");
                break;
            default:
                redirect()->route("login");
        }
    }
}
