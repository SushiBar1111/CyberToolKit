<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Tool;
use APP\Models\User;

class AdminController extends Controller
{
    // buat dapet dashboard admin
    function getAdminDashboard(Request $request){
        $tools = Tool::all();
        return view('adminDashboard', ['tools' => $tools]); // sekalian ngasih list tools
    }

    function getUserList(Request $request){
        $user = User::all();
        return view('adminListUser', ['users' => $user]);
    }

    function addTool(Request $request){
        $validation = Validator::make($request->all(), 
        [
            'tool_name' => 'required|string',
            'description' =>'required|string',
            'category' => 'required|string',
        ]);

        if($validation->fails()){
            return redirect()->route('dashboardAdmin')->withErrors('status','Kureng neh datanya');
        }else{

            $toolName = strip_tags($request->input('tool_name'));
            $toolDescription = strip_tags($request->input('description'));
            $toolCategory = strip_tags($request->input('category'));
            //cek apakah udh ada tool dengan nama yg sama
            $existingTool = Tool::where('name', $toolName)->first();

            if($existingTool){ //buat cek tool udh ada ato blm
                return redirect()->route('dashboardAdmin')->with('status', 'udah ada ngab, lupa ya awokwokow');
            }
            
            $tool = new Tool();
            $tool->name = $toolName;
            $tool->description = $toolDescription;
            $toolCategory = $toolCategory;
            $tool->save();

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
            $tool = Tool::find($request->tool_id);

            if(!$tool){
                return redirect()->route('dashboardAdmin')->with('status', 'lah kok nga ada brok toolnya');
            }else{
                $tool->delete();
            }

            return redirect()->route('dashboardAdmin')->with('status', 'berhasil di delete');
        }
    }
    // fungsi buat delete user
    function deleteUser(Request $request){
        $validation = Validator::make($request->all(),
        [
            'user_id' => 'required|integer'
        ]);

        if($validation->fails()){
            return redirect()->route('listUsers')->with('status', 'error pas datanya');
        }
        $deletedUser = User::find($request->user_id);
        if($deletedUser){
            $deletedUser->delete();
            return redirect()->route('listUsers')->with('status', 'user berhasil dihapus');
        }else{
            return redirect()->route('listUsers')->with('status', 'user ga ada');
        }
    }
}
