<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('skills')->get();
       
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();
       
        $employee = Employee::create($validated);
        

        if ($request->has('skills')) {
            $skillsData = [
                'skill' => $request->input('skills'),  
                'years_exp' => $request->input('years_experience'),
                'level' => $request->input('seniority')
            ];
            
            $employee->skills()->create($skillsData);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = Employee::with('skills')->find($employee);

    if ($employee) {
        return response()->json(['status' => 'success', 'data' => $employee]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Employee not found']);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully.'], 200);

    }

    public function restore($id)
    {
        try {
            $employee = Employee::withTrashed()->findOrFail($id);
            $employee->restore();
            return response()->json(['message' => 'Employee restored successfully.'], 200);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


}

