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
        return view('dashboardafter');
    }
    //fungsi buat ngambil tool view bedeuhhh
    function ToolView(Request $request){
        $tool = Tool::find($request->id);

        if (!$tool) {
            return redirect()->route('dashboardView')->with('status', 'Tool not found');
        }

        $tool->description = preg_replace(
            '/(https?:\/\/[^\s]+)/', 
            '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>',
            e($tool->description)
        );
    
        return view('Tool', ['tool' => $tool]);
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
            return view('searchTool', ['tools'=>$tools])->with('stasus', 'ada nih yey!');
        }
    }

    function exploreTool(Request $request){
        $tools = Tool::all(); 
        return view('exploreTool', ['tools' => $tools]);
    }
}
