<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;

use App\Ot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OtController extends Controller
{
    /**
     * OtController constructor.
     */
    public function __construct ()
    {
        $this->middleware ('roles:1,2, 9')->except ('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim ( $request->get ( 'searchText' ) );
            $ots = Ot::orderBy('id', 'ASC')
                ->where ('codigo', 'like', '%'.$query.'%')
                ->orWhere ('obra', 'like', '%'.$query.'%')
                ->orWhere ('id', 'like', '%'.$query.'%')
                ->paginate(6);

        }

        return view ('ots.index', ['ots'=>$ots, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('ots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request, [
            'codigo' => 'required|unique:ots',
            'obra' => 'required|unique:ots',
            'referencia' => 'required'
        ]);

        $ot = new Ot($request->all ());
        $ot->save ();

        return redirect ('ots');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function show(Ot $ot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ot = Ot::findOrFail ($id);

        return view ('ots.edit', ['ot'=>$ot]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request, [
            'codigo' => ['required', Rule::unique ('ots', 'codigo')->ignore ($id)],
            'obra' => ['required', Rule::unique ('ots', 'obra')->ignore ($id)],
            'referencia' => 'required'
        ]);

        $ot = Ot::findOrFail ($id);
        $ot->fill ($request->all ());
        $ot->update ();

        return redirect ('ots');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ot = Ot::findOrFail ($id);
        $ot->delete ();

        return redirect ('ots');
    }
}
