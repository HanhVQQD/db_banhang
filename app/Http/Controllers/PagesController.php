<?php			
			
namespace App\Http\Controllers;			
			
use Illuminate\Http\Request;	
use App\Models\Slide; 	
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;


class PageController extends Controller			
{			
    public function getIndex(){		
        $slide = Slide::all();
        $new_product = Product::where('new', 1) -> paginate(8);
        $new_promotion = Product::where('promotion_price', '<>', 0) ->get();
        return view('pages.homepage', compact('slide','new_product','sanpham_khuyenmai'));
    }	
    
    public function getProduct_type($type){			
    	$product_type = ProductType::all();
        $sp_theoloai = Product::where ('id_type', $type) -> get();
        $sp_khac = Product::where('id_type','<>', $type)->paginate(3);

        return view('pages.product_type', compact('sp_theoloai','product_type','sp_khac'));
    }

    public function getDetail_product(){	
        $product_type = ProductType::all();		
        return view('pages.product_detail', compact('product_type'));
    }

    public function getAdminAdd(){
        return view('pageAdmin.add');
    }

    public function postAdminAdd (Request $request) {
        $product = new Product();
        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product', $fileName);
        }
        $file_name=null;
        if($request->file('inputImage') !=null){
            $file_name = $request->file('inputImage') ->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputpromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new= $request->inputNew;
        $product->id_type=$request->inputType;
        $product->save();
        return $this -> getIndexAdmin();
    }

    public function getAdminEdit($id) {
        $product = Product::find($id);
        return view('pageAdmin.edit')->with('product', $product);
    }

    public function postAdminEdit(Request $request) {
        $id = $request->editId;

        $product = Product::find($id);
        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file-> getClientOriginalName('editImage');
            $file->move('source/image/product',$fileName);
        }

        if ($request -> file('editImage') != null) {
            $product->image = $fileName;
        }

        $product->name = $request->editName;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editpromotionPrice;
        $product->unit = $request->editUnit;
        $product->new= $request->editNew;
        $product->id_type=$request->editType;
        $product->save();
        return $this -> getIndexAdmin();

    }

    public function postAdminDelete($id) {
        $product = Product::find($id);
        $product->delete();
        return $this ->getIndexAdmin();
    }
}			
			