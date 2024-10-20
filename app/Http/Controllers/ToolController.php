<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Tool;

class ToolController extends Controller
{
    //fungsi buat ngambil tool view bedeuhhh
    function ToolView(Request $request){
        return view('Tool');
    }
    
    //fungsi buat ngambil tool yg dicari
    function GetTool(Request $request){
        //validasi data yang di send dr frontend dulu
        $validation = Validator::make($request->all(),
        [
            'tool_id' => 'required|integer'; //harus integer, biar ga bisa di-inject(kecuali ada injection yg full integer yaudah mokad)
        ]);

        if($validation->fails()){ // kalo datanya ga valid
            return response()->json($validation->errors(), 400);
        }else if(!$validation->fails() && Auth::check()){
            $tool = Tool::find($request->input('tool_id'));// nyari tool
            if(!$tool){ // kalo ga ada ngab
                return response()->json(['error' => 'Sorry, tool not found'], 404);
            }else{
                return response()->json($tool, 200);
            }
        }
    }
    
    // ya kek namanya buat delete tool, tapi cuman bisa si admin doang
    function DeleteTool(Request $request){
        
    }
}
