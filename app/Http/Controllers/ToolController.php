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
            'tool_name' => 'required|string'; 
        ]);

        if($validation->fails()){ // kalo datanya ga valid
            return redirect()->route('Tools')->with('status', 'invalid data')->setStatusCode(400);
        }else if(!$validation->fails() && Auth::check()){
            $tool = Tool::find($request->input('tool_name'));// nyari tool
            if(!$tool){ // kalo ga ada ngab
                return redirect()->route('Tools')->with('status', 'ga ada tool nya, maaf yah')->setStatusCode(404);
            }else{
                return redirect()->route('Tools')->with('status', 'ada nih yey')->setStatusCode(200);
            }
        }
    }
}
