<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->with('documents')->get();
        return view('admin.students.index', compact('students'));
        
    }

    public function show($id)
    {
        $student = User::with('documents')->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }
    

    public function dashboard()
    {
        $students = User::where('role', 'student')->count();
        return view('admin.dashboard', compact('students'));
    }
}
