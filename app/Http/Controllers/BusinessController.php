<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index(){
        $business = Business::all();
        return  response()->json([
            'status' => 200,
            'business' => $business
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required',
            'address' => 'required',
            'title' =>'required',
        ]);
        if($validator->fails()) {
        return response()->json([
           'status' => 422,
            'errors' => $validator->errors()
        ], 422);
      }else{
        $business = Business::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'title' => $request->title,
        ]);
        if($business){
        return response()->json([
           'status' => 200,
            'message' => "all good"
        ], 200);}
        else{
        return response()->json([
           'status' => 500,
            'message' => "no good"
        ], 500);}
      }
    }
    public function show($id){
        $business = Business::find($id);
        if($business){
        return  response()->json([
           'status' => 200,
            'business' => $business
        ], 200);
    }else{
            return response()->json([
               'status' => 500,
                'message' => "not found"
            ], 500);}
          }
          public function edit(Request $request, $id){
            $business = Business::find($id);
        if($business){
        return  response()->json([
           'status' => 200,
            'business' => $business
        ], 200);
    }else{
            return response()->json([
               'status' => 500,
                'message' => "not found"
            ], 500);}
          }
          public function update(Request $request, $id){

            $validator = Validator::make($request->all(), [
                'name' =>'required',
                'email' =>'required',
                'address' => 'required',
                'title' =>'required',
            ]);
            if($validator->fails()) {
            return response()->json([
               'status' => 422,
                'errors' => $validator->errors()
            ], 422);
          }else{
            $business = Business::find($id);

            if($business){
                $business->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'title' => $request->title,
                ]);
            return response()->json([
               'status' => 200,
                'message' => "update good"
            ], 200);}
            else{
            return response()->json([
               'status' => 404,
                'message' => "no good"
            ], 404);}
          }
          }
          public function destroy($id){
            $business = Business::find($id);
            if($business){
                $business->delete();
            return response()->json([
               'status' => 200,
               'message' => "delete good"
            ], 200);}
            else{
            return response()->json([
               'status' => 404,
               'message' => "no good"
            ], 404);}
          }
        }


