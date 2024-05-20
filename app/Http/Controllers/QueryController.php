<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use Auth;

class QueryController extends Controller
{
    public function create()
    {
        return view('user.create_query');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Query::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'status' => 'Pending',
        ]);

        return redirect()->route('user.home')->with('success', 'Query submitted successfully.');
    }

    public function index()
    {
        $queries = Query::all();
        return view('admin.queries', compact('queries'));
    }

    public function updateStatus(Request $request, Query $query)
    {
        $request->validate([
            'status' => 'required|string|in:Read,Dumped',
        ]);

        $query->update([
            'status' => $request->status,
            'employee_id' => Auth::guard('employee')->id(),
        ]);

        return redirect()->route('employee.queries')->with('success', 'Query status updated successfully.');
    }

    public function employeeIndex()
    {
        $queries = Query::all();
        return view('employee.queries', compact('queries'));
    }
}
