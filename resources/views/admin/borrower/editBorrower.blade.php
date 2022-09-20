@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12 offset-md-12">
                    <form action="{{route('borrowers.update',$edit->id)}}" method="POST">
                        @csrf
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Update Borrower
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 offset-md-12">
                                            <label for="my-input">
                                                Name
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="name"
                                                placeholder="Enter Name" value="{{ $edit->name }}">
                                            @error('name')
                                                <span class="text text-danger">{{$message}}</span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
