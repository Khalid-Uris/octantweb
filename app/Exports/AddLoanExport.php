<?php

namespace App\Exports;

use App\Models\AddLoan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AddLoanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // "CONCAT(users.first_name,' ',users.last_name) as full_name"
        return AddLoan::join('borrowers','borrowers.id','add_loans.borrower_id')
        ->join('loan_types','loan_types.id','add_loans.loan_type_id')
        ->join('credit_unions','credit_unions.credit_id','add_loans.credit_id')
        ->join('users','users.id','add_loans.user_id')->where('users.role','Employee')->whereIn('status',['pending','active'])
        ->select('add_loans.add_loan_id','borrowers.name as borrower_name','loan_types.name as loan_type_name','add_loans.amount_applied','add_loans.application_date','credit_unions.name as credit_union_name','add_loans.bdo',DB::raw("CONCAT(users.first_name,' ',users.last_name)"),'add_loans.loan_amount','add_loans.application_submitted_incomplete','add_loans.credit_memo_issued','add_loans.octant_recommendation','add_loans.uw_base_fee','add_loans.additional_uw_fee_applied','add_loans.cu_decision','add_loans.signed_credit_memo','add_loans.signed_commitment_letter','add_loans.appraisal_order_date','add_loans.appraisal_review_completed','add_loans.closing_process','add_loans.status','add_loans.date_closed','add_loans.notes')->get();
    }
    public function headings(): array
    {
        return [
            'Loan Id',
            'Borrower',
            'Loan Type',
            'Amount Applied',
            'Application Date',
            'Credit Union',
            'BDO',
            'Employee',
            'Loan Amount',
            'Application Submitted Incomplete',
            'Credit Demo',
            'Octant Recommendation',
            'UW Base Fee',
            'UW Additional Fee Comments',
            'CU Decision',
            'Signed Credit Memo',
            'Signed Commitment Letter',
            'Appraisal And ENV Ordered',
            'Appraisal And ENV Complete',
            'Closing Process',
            'Status',
            'Date',
            'Notes',
        ];
    }
}
