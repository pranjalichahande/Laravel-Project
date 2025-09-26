<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
   public function index(Request $request)
    {
        // Fetch all students with documents for total count calculation
        $allStudents = User::where('role', 'student')->with('documents')->get();
        $totalWithDocuments = $allStudents->filter(fn($s) => $s->documents->count() > 0)->count();

        // For table display with pagination
        $query = User::where('role', 'student')->with('documents');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%$search%")
                                         ->orWhere('email', 'like', "%$search%"));
        }
        $students = $query->orderBy('name')->paginate(5);

        return view('dashboard', compact('students', 'totalWithDocuments'));


    }

    

}
