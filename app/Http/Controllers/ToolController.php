<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Tool;

class ToolController extends Controller
{
    //buat ngambil dashboard view
    function DashboardView(){
        return view('dashboard');
    }
    //fungsi buat ngambil tool view bedeuhhh
    function ToolView(){
        return view('Tool');
    }
    
    //fungsi buat ngambil tool yg dicari
    function GetTool(Request $request){
        //validasi data yang di send dr frontend dulu
        $validation = Validator::make($request->all(),
        [
            'tool_name' => 'required|string',
        ]);

        if($validation->fails()){ // kalo datanya ga valid
            return redirect()->route('dashboardView')->with('status', 'invalid data')->setStatusCode(400);
        }
        $tools = Tool::where('name', 'like', '%' . $request->tool_name . '%')->get();// nyari tool
        if(!$tools){ // kalo ga ada ngab
            return redirect()->route('dashboardView')->with('status','ga ada tool nya, maaf yah');
        }else{
            return view('dashboard', ['tools'=>$tools])->with('stasus', 'ada nih yey!');
        }
    }
}
