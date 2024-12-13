<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Fetch all employees
    public function index()
    {
        // return response()->json(Employee::all(), 200);
        try {
            $employees = Employee::all();
            return ApiResponse::success($employees);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to fetch employees', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Store a new employee
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:employees',
        //     'phone' => 'required|string|max:15',
        // ]);

        // $employee = Employee::create($validated);
        // return response()->json($employee, 201);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees',
                'phone' => 'required|string|max:15',
            ]);

            $employee = Employee::create($validated);
            return ApiResponse::success($employee, 'Employee created successfully', 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::error('Validation failed', 422, $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create employee', 500, ['exception' => $e->getMessage()]);
        }
    }

    // Fetch a single employee
    public function show($id)
    {
        // $employee = Employee::find($id);

        // if (!$employee) {
        //     return response()->json(['message' => 'Employee not found'], 404);
        // }

        // return response()->json($employee, 200);

        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return ApiResponse::error('Employee not found', 404);
            }

            return ApiResponse::success($employee);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to fetch employee', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    // Update an employee
    public function update(Request $request, $id)
    {
        // $employee = Employee::find($id);

        // if (!$employee) {
        //     return response()->json(['message' => 'Employee not found'], 404);
        // }

        // $validated = $request->validate([
        //     'name' => 'sometimes|string|max:255',
        //     'email' => 'sometimes|email|unique:employees,email,' . $id,
        //     'phone' => 'sometimes|string|max:15',
        // ]);

        // $employee->update($validated);
        // return response()->json($employee, 200);

        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return ApiResponse::error('Employee not found', 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:employees,email,' . $id,
                'phone' => 'sometimes|string|max:15',
            ]);

            $employee->update($validated);
            return ApiResponse::success($employee, 'Employee updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::error('Validation failed', 422, $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to update employee', 500, ['exception' => $e->getMessage()]);
        }
    }

    // Delete an employee
    public function destroy($id)
    {
        // $employee = Employee::find($id);

        // if (!$employee) {
        //     return response()->json(['message' => 'Employee not found'], 404);
        // }

        // $employee->delete();
        // return response()->json(['message' => 'Employee deleted successfully'], 200);

        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return ApiResponse::error('Employee not found', 404);
            }

            $employee->delete();
            return ApiResponse::success(null, 'Employee deleted successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to delete employee', 500, ['exception' => $e->getMessage()]);
        }
    }
}
