<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Tool;

class AdminController extends Controller
{
    function getAdminDashboard(Request $request){
        $tools = Tool::all();
        return view('adminDashboard', ['tools' => $tools]);
    }

    function addTool(Request $request){
        $validation = Validator::make($request->all(), 
        [
            'tool_name' => 'required|string',
            'description' =>'required|string',
            'category' => 'required|string',
        ]);

        if($validation->fails()){
            return redirect()->route('dashboardAdmin')->withErrors('Kureng neh datanya');
        }else{

            $toolName = strip_tags($request->input('tool_name'));
            $toolDescription = strip_tags($request->input('description'));
            $toolCategory = strip_tags($request->input('category'));
            //cek apakah udh ada tool dengan nama yg sama
            $existingTool = Tool::where('name', $toolName)->first();

            if($existingTool){
                return redirect()->route('dashboardAdmin')->with('status', 'udah ada ngab, lupa ya awokwokow');
            }else{
                Tool::create([
                    'name' => $toolName,
                    'description' => $toolDescription,
                    'category' => $toolCategory,
                ]);
            }
            return redirect()->route('dashboardAdmin')->with('status', 'berhasil ditambah ngab');
        }
    }
    function deleteTool(Request $request){
        $validation = Validator::make($request->all(),
        [
            'tool_id' => 'required|integer'
        ]);

        if($validation->fails()){
            return redirect()->route('dashboardAdmin'); // kalo validasi fail, ke dashboard admin aja
        }else{
            $tool = Tool::find($request->tool_id)->first();

            if(!$tool){
                return redirect()->route('dashboardAdmin')->with('status', 'lah kok nga ada brok');
            }else{
                $tool->delete();
            }

            return redirect()->route('dashboardAdmin')->with('status', 'berhasil di delete');
        }
    }
}
