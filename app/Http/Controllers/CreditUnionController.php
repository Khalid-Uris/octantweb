<?php

namespace App\Http\Controllers;

use App\Models\CreditUnion;
use Exception;
use Illuminate\Http\Request;

class CreditUnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.creditUnion.addCreditUnion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255'
        ]);

        try {
            $obj=new CreditUnion();
            $obj->name=$request->name;
            $obj->save();

            //return $obj;
            return redirect()->route('credit-union.show');
        } catch (Exception $ex) {

            return back()->withError($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $show=CreditUnion::all();
        return view('admin.creditUnion.showCreditUnion')->with('show',$show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=CreditUnion::find($id);
        return view('admin.creditUnion.editCreditUnion')->with('edit',$edit);
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
        $request->validate([
            'name'=>'required|max:255'
        ]);

        try {
            $obj=CreditUnion::find($id);
            $obj->name=$request->name;
            $obj->save();

            //return $obj;
            return redirect()->route('credit-union.show');
        } catch (Exception $ex) {

            return back()->withError($ex->getMessage());
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
        $destroy=CreditUnion::find($id)->delete();
        return redirect()->route('credit-union.show');
    }
}
