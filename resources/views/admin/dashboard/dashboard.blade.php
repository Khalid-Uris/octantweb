@extends('admin.master')
@section('content')
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="padding-top: 15px;">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span>
                                    Octant Business Services Pipeline
                                </span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Stats Widget 1-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">ACTIVE LOANS/TOTAL AMOUNT</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <!--begin::label-->
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-10">
                                <span>{{$totalAllLoans}} /</span>
                                <span class="font-weight-normal font-size-h6 text-muted pr-1">$</span>{{$sumAllLoans}}</span>
                            <!--end::label-->
                            <!--begin::Chart-->

                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 1-->
                </div>

                <div class="col-md-3">
                    <!--begin::Stats Widget 1-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">PENDING LOANS</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <!--begin::label-->
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-10">
                                <span>{{$pendingCount}} /</span>
                                <span class="font-weight-normal font-size-h6 text-muted pr-1">$</span>{{$pendingSum}}</span>
                            <!--end::label-->
                            <!--begin::Chart-->

                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 1-->
                </div>

                <div class="col-md-3">
                    <!--begin::Stats Widget 1-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">APPROVED LOANS</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <!--begin::label-->
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-10">
                                <span>{{$activeCount}}/</span>
                                <span class="font-weight-normal font-size-h6 text-muted pr-1">$</span>{{$activeSum}}</span>
                            <!--end::label-->
                            <!--begin::Chart-->

                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 1-->
                </div>

                <div class="col-md-3">
                    <!--begin::Stats Widget 1-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">ARCHIVED LOANS</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <!--begin::label-->
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-10">
                                {{$archiveCount}}</span>
                            <!--end::label-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 1-->
                </div>
            </div>
        </div>

    </section>
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-title">
                                        <h4>Octant Pipeline</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('loan.export')}}" class="btn btn-primary">Export CSV</a>
                                    </div>

                                </div>
                                <div class="col-md-4" style="padding-top: 100px; padding-bottom:40px;">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Search By Credit Union</label>
                                            <select class="form-control" id="exampleSelect1" name="credit_id">
                                                <option value="">Select Credit Union</option>
                                                @foreach ($creditUnions as $item)
                                                    <option value="{{ $item->credit_id }}"
                                                        @if (old('credit_id') == $item->credit_id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('credit_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                             <!--begin: Datatable-->
                             <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Loan Name</th>
                                        <th>Loan Amount</th>
                                        <th>Borrower Name</th>
                                        <th>Status</th>
                                        <th>Credit Union</th>
                                        <th>Employee</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($search as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->application_date }}</td>
                                            <td>{{ $item->loan_type_name }}</td>
                                            <td>{{ $item->loan_amount }}</td>
                                            <td>{{ $item->borrower_name }}</td>
                                            @if ($item->status=='pending')
                                                <td><span class="label label-success label-pill label-inline mr-2">Pending</span></td>
                                            @else
                                                <td><span class="label label-primary label-pill label-inline    mr-2">Active</span></td>
                                            @endif
                                            <td>{{ $item->credit_union_name }}</td>
                                            <td>{{ $item->first_name . ' ' . $item->last_name }}</td>

                                            <td class="pr-0 text-center">
                                                {{-- {{route('borrowers.edit',$item->id)}} --}}
                                                <a href="{{route('loan.edit',$item->add_loan_id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                {{-- {{route('borrowers.destroy',$item->id)}} --}}
                                                <a href="{{route('loan.updateToStatusArchived',$item->add_loan_id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero" />
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                            <td nowrap="nowrap"></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <!--end: Datatable-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
