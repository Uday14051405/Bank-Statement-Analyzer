<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateLeadController extends Controller
{
        public function index(Request $request){

            dd($request->all());
        }

        public function store(Request $request)
        {
            if(!$request->hasFile('image')) {
                return response()->json(['upload_file_not_found'], 400);
            }
            
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);

            
            
            
        }
 
}









