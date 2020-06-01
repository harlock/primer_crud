<?php

namespace App\Http\Controllers;

use App\Corona;
use Illuminate\Http\Request;

class CoronaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coronacases = Corona::all();

        return view('coronas.index', compact('coronacases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return ("hola desde el metodo create del controlador");
        return view('coronas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());

        $validatedData = $request->validate([
            'country_name' => 'required|max:255',
            'symptoms' => 'required',
            'cases' => 'required|numeric',
        ]);
        $show = Corona::create($validatedData);

        return redirect('/coronas')->with('success', 'Corona Case is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corona  $corona
     * @return \Illuminate\Http\Response
     */
    public function show(Corona $corona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corona  $corona
     * @return \Illuminate\Http\Response
     */
    public function edit(Corona $corona)
    {
        //
        $coronacase = Corona::findOrFail($corona->id);
       // $coronacase=$corona;
        return view('coronas.edit', compact('coronacase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corona  $corona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corona $corona)
    {
        $validatedData = $request->validate([
            'country_name' => 'required|max:255',
            'symptoms' => 'required',
            'cases' => 'required|numeric',
        ]);
        Corona::whereId($corona->id)->update($validatedData);

        return redirect('/coronas')->with('success', 'Corona Case Data is successfully updated');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corona  $corona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corona $corona)
    {
        //
        $coronacase = Corona::findOrFail($corona->id);
        $coronacase->delete();

        return redirect('/coronas')->with('success', 'Corona Case Data is successfully deleted');
    }
}
