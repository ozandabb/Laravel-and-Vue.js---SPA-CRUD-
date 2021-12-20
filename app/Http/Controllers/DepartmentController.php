<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function createDept(request $request){

        $request->validate([
            'deptName'  => ['required'],
            'unit'  => ['required'],
            'status'  => ['required'],
        ]);

        $emp = new Department;

        $emp->deptName      = $request->deptName;
        $emp->unit          = $request->unit;
        $emp->status        = $request->status;
        // $emp->facilities    = $request->facilities;
        // $emp->image    = $request->file('image')->store('images', 'public');

        $emp->save();

        return response()->json($emp);

    }
    
    public function handle( request $request ){

        $pathToFile    = $request->file('image')->store('images', 'public');

        return $pathToFile;

    }
}
