<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class SearchController extends Controller
{
    
    public function search(Request $request){
        $searchtext = $request->input('search');
        
    //   $result = Inventory::where('prodName','LIKE','%'.$searchtext.'%')->with('category')->get();
        return view('admin.itemSearchResult',compact('searchtext')); 
    }

}
