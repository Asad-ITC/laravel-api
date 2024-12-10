<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return ['result' => 'member list'];
        $student = Student::all();
        return ['result' => $student];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return ['result' => 'member created'];

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return ['result' => 'member saved'];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return ['result' => 'member updated'];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}