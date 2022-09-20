<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Exception;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loanType.addLoanType');
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
            'name'=>'required|alpha|max:255',
            'uw_base_fee'=>'required|numeric'
        ]);

        try {

            $obj=new LoanType();
            $obj->name=$request->name;
            $obj->uw_base_fee=$request->uw_base_fee;
            $obj->serviced_loan=$request->has('serviced_loan');
            $obj->save();

            //return $obj;
            return redirect()->route('loan-type.show');

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
        $show=LoanType::all();
        return view('admin.loanType.showLoanType')->with('show',$show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=LoanType::find($id);
        return view('admin.loanType.editLoanType')->with('edit',$edit);
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
            'name'=>'required|max:255',
            'uw_base_fee'=>'required|numeric'
        ]);

        try {
            $obj=LoanType::find($id);
            $obj->name=$request->name;
            $obj->uw_base_fee=$request->uw_base_fee;
            $obj->serviced_loan=$request->has('serviced_loan');
            $obj->save();

            //return $obj;
            return redirect()->route('loan-type.show');

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
        $destroy=LoanType::find($id)->delete();
        return redirect()->route('loan-type.show');
    }
}
