<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();
    $businesses = $user->businesses; // Assuming 'businesses' is the correct relationship name on the User model

    return response()->json([
        'status' => 200,
        'business' => $businesses
    ], 200);
}

    public function store(Request $request)
{
    $user = $request->user();
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'title' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->errors()
        ], 422);
    }

    $business = $user->businesses()->create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'title' => $request->title,
    ]);

    return response()->json([
        'status' => 200,
        'message' => "Business created successfully"
    ], 200);
}
public function show(Request $request, $id){
    $user = $request->user();
    $business = Business::find($id);

    if (!$business) {
        return response()->json([
            'status' => 404,
            'message' => "Business not found"
        ], 404);
    }

    if ($business->user_id !== $user->id) {
        return response()->json([
            'status' => 403,
            'message' => "Unauthorized to access this business"
        ], 403);
    }

    return response()->json([
        'status' => 200,
        'business' => $business
    ], 200);
}
public function edit(Request $request, $id){
    $user = $request->user();
    $business = Business::find($id);

    if (!$business) {
        return response()->json([
            'status' => 404,
            'message' => "Business not found"
        ], 404);
    }

    if ($business->user_id !== $user->id) {
        return response()->json([
            'status' => 403,
            'message' => "Unauthorized to access this business"
        ], 403);
    }

    return response()->json([
        'status' => 200,
        'business' => $business
    ], 200);
}
public function update(Request $request, $id){
    $user = $request->user();
    $validator = Validator::make($request->all(), [
        'name' =>'required',
        'email' =>'required',
        'address' => 'required',
        'title' =>'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->errors()
        ], 422);
    }

    $business = Business::find($id);

    if (!$business) {
        return response()->json([
            'status' => 404,
            'message' => "Business not found"
        ], 404);
    }

    if ($business->user_id !== $user->id) {
        return response()->json([
            'status' => 403,
            'message' => "Unauthorized to update this business"
        ], 403);
    }

    $business->update([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'title' => $request->title,
    ]);

    return response()->json([
        'status' => 200,
        'message' => "Business updated successfully"
    ], 200);
}
public function destroy($id){
    $user = request()->user();
    $business = Business::find($id);

    if (!$business) {
        return response()->json([
            'status' => 404,
            'message' => "Business not found"
        ], 404);
    }

    if ($business->user_id !== $user->id) {
        return response()->json([
            'status' => 403,
            'message' => "Unauthorized to delete this business"
        ], 403);
    }

    $business->delete();
    return response()->json([
        'status' => 200,
        'message' => "Business deleted successfully"
    ], 200);
}
}
