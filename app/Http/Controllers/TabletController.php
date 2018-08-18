<?php

namespace App\Http\Controllers;

use App\Helpers\Image;
use App\Models\Manufacturer;
use App\Models\Tablet;
use App\Models\Type;
use App\Models\Watermark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TabletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tablet::orderBy('id', 'desc')->paginate(10);
        return view('tablet.browse', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Type();
        $types = Type::orderBy('id', 'desc')->get();
        $manufacturers = Manufacturer::orderBy('id', 'desc')->get();
        $watermarks = Watermark::orderBy('id', 'desc')->get();
        return view('tablet.edit-add',compact('data','types', 'manufacturers','watermarks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'type' => 'required|integer',
            'manufacturer' => 'required|integer',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,gif,jpeg|nullable',

        ]);

        $data = new Tablet();
        $slug = str_slug($request->name);
        if (Tablet::where('slug', $slug)->first()){
            $slug .= '-'.time();
        }


        $data->type_id = $request->type;
        $data->manufacturer_id = $request->manufacturer;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->slug = $slug;
        $data->image =  (new Image($request, 'tablet', 'image',Auth::user()->name.'/'.$data->slug.'/'))->handle();
        if ($data->save()){

            return redirect()->route('tablet.index')->with([
                'message' => 'Create Tablet successfully ',
                'alert-type' => 'success',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Tablet::where('slug', $slug)->firstOrFail();
        $types = Type::orderBy('id', 'desc')->get();
        $manufacturers = Manufacturer::orderBy('id', 'desc')->get();
        $watermarks = Watermark::orderBy('id', 'desc')->get();
        return view('tablet.edit-add',compact('data','types', 'manufacturers', 'watermarks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request,[
            'name' => 'required',
            'type' => 'required|integer',
            'manufacturer' => 'required|integer',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,gif,jpeg|nullable',

        ]);

        $data =  Tablet::where('slug', $slug)->firstOrFail();

        $data->type_id = $request->type;
        $data->manufacturer_id = $request->manufacturer;
        $data->name = $request->name;
        $data->description = $request->description;
        if ($request->image){
            if (Storage::disk('public')->exists($data->image)){
                Storage::disk('public')->delete($data->image);
            }
        }
        $data->image =  $request->image ? (new Image($request, 'tablet', 'image',Auth::user()->name.'/'.$data->slug.'/'))->handle(): $data->image;

        if ($data->save()){
            return redirect()->route('tablet.index')->with([
                'message' => 'Create Tablet successfully ',
                'alert-type' => 'success',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $data =  Tablet::where('slug', $slug)->firstOrFail();
        if (Storage::disk('public')->exists($data->image)){
            Storage::disk('public')->delete($data->image);
        }
        if ($data->delete()){
            return  1;
        }
    }
}
