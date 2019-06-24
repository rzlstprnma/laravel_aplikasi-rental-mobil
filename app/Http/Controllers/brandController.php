<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use DataTables;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::create($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return redirect()->back();
    }

    public function data(){
        $brand = Brand::all();        
        return DataTables::of($brand)->addColumn('action', function($brand){
            return '
            <a onclick="deleteData('.$brand->id.')" class="btn btn-danger text-white btn-sm"><i class="ti-trash"> Delete</i></a>';
        })->make(true);
    }
}
