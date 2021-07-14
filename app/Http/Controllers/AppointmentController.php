<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiServiceController;

class AppointmentController extends Controller
{
    public function createAppointment(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->except('_token');

        $result = ApiServiceController::postApi('appointment','create', 'POST', $data, get_token());
        
        return redirect()->route('home');
    }

    public function editAppointment(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->except('_token');

        $result = ApiServiceController::postApi('appointment','update/'.$id, 'PATCH', $data, get_token());
        
        return redirect()->route('home');
    }

    public function deleteAppointment($id){
        $result = ApiServiceController::postApi('appointment','delete/'.$id, 'DELETE', '', get_token());
        
        return redirect()->route('home');
    }
}
