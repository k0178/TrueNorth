<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class storePagesController extends Controller
{
    public function index(){
        $title = "Home";
        // $products= Auction::all()->take(5);
        $products= Auction::where('aucStatus','=',1)->take(6)->orderBy('id', 'DESC')->get();
        return view('pages.home',compact('title'))->with('products',$products);
    }

    
    public function store_index(Request $request){
        $title = "True North Auction | Store";
    
            $products= Auction::where('aucStatus','=',1)->orderBy('endDate','DESC')->get();
        
        return view('pages.store',compact('title','products'));
    }
    public function search(){
        $title = "True North Auction | Store";
        $search = $_GET['search'];
        $products = Auction::where('prodName','LIKE', "%$search%")
        ->where('aucStatus','=',1)
        ->get();

        return view('pages.store',compact('title','products'));
    }
//Pre-Loved
    //Men
    public function menTopsPL(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'T','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menBottomsPL(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'P','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menShortsPL(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'S','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
  

    //Women
    public function womenTopsPL(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'T','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenBottomsPL(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'P','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenShortsPL(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'S','aucStatus'=>1,'cond'=>'Pre-Loved'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
   
//Brand New
    //Men
    public function menTopsBN(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'T','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menBottomsBN(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'P','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menShortsBN(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'S','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
  

    //Women
    public function womenTopsBN(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'T','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenBottomsBN(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'P','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenShortsBN(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'S','aucStatus'=>1,'cond'=>'Brand New'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }


//Bulk
    //Men
    public function menTopsBK(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'T','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menBottomsBK(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'P','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function menShortsBK(){
        $title = "Men | Tops";
        $where = ['category'=>'M','type'=>'S','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
  

    //Women
    public function womenTopsBK(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'T','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenBottomsBK(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'P','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
    public function womenShortsBK(){
        $title = "Women | Tops";
        $where = ['category'=>'W','type'=>'S','aucStatus'=>1,'cond'=>'Bulk'];
        $products= Auction::where($where)->get();
        return view('pages.store',compact('title'))->with('products',$products);
    }
}
