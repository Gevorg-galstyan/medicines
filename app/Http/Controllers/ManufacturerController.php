<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Manufacturer::orderBy('id', 'desc')->paginate(10);
        return view('manufacturer.browse', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Manufacturer();
        return view('manufacturer.edit-add',compact('data'));
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
            'name' => 'required'
        ]);
        $data = Manufacturer::create([
            'name' => $request->name
        ]);
        if ($data){
            return redirect()->route('manufacturer.index')->with([
                'message' => 'Create Manufacturer successfully ',
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Manufacturer::findOrFail($id);
        return view('manufacturer.edit-add',compact('data'));
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
            'name' => 'required'
        ]);
        $data = Manufacturer::findOrFail($id);
        $data->name = $request->name;
        $data->save();
        if ($data){
            return redirect()->route('manufacturer.index')->with([
                'message' => 'Update Manufacturer successfully ',
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
        $data = Manufacturer::findOrFail($id);
        if ($data->delete()){
            return 1;
        }
    }
}
