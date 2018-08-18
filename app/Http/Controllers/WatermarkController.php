<?php

namespace App\Http\Controllers;

use App\Helpers\Image;
use App\Models\Watermark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WatermarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Watermark::orderBy('id', 'desc')->paginate(10);
        return view('watermark.browse', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Watermark();
        return view('watermark.edit-add',compact('data'));
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
            'image' => 'required|image|mimes:jpg,png,gif,jpeg',
        ]);
        $data = new Watermark();
        $data->image =  (new Image($request, 'watermarks', 'image'))->handle();
        if ($data->save()){
            return redirect()->route('watermark.index')->with([
                'message' => 'Create Watermark successfully ',
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
    public function edit($id)
    {
        $data = Watermark::findOrFail($id);
        return view('watermark.edit-add',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpg,png,gif,jpeg',
        ]);
        $data = Watermark::findOrFail($id);
            if (Storage::disk('public')->exists($data->image)){
                Storage::disk('public')->delete($data->image);
            }

        $data->image = (new Image($request, 'watermarks', 'image'))->handle();

        if ($data->save()){
            return redirect()->route('watermark.index')->with([
                'message' => 'Update Watermark successfully ',
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
    public function destroy($id)
    {
        $data = Watermark::findOrFail($id);
        if (Storage::disk('public')->exists($data->image)){
            Storage::disk('public')->delete($data->image);
        }
        if ($data->delete()){
            return  1;
        }
    }
}
