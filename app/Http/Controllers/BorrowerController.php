<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Exception;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.borrower.addBorrower');
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
            'name'=>'required|alpha'
        ]);

        try {

            $obj=new Borrower();
            $obj->name=$request->name;
            $obj->save();

            //return $obj;
            return redirect()->route('borrowers.show');

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
        $show=Borrower::all();
        return view('admin.borrower.showBorrower')->with('show',$show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Borrower::find($id);
        return view('admin.borrower.editBorrower')->with('edit',$edit);
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
            'name'=>'required|alpha'
        ]);

        try {

            $obj=Borrower::find($id);
            $obj->name=$request->name;
            $obj->save();

            //return $obj;
            return redirect()->route('borrowers.show');

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
        $destroy=Borrower::find($id)->delete();
        return redirect()->route('borrowers.show');
    }
}
