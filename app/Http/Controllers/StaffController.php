<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;

class StaffController extends Controller
{
    public function create(request $request){

        $request->validate([
            'name'  => ['required'],
            'position'  => ['required'],
            'email'  => ['required'],
        ]);

        $emp = new Staff;

        $emp->name      = $request->name;
        $emp->position  = $request->position;
        $emp->email     = $request->email;
        $emp->status    = $request->status;
        $emp->WIFI      = $request->WIFI;
        $emp->Lunch     = $request->Lunch;

        $emp->save();

        return response()->json($emp);

    }

    public function index() {

        $emps = Staff::orderby('id', 'desc')->paginate(4);
        return response()->json($emps);
    }

    public function getSingleStaff($id){
        $emp = Staff::findorFail($id);
        return response()->json($emp);
    }

    public function updateStaff(Request $request, $id){

        $request->validate([
            'name'  => ['required'],
            'position'  => ['required'],
            'email'  => ['required'],
        ]);

        $emp = Staff::findorFail($id);

        $emp->name      = $request->name;
        $emp->position  = $request->position;
        $emp->email     = $request->email;
        $emp->status    = $request->status;
        $emp->WIFI      = $request->WIFI;
        $emp->Lunch     = $request->Lunch;

        $emp->save();

        return response()->json($emp);

    }

    public function deleteStaff($id){
        $emp = Staff::find($id);
        $emp->delete();

        return response()->json("Recode deleted");
    }

    public function searchStaff(request $request){
        
        
        if($request->search){
            $search = $request->search;
            $staff = Staff::where('name', 'LIKE', "%$search%")->paginate(4);
        }else if($request->position){
            $search = $request->position;
            $staff = Staff::where('position', 'LIKE', "%$search%")->paginate(4);
        }else if($request->name){
            $search = $request->name;
            $staff = Staff::where('name', 'LIKE', "%$search%")->paginate(4);
        }
        


        return response()->json($staff);
    }
}
