<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\AddProducts;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function getIndexAdmin(){
        $products = DB::table('products')->get();
        return view('pageAdmin.index',compact('products'));
    }
    public function store(Request $request){
        $name = '';
        $file = $request->file('inputImage');
        $name = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('/source/image/product');
        $file->move($destinationPath, $name);
        $arr =[
            'name' => $request->input('inputName'),
            'unit_price' => $request->input('inputPrice'),
            'promotion_price' => $request -> input('inputPromotionPrice'),
            'image' => $name,
            'unit' => $request->input('inputUnit'),
            'new' => $request -> input('inputNew'),
            'id_type' => $request -> input('inputType'),
            'description' => $request -> input('inputDescription')
        ];
        DB::table('products')->insert($arr);
        return redirect()->route('showProduct');
    }
    public function getAdd(){
        return view('pageAdmin.add');
    }
    public function showAdmin(){
        $table_product = new Product();
        $products = $table_product->index();
        // dd($products);
        return view('admin',compact('products'));
    }
    public function getID($id){
        $product = DB::table('products')->where('id',[$id])->first();
        return view('pageAdmin.edit',compact('product'));
    }
    public function Editform(Request $request){
        $id = $request->input('editId');
        // dd($id);
        $name = '';
        $file = $request->file('editImage');
        $name= time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('/source/image/product');
        $file->move($destinationPath, $name);
        $arr = [
            'name' => $request->input('editName'),
            'unit_price' => $request->input('editPrice'),
            'promotion_price' => $request->input('editPromotionPrice'),
            'image' => $name,
            'unit' => $request->input('editUnit'),
            'new' => $request->input('editNew'),
            'id_type' => $request->input('editType'),
            'description' => $request->input('editDescription')
        ];
        DB::table('products')->where('id',[$id])->update($arr);
        return redirect()->route('showProduct');
    }
    public function Delete($id,Request $request){
        DB::table('products')->where('id',[$id])-> delete();
        return redirect()->route('showProduct');
    }
}   