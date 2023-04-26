<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\News;

class AdminController extends Controller
{
    //
    public function addDoctorView(){

        return view('admin.add_doctor');
    }

    public function uploadDoctor(Request $request){
        $doctor = new doctor;
        $image = $request->file;
        $imgName = time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage' , $imgName);
        $doctor->image = $imgName ; 
        $doctor->name = $request->name ; 
        $doctor->date = $request->date ; 
        $doctor->phone = $request->phone ; 
        $doctor->specialty = $request->specialty ; 
        $doctor->room = $request->room ; 
        $doctor->save();
        return redirect()->back()->with('message' , 'doctor added successfully');
    }

    public function getAppointments(){
        $appointments = appointment::all();
        return view('admin.get_appointments'  , compact('appointments' , $appointments) ); 
    }

    public function accepetAppointment($id){
        $data = appointment::find($id) ; 
        $data->status = "accepted";
        $data->save();
        return redirect()->back();
    }

    public function cancelAppointment($id){
        $data = appointment::find($id) ; 
        $data->status = "canceled";
        $data->save();
        return redirect()->back();
    }

    public function getDoctors(){
        $data = doctor::all();
        return view('admin.all_doctor_view' , compact('data' , $data));
    }

    public function deleteDoctor($id){
        $data = doctor::find($id);
        $data->delete();
        return redirect()->back()->with('message'  , 'Doctor deleted successfully');
    }

    public function getDoctor($id){
        $doctor = doctor::find($id);
        return view('admin.edit_doctor_view')->with('doctor' , $doctor);
    }

    public function editDoctor(Request $request , $id){
        $doctor = doctor::find($id);
        $image = $request->file;
        if($image){
            $imgName = time().'.'.$image->getClientoriginalExtension();
            $request->file->move('doctorimage' , $imgName);
            $doctor->image = $imgName ;
        }   
        $doctor->name = $request->name ; 
        $doctor->date = $request->date ; 
        $doctor->phone = $request->phone ; 
        $doctor->specialty = $request->specialty ; 
        $doctor->room = $request->room ; 
        $doctor->save();
        return redirect()->back()->with('message' , 'doctor edited successfully');

    }

    public function uploadNew(Request $request){
        $new = new news ; 
        if($image){
            $imgName = time().'.'.$image->getClientoriginalExtension();
            $request->file->move('doctorimage' , $imgName);
            $doctor->image = $imgName ;
        }   
        $doctor->name = $request->name ; 
        $doctor->date = $request->date ; 
        $doctor->phone = $request->phone ; 
        $doctor->specialty = $request->specialty ; 
        $doctor->room = $request->room ; 
        $doctor->save();
        return redirect()->back()->with('message' , 'new added successfully');
    }
}
