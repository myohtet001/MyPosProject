<?php

namespace App\Http\Controllers;

use App\Category;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getIndex(){
        $cat=Category::all();
        $pd=product::orderBy('id','desc')->get();
        return view('index')->with(['pd'=>$pd])->with(['cat'=>$cat]);
    }

    public function getImage($image){
        $file=Storage::disk('cover')->get($image);
        return response($file,200)->header('Content_Type','*/*');
    }

    public function getClearCart(){
        Session::forget('cart');
        return redirect()->back();
    }
}
