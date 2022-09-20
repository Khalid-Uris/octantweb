<?php

namespace App\Http\Controllers;

use App\Models\AddLoan;
use App\Models\CreditUnion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $creditUnions=CreditUnion::all();
        $addLoan=AddLoan::all();
        $totalAllLoans=AddLoan::count();
        $sumAllLoans=AddLoan::sum('loan_amount');
        $pendingCount=AddLoan::where('status','pending')->count();
        $pendingSum=AddLoan::where('status','pending')->sum('loan_amount');
        $activeCount=AddLoan::where('status','active')->count();
        $activeSum=AddLoan::where('status','active')->sum('loan_amount');
        $archiveCount=AddLoan::where('status','archived')->count();

        $search=AddLoan::query()->join('borrowers','borrowers.id','add_loans.borrower_id')
        ->join('loan_types','loan_types.id','add_loans.loan_type_id')
        ->join('credit_unions','credit_unions.credit_id','add_loans.credit_id')
        ->join('users','users.id','add_loans.user_id')->where('users.role','Employee')->whereIn('status',['pending','active'])
        ->select('borrowers.name as borrower_name','loan_types.name as loan_type_name','credit_unions.name as credit_union_name','add_loans.application_date','add_loans.loan_amount','users.first_name','users.last_name','add_loans.status','add_loans.add_loan_id');

        if (isset($request->credit_id)) {
            $search=$search->where('add_loans.credit_id',$request->credit_id);
        }
        $search=$search->get();


        return view('admin.dashboard.dashboard')
        ->with('totalAllLoans',$totalAllLoans)
        ->with('sumAllLoans',$sumAllLoans)
        ->with('pendingCount',$pendingCount)
        ->with('pendingSum',$pendingSum)
        ->with('activeCount',$activeCount)
        ->with('activeSum',$activeSum)
        ->with('archiveCount',$archiveCount)
        ->with('creditUnions',$creditUnions)
        ->with('addLoan',$addLoan)
        ->with('search',$search);
    }
    public function search()
    {
        $search=AddLoan::join('borrowers','borrowers.id','add_loans.borrower_id')
        ->join('loan_types','loan_types.id','add_loans.loan_type_id')
        ->join('credit_unions','credit_unions.credit_id','add_loans.credit_id')
        ->join('users','users.id','add_loans.user_id')->where('users.role','Employee')->whereIn('status',['pending','active'])
        ->select('borrowers.name as borrower_name','loan_types.name as loan_type_name','credit_unions.name as credit_union_name','add_loans.application_date','add_loans.loan_amount','users.first_name','users.last_name','add_loans.status','add_loans.add_loan_id')->get();
        return view('admin.dashboard.dashboard')->with('search',$search);
    }
}
