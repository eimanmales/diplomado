<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = DB::table('tb_municipio as m')
                    ->join('tb_departamento','m.depa_codi','=','tb_departamento.depa_codi')
                    ->select('m.muni_codi','m.muni_nomb','m.depa_codi','tb_departamento.depa_nomb')
                    ->get();
        return view('municipio.index', compact('municipios'));
        //return $comunas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $municipios = Municipio::orderBy('muni_nomb')->get();
        return view('comuna.create',compact('municipios'));
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
        $comuna = new Comuna;
        //$flight->name = $request->name
        $comuna->comu_nomb = $request->comu_nomb;
        $comuna->muni_codi = $request->muni_codi;
        $comuna->save();
        return redirect()->route('comuna.index')->with('status','guardado');
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
        $comuna = Comuna::findOrFail($id);
        $municipios = Municipio::all();
        return view('comuna.edit', compact('comuna','municipios'));
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
        $comuna = Comuna::findOrFail($id);
        $comuna->fill($request->all());
        $comuna->save();
        return redirect()->route('comuna.index')->with('status','actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comuna = Comuna::findOrFail($id);
        $comuna->delete();
        return redirect()->route('comuna.index')->with('status','eliminado');
    }
}
