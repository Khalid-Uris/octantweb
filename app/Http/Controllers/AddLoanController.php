<?php

namespace App\Http\Controllers;

use App\Exports\AddLoanExport;
use App\Exports\AddLoansExport;
use App\Exports\IndividualExport;
use App\Models\AddLoan;
use App\Models\Borrower;
use App\Models\CreditUnion;
use App\Models\LoanType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AddLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=User::where('role','Employee')->get();
        $borrower=Borrower::all();
        $loanType=LoanType::all();
        $creditUnion=CreditUnion::all();
        $user=User::all();
        return view('admin.addLoan.addLoan')
        ->with('borrower',$borrower)->with('loanType',$loanType)
        ->with('creditUnion',$creditUnion)->with('user',$user)->with('employee',$employee);
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
            'borrower_id'=>'required',
            'loan_type_id'=>'required',
            'credit_id'=>'required',
            'amount_applied'=>'required|numeric',
            'bdo'=>'required',
            'user_id'=>'required',
            'loan_amount'=>'required|numeric',
            'application_submitted_incomplete'=>'required|date',
            'credit_memo_issued'=>'required',
            'octant_recommendation'=>'required',
            'uw_base_fee'=>'required',
            'additional_uw_fee_applied'=>'required',
            'cu_decision'=>'required',
            'signed_credit_memo'=>'required',
            'signed_commitment_letter'=>'required',
            'appraisal_order_date'=>'required',
            'appraisal_review_completed'=>'required',
            'closing_process'=>'required',
            'signed_credit_memo'=>'required',
            'application_date'=>'required',
            'date_closed'=>'required',
            'notes'=>'required',
        ]);
        try {
            $obj=new AddLoan();
         $obj->borrower_id=$request->borrower_id;
         $obj->loan_type_id =$request->loan_type_id;
         $obj->credit_id=$request->credit_id;
         $obj->amount_applied=$request->amount_applied;
        $obj->bdo=$request->bdo;
        $obj->user_id =$request->user_id ;
        $obj->loan_amount=$request->loan_amount;
        $obj->application_submitted_incomplete=$request->application_submitted_incomplete;
        $obj->credit_memo_issued=$request->credit_memo_issued;
        $obj->octant_recommendation=$request->octant_recommendation;
        $obj->uw_base_fee=$request->uw_base_fee;
        $obj->additional_uw_fee_applied=$request->additional_uw_fee_applied;
        $obj->cu_decision=$request->cu_decision;
        $obj->signed_credit_memo=$request->signed_credit_memo;
        $obj->signed_commitment_letter=$request->signed_commitment_letter;
        $obj->appraisal_order_date=$request->appraisal_order_date;
        $obj->appraisal_review_completed=$request->appraisal_review_completed;
        $obj->closing_process=$request->closing_process;
        $obj->application_date=$request->application_date;
        $obj->date_closed=$request->date_closed;
        $obj->status='pending';
        $obj->notes=$request->notes;
        $obj->settlement_fees_approved=$request->has('settlement_fees_approved');
        $obj->Loan_qcd=$request->has('Loan_qcd');
        $obj->credit_and_Legal=$request->has('credit_and_Legal');
        $obj->save();

        //return $obj;
        return redirect()->route('loan.show');
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
        $show=AddLoan::join('borrowers','borrowers.id','add_loans.borrower_id')
        ->join('loan_types','loan_types.id','add_loans.loan_type_id')
        ->join('credit_unions','credit_unions.credit_id','add_loans.credit_id')
        ->join('users','users.id','add_loans.user_id')->where('users.role','Employee')->whereIn('status',['pending','active'])
        ->select('borrowers.name as borrower_name','loan_types.name as loan_type_name','credit_unions.name as credit_union_name','add_loans.application_date','add_loans.loan_amount','users.first_name','users.last_name','add_loans.status','add_loans.add_loan_id')->get();
        return view('admin.addLoan.showLoan')->with('show',$show);
    }

    public function archivedLoanShow()
    {
        //return 'Hello';
        $archivedLoanShow=AddLoan::join('borrowers','borrowers.id','add_loans.borrower_id')
        ->join('loan_types','loan_types.id','add_loans.loan_type_id')
        ->join('credit_unions','credit_unions.credit_id','add_loans.credit_id')
        ->join('users','users.id','add_loans.user_id')->where('users.role','Employee')->where('add_loans.status','archived')
        ->select('borrowers.name as borrower_name','loan_types.name as loan_type_name','credit_unions.name as credit_union_name','add_loans.application_date','add_loans.loan_amount','users.first_name','users.last_name','add_loans.status','add_loans.add_loan_id','add_loans.amount_applied')->get();
        return view('admin.archives.showArchives')->with('archivedLoanShow',$archivedLoanShow);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee=User::where('role','Employee')->get();
        $borrower=Borrower::all();
        $loanType=LoanType::all();
        $creditUnion=CreditUnion::all();
        $edit=AddLoan::find($id);
        return view('admin.addLoan.editLoan')->with('employee',$employee)->with('borrower',$borrower)->with('loanType',$loanType)->with('creditUnion',$creditUnion)->with('edit',$edit);
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
            'borrower_id'=>'required',
            'loan_type_id'=>'required',
            'credit_id'=>'required',
            'amount_applied'=>'required|numeric',
            'bdo'=>'required',
            'user_id'=>'required',
            'loan_amount'=>'required|numeric',
            'application_submitted_incomplete'=>'required|date',
            'credit_memo_issued'=>'required',
            'octant_recommendation'=>'required',
            'uw_base_fee'=>'required',
            'additional_uw_fee_applied'=>'required',
            'cu_decision'=>'required',
            'signed_credit_memo'=>'required',
            'signed_commitment_letter'=>'required',
            'appraisal_order_date'=>'required',
            'appraisal_review_completed'=>'required',
            'closing_process'=>'required',
            'signed_credit_memo'=>'required',
            'application_date'=>'required',
            'date_closed'=>'required',
            'notes'=>'required',
            'status'=>'required'
        ]);
        try {
            $obj=AddLoan::find($id);
         $obj->borrower_id=$request->borrower_id;
         $obj->loan_type_id =$request->loan_type_id;
         $obj->credit_id=$request->credit_id;
         $obj->amount_applied=$request->amount_applied;
         $obj->bdo=$request->bdo;
         $obj->user_id =$request->user_id ;
         $obj->loan_amount=$request->loan_amount;
         $obj->application_submitted_incomplete=$request->application_submitted_incomplete;
         $obj->credit_memo_issued=$request->credit_memo_issued;
         $obj->octant_recommendation=$request->octant_recommendation;
         $obj->uw_base_fee=$request->uw_base_fee;
         $obj->additional_uw_fee_applied=$request->additional_uw_fee_applied;
         $obj->cu_decision=$request->cu_decision;
         $obj->signed_credit_memo=$request->signed_credit_memo;
         $obj->signed_commitment_letter=$request->signed_commitment_letter;
         $obj->appraisal_order_date=$request->appraisal_order_date;
         $obj->appraisal_review_completed=$request->appraisal_review_completed;
         $obj->closing_process=$request->closing_process;
         $obj->application_date=$request->application_date;
         $obj->date_closed=$request->date_closed;
         $obj->status=$request->status;
         $obj->notes=$request->notes;
         $obj->settlement_fees_approved=$request->has('settlement_fees_approved');
         $obj->Loan_qcd=$request->has('Loan_qcd');
         $obj->credit_and_Legal=$request->has('credit_and_Legal');
         $obj->save();

        //return $obj;
        return redirect()->route('loan.show');
        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new AddLoanExport, 'loans.xlsx');
    }
    public function ExportIndividualIdToCSV($loan_id)
    {
        return Excel::download(new IndividualExport($loan_id),$loan_id.'.csv');
        //return Excel::download(new IndividualExport($loan_id), $loan_id.'.csv');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateToStatusArchived($id)
    {
        AddLoan::where('add_loan_id',$id)->update([
            'status'=>'archived'
        ]);
        return back();
    }

    public function updateToStatusPending($id)
    {
        AddLoan::where('add_loan_id',$id)->update([
            'status'=>'pending'
        ]);
        return back();
    }
    public function destroy($id)
    {
        $borrower=Borrower::all();
        $loanType=LoanType::all();
        $creditUnion=CreditUnion::all();
        $user=User::all();

        $destroy=AddLoan::find($id)->delete();
        return redirect()->route('loan.archivedLoanShow')->with('delete_record','Record has been delete successfully!');
    }
}
