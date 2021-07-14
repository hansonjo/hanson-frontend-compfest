<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiServiceController;

class PageController extends Controller
{
    public function home(){
        $datas = ApiServiceController::postApi('appointment','', 'GET',null, get_token());
        
        foreach ($datas as $index => $appointment) {
            $lists = $appointment->list[0];

            foreach ($lists as $idx => $list) {
                $user = ApiServiceController::postApi('user','find/'.$list->user_id, 'GET',null, get_token());
                $list->name = $user->first_name .' '. $user->last_name;
            }
        }
        return view('home',compact('datas'));
    }

    public function createAppointment(){
        return view('form-appointment');
    }

    public function editAppointment($id){
        $appointment = ApiServiceController::postApi('appointment','find/'.$id, 'GET',null, get_token());
        return view('form-appointment',compact('appointment'));
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }
}
