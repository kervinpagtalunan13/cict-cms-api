<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return response()->json(Department::with('members')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClientRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'departmentCode' => 'required|string|unique:departments,department_code',
            'description' => 'required|string|unique:departments,description'
        ]);

        $user = Department::create([
            'department_code' => $fields['departmentCode'],
            'description' => $fields['description'],
            'members' => '[]',
            'chairs' => '[]',
        ]);

        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
