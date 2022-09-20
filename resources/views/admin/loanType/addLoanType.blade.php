@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12 offset-md-12">
                    <form action="{{route('loan-type.store')}}" method="POST">
                        @csrf
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Add Loan Type
                                </h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 offset-md-12">
                                        <div class="form-group">
                                            <label for="my-input">
                                                Name
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="name"
                                                placeholder="Enter Name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="my-input">
                                                UW Base Fee
                                            </label>
                                            <input id="my-input" class="form-control" type="number" name="uw_base_fee"
                                                placeholder="UW Base Fee" value="{{ old('uw_base_fee') }}">
                                            @error('uw_base_fee')
                                                <span class="text text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group">

                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="serviced_loan"  value="1"/>
                                                    <span></span>
                                                    Serviced Loan
                                                </label>

                                            </div>
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
