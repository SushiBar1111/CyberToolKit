<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    function getNews(Request $request){
        $news = News::all();
        return view('adminDashboard', ['tools' => $tools]);
    }
}
