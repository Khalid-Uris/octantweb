@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12 offset-md-12">
                    <form action="{{ route('user.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Update User
                                </h3>
                            </div>
                            <div class="card-body">
                                {{-- Row_1 --}}
                                <div class="row">
                                    {{-- col-md-6 --}}
                                    <div class="col-md-6 offset-md-12">
                                        <div class="form-group">
                                            <label for="my-input">
                                                First Name
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="first_name"
                                                placeholder="Enter First Name" value="{{ $edit->first_name }}">
                                            @error('first_name')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">@</span>
                                                </div>
                                                <input type="email" class="form-control" placeholder="Enter Email"
                                                    name="email" value="{{ $edit->email }}" />
                                                @error('email')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <label for="my-input">Image </label>
                                        @include('admin.user.editImage')
                                        @error('image')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- col-md-6 --}}
                                    <div class="col-md-6 offset-md-12">
                                        <div class="form-group">
                                            <label for="my-input">
                                                Last Name
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="last_name"
                                                placeholder="Enter Last Name" value="{{ $edit->last_name }}">
                                            @error('last_name')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="my-input">
                                                Password
                                            </label>
                                            <input id="my-input" class="form-control" type="password" name="city_name"
                                                placeholder="Enter Password" value="{{ old('city_name') }}">
                                                @error('first_name')
                                                <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group">
                                            <label for="exampleSelect1">Role</label>
                                            <select class="form-control" name="role" id="exampleSelect1">
                                                <option value="">--Select Role--</option>
                                                <option value="Admin" @if ($edit->role == 'Admin') selected @endif>
                                                    Admin</option>
                                                <option value="Employee" @if ($edit->role == 'Employee') selected @endif>
                                                    Employee</option>
                                                <option value="Client" @if ($edit->role == 'Client') selected @endif>
                                                    Client</option>

                                            </select>
                                            @error('role')
                                                <span class="text text-danger">{{ $message }}</span>
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
