<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
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
            'tool_id' => 'required|integer'
        ]);

        if($validation->fails()){
            return redirect()->back()->with('stauts', 'error ID')->setStatusCode(400);
        }
        $user = Auth::user();
        // cek user dah login belom
        if(!$user){
            return redirect()->back()->with('status', 'kalo mau bookmark harus login dan punya akun dulu ngab maaf ya');
        }

        //cek apakah tools udh di bookmark sama user ini
        $existingBookmark = Bookmark::where('user_id', $user->id)->where('tool_id', $request->tool_id)->first();

        if($existingBookmark){
            return redirect()->route('tool')->with('status', 'Tool already bookmarked')->setStatusCode(400);
        }else{
            Bookmark::create([
                    'user_id' => $user->id,
                    'tool_id' => $request->tool_id,
                ]);
                return redirect()->route('tool')->with('status', 'Tool bookmarked successfully!')->setStatusCode(200);
            }
    }

    function deleteBookmark(Request $request){
        $validation = Validator::make($request->all(),
        [
            'bookmark_id' => 'required|integer',
        ]);

        if($validation->fails()){
            return redirect()->route('bookmark')->setStatusCode(400);
        }else{
            $bookmark = Bookmark::find($requset->bookmark_id);

            if(!$bookmark){
                return redirect()->route('bookmark')->with('error', 'nga ketemu ngab')->setStatusCode(400);
            }else{
                $bookmark->delete;
            }

            return redirect()->route('bookmark')->with('status', 'success masbro')->setStatusCode(200);
        }
    }
}
