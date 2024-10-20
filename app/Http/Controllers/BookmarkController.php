<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Models\Bookmark;
class BookmarkController extends Controller
{
    function BookmarkPage(Request $request){
       $user = Auth::user(); // ini ngambil user yang sedang login

       $bookmarkedTools = Bookmark::where('user_id', $user->id)->with('tool')->get(); //ngambil tools yang udah di bookmark sm user yg udh login

       //kirim data ke view
       return view('Bookmark', ['bookmarkedTools' => $bookmarkedTools]);

    }

    // buat kalo user mau bookmark tool
    function addBookmark(Request $request){
        $validation = Validator::make($request->all(),
        [
            'tool_id' => 'required|integer';
        ]);

        if($validation->fails()){
            return redirect()->route('tool')->with('stauts', 'must be integer ID');
        }else{
            $user = Auth::user();

            //cek apakah tools udh di bookmark sama user ini
            $existingBookmark = Bookmark::where('user_id', $user->id)->where('tool_id', $request->tool_id)->first();

            if($existingBookmark){
                return redirect()->route('tool')->with('status', 'Tool already bookmarked');
            }else{
                Bookmark::create([
                    'user_id' => $user->id,
                    'tool_id' => $request->tool_id,
                ]);
                return redirect()->route('tool')->with('status', 'Tool bookmarked successfully!');
            }
        }
    }

    function deleteBookmark(Request $request){
        $validation = Validator::make($request->all(),
        [
            'tool_id' => 'required|integer';
        ]);

        if($validation->fails()){
            return redirect()->route('tool')
        }else
    }
}
