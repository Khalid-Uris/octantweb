<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddLoan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_loans';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'add_loan_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount_applied','bdo','loan_amount','application_submitted_incomplete','credit_memo_issued','octant_recommendation','uw_base_fee','additional_uw_fee_applied','cu_decision','signed_credit_memo','signed_commitment_letter','appraisal_order_date','appraisal_review_completed','closing_process','application_date','date_closed','notes'];
}
