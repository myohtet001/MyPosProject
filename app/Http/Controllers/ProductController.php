<?php

namespace App\Http\Controllers;

use App\Category;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function getCategory(){
        $cat=Category::all();
        return view('admin.product.newCategory')->with(['cat'=>$cat]);
    }
    public function postNewCategory(Request $request){
        $this->validate($request,[
            'categoryName'=>'required'
        ]);
        $cat=new Category();
        $cat->categoryName=$request['categoryName'];
        $cat->save();
        return redirect()->back()->with('info','Add New Category created successfully');
    }
    public function DeleteCategory($categoryName){
        $cat=Category::where('categoryName',$categoryName)->first();
        $cat->delete();
        return redirect()->back()->with('message','The selected category have been delete!');
    }
    public function getNewProduct(){
        $product=product::orderBy('id','desc')->paginate('10');
        $cat=Category::all();
        return view('admin.product.newProduct')->with(['cat'=>$cat])->with(['product'=>$product]);
    }
    public function postNewProduct(Request $request)
    {
        $this->validate($request, [
            'pName' => 'required',
            'price' => 'required',
            'catName' => 'required',
            'cover' => 'required',

        ]);
        $pCover = $request->file('cover');
        $pCoverexe = $request->file('cover')->getClientOriginalExtension();
        $pCoverName = $request['pName'] . '.' . $pCoverexe;
        $pd=new product();
        $pd->pName=$request['pName'];
        $pd->price=$request['price'];
        $pd->category_id=$request['catName'];
        $pd->user_id=Auth::User()->id;
        $pd->cover=$pCoverName;
        $pd->save();
        Storage::disk('cover')->put($pCoverName,file($pCover));
        return redirect()->back();

    }
    public function DeleteProduct($id){
        $pd=product::where('id',$id)->first();
        $pd->delete();
        return redirect()->back();
    }
    public function getCoverImage($cover){
        $coverImage=Storage::disk('cover')->get($cover);
        return response($coverImage,200)->header('Content_Type','*/*');

    }
    public function postUpdateProduct(Request $request){
        $id=$request['id'];
        $pd=product::where('id',$id)->first();
        $pd->pName=$request['p-name'];
        $pd->price=$request['price'];
        $pd->category_id=$request['category_id'];

            $cover=$request->file('cover');
            $pCoverexe=$request->file('cover')->getClientOriginalExtension();
            $pCoverName=$request['p-name'].'.'.$pCoverexe;
            $request->cover->move(storage_path(). '/cover/',$pCoverName);
        $oldFilename = $pd->cover;
        $pd->cover = $pCoverName;

        Storage::disk('cover')->delete($oldFilename);
            $pd->cover=$pCoverName;

            $pd->update();
            return redirect()->back();


    }

    }