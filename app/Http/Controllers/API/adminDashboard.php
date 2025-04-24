<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class adminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return "admin dashboard";
        $users = User::first();
        return response($users);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return "admin store";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return "show spacific admin";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return "update admin";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return "delete admin";
    }
}
