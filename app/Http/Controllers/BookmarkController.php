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
            return redirect()->route('dashboardView')->with('status', 'error ID')->setStatusCode(400);
        }
        $user = Auth::user();
        // cek user dah login belom
        if(!$user){
            return redirect()->route('dashboardView')->with('status', 'kalo mau bookmark harus login dan punya akun dulu ngab maaf ya');
        }

        //cek apakah tools udh di bookmark sama user ini
        $existingBookmark = Bookmark::where('user_id', $user->id)->where('tool_id', $request->tool_id)->first();

        if($existingBookmark){
            return redirect()->route('dashboardView')->with('status', 'Tool already bookmarked')->setStatusCode(400);
        }
        $bookmark = new Bookmark();
        $bookmark->tool_id = $request->tool_id;
        $bookmark->user_id = $user->id;
        $bookmark->save();
        return redirect()->route('dashboardView')->with('status', 'Tool bookmarked successfully!')->setStatusCode(200);
    }

    function deleteBookmark(Request $request){
        $validation = Validator::make($request->all(),
        [
            'bookmark_id' => 'required|integer'
        ]);

        if($validation->fails()){
            return redirect()->route('bookmarkPage')->with('status', 'harus integer')->setStatusCode(400);
        }
        $bookmark = Bookmark::find($request->bookmark_id);
        $user = Auth::user();

        if(!$bookmark){ 
            return redirect()->route('bookmarkPage')->with('status', 'nga ketemu ngab bookmarknya')->setStatusCode(404);
        }
        if($bookmark->user_id !== $user->id){ //mencegah user menghapus bookmark user lainnya dengan mengganti di bookmark ID pake burpsuite
            return redirect()->route('bookmarkPage')->with('status', 'Ga boleh delete bookmark user lain')->setStatusCode(401);
        }
        $bookmark->delete();

        return redirect()->route('bookmarkPage')->with('status', 'success dihapus masbro')->setStatusCode(200);
    }
}
