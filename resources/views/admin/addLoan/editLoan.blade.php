@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12 offset-md-12">
                    <form action="{{ route('loan.update',$edit->add_loan_id) }}" method="POST">
                        @csrf
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Add Loan Application
                                </h3>
                            </div>
                            <div class="card-body">
                                {{-- Row_1 --}}
                                <div class="row">
                                    {{-- col-md-6 --}}
                                    <div class="col-md-6 offset-md-12">

                                        <div class="form-group">
                                            <label for="exampleSelect1">Borrower</label>
                                            <select class="form-control" id="exampleSelect1" name="borrower_id">
                                                <option value=""> Select Borrower</option>
                                                @foreach ($borrower as $item)
                                                @if ($item->id==$edit->add_loan_id)
                                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                @else
                                                <option value="{{ $item->id }}"
                                                    @if (old('borrower_id') == $item->id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('borrower_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Amount Applied</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                    {{-- <span class="input-group-text">0.00</span> --}}
                                                </div>
                                                <input type="number" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    placeholder="Amount Applied *" name="amount_applied"
                                                    value="{{$edit->amount_applied}}" />
                                            </div>
                                            @error('amount_applied')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="my-input">
                                                BDO
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="bdo"
                                                placeholder="BDO" value="{{ $edit->bdo }}">
                                            @error('bdo')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Loan Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    placeholder="Amount Applied *" name="loan_amount"
                                                    value="{{ $edit->loan_amount }}" />

                                            </div>
                                            @error('loan_amount')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Credit Memo
                                                Issued</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="credit_memo_issued"
                                                value="{{ $edit->credit_memo_issued }}" />
                                            @error('credit_memo_issued')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="my-input">
                                                UW Base Fee
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="uw_base_fee"
                                                placeholder="UW Base Fee" value="{{ $edit->uw_base_fee }}">
                                            @error('uw_base_fee')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleSelect1">CU Decision</label>
                                            <select class="form-control" id="exampleSelect1" name="cu_decision">
                                                <option value=""> Select CU Decision</option>
                                                <option value="Approved"
                                                    @if ($edit->cu_decision == 'Approved')
                                                    selected
                                                    @endif>Approved</option>
                                                <option value="Decline"
                                                    @if ($edit->cu_decision == 'Decline')
                                                    selected @endif>Decline
                                                </option>
                                                <option value="Withdrawn"
                                                @if ($edit->cu_decision == 'Withdrawn')
                                                selected @endif>Withdrawn
                                                </option>
                                            </select>
                                            @error('cu_decision')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Signed Commitment
                                                Letter</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="signed_commitment_letter"
                                                value="{{ $edit->signed_commitment_letter }}" />
                                            @error('signed_commitment_letter')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Appraisal Review
                                                Completed</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="appraisal_review_completed"
                                                value="{{ $edit->appraisal_review_completed  }}" />
                                            @error('appraisal_review_completed')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Application Date</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="application_date"
                                                value="{{ $edit->application_date }}" />
                                            @error('application_date')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Status</label>
                                            <select class="form-control" id="exampleSelect1" name="status">
                                                <option value=""> Select Status</option>
                                                <option value="pending"
                                                    @if ($edit->status == 'pending') selected @endif>Pending</option>
                                                <option value="active"
                                                    @if ($edit->status  == 'active') selected
                                                    @endif>Active
                                                </option>
                                                <option value="archived"
                                                    @if ($edit->status == 'archived') selected @endif>Archived
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- col-md-6 --}}
                                    <div class="col-md-6 offset-md-12">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Loan Type</label>
                                            <select class="form-control" id="exampleSelect1" name="loan_type_id">
                                                <option value=""> Select Loan Type</option>
                                                @foreach ($loanType as $item)
                                                @if ($item->id==$edit->add_loan_id)
                                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                @else
                                                <option
                                                value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('loan_type_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleSelect1">Credit Union</label>
                                            <select class="form-control" id="exampleSelect1" name="credit_id">
                                                <option value=""> Select Credit Union</option>
                                                @foreach ($creditUnion as $item)
                                                @if ($item->credit_id==$edit->credit_id)
                                                    <option value="{{$item->credit_id}}" selected>{{$item->name}}</option>
                                                @else
                                                <option value="{{ $item->credit_id }}">
                                                    {{ $item->name }}</option>
                                                @endif

                                                @endforeach
                                            </select>
                                            @error('credit_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleSelect1">Octant employee</label>
                                            <select class="form-control" id="exampleSelect1" name="user_id">
                                                <option value=""> Select Octant employee</option>
                                                @foreach ($employee as $item)
                                                @if ($item->id==$edit->user_id)
                                                    <option value="{{$item->id}}" selected>{{$item->first_name.' '.$item->last_name}}</option>
                                                @else
                                                <option value="{{ $item->id }}">
                                                    {{ $item->first_name . ' ' . $item->last_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Application Submitted
                                                Incomplete</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="application_submitted_incomplete"
                                                value="{{ $edit->application_submitted_incomplete }}" />
                                            @error('application_submitted_incomplete')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleSelect1">Octant Recommendation</label>
                                            <select class="form-control" id="exampleSelect1" name="octant_recommendation">
                                                <option value="">TBP</option>
                                                <option value="Approved"
                                                    @if ($edit->octant_recommendation == 'Approved') selected @endif>Approved
                                                </option>
                                                <option value="Decline"
                                                    @if ($edit->octant_recommendation == 'Decline') selected @endif>Decline
                                                </option>
                                                <option value="Withdrawn"
                                                    @if ($edit->octant_recommendation == 'Withdrawn') selected @endif>Withdrawn
                                                </option>
                                            </select>
                                            @error('octant_recommendation')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Additional UW Fee Applied</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    placeholder="Additional UW Fee Applied" name="additional_uw_fee_applied"
                                                    value="{{ $edit->additional_uw_fee_applied }}" />
                                            </div>
                                            @error('additional_uw_fee_applied')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="my-input">
                                                Signed Credit Memo
                                            </label>
                                            <input id="my-input" class="form-control" type="text"
                                                name="signed_credit_memo" placeholder="Signed Credit Memo"
                                                value="{{ $edit->signed_credit_memo }}">
                                            @error('signed_credit_memo')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Appraisal Order
                                                Date</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="appraisal_order_date"
                                                value="{{ $edit->appraisal_order_date }}" />
                                            @error('appraisal_order_date')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleSelect1">Closing Process</label>
                                            <select class="form-control" id="exampleSelect1" name="closing_process">
                                                <option value="">Closing Process</option>
                                                <option value="Application"
                                                    @if ($edit->closing_process == 'Application') selected @endif>
                                                    Application</option>
                                                <option value="Underwriting"
                                                    @if ($edit->closing_process == 'Underwriting') selected @endif>
                                                    Underwriting</option>
                                                <option value="Closing"
                                                    @if ($edit->closing_process == 'Closing') selected @endif>Closing
                                                </option>
                                            </select>
                                            @error('closing_process')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="example-date-input">Date Closed</label>
                                            <input class="form-control" type="date"
                                                id="example-date-input" name="date_closed"
                                                value="{{ $edit->date_closed }}" />
                                        </div>
                                        @error('date_closed')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleTextarea">Notes</label>
                                        <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Add Notes"
                                            name="notes">{{ $edit->notes }}</textarea>
                                        @error('notes')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 offset-md-12">

                                        <br>


                                        {{-- <label class="checkbox">
                                            <input type="checkbox" name="serviced_loan" value="1" {{$edit->serviced_loan || old('serviced_loan', 0)==1 ? 'checked' : ''}} /> --}}
                                        <div class="form-group">
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input class="form-control" type="checkbox"
                                                        name="settlement_fees_approved" value="1" {{$edit->settlement_fees_approved || old('settlement_fees_approved',0)==1 ? 'checked' : ''}}/>
                                                    <span></span>
                                                    Settlement Fees Approved
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input class="form-control" type="checkbox" name="Loan_qcd"
                                                        value="1" {{$edit->Loan_qcd || old('Loan_qcd',0)==1 ? 'checked' : ''}}/>
                                                    <span></span>
                                                    Loan QC’d
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input class="form-control" type="checkbox" name="credit_and_Legal"
                                                        value="1" {{$edit->credit_and_Legal || old('credit_and_Legal',0)==1 ? 'checked' : ''}}/>
                                                    <span></span>
                                                    Credit & Legal File QC’d
                                                </label>

                                            </div>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="#" class="btn btn-primary font-weight-bolder font-size-sm">
                                                <span class="svg-icon svg-icon-md svg-icon-white">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path
                                                                d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path
                                                                d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Add Pre Closing Condition</a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
