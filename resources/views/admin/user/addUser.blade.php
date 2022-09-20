@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12 offset-md-12">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Add User
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
                                                placeholder="Enter First Name" value="{{ old('first_name') }}">
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
                                                    name="email" value="{{ old('email') }}" />
                                            </div>
                                            @error('email')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="my-input">Image </label>
                                        @include('admin.user.addImage')

                                    </div>
                                    {{-- col-md-6 --}}
                                    <div class="col-md-6 offset-md-12">
                                        <div class="form-group">
                                            <label for="my-input">
                                                Last Name
                                            </label>
                                            <input id="my-input" class="form-control" type="text" name="last_name"
                                                placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="my-input">
                                                Password
                                            </label>
                                            <input id="my-input" class="form-control" type="password" name="password"
                                                placeholder="Enter Password" value="{{ old('password') }}">
                                            @error('password')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="role_value">
                                            <label for="exampleSelect1">Role</label>
                                            <select class="form-control" name="role" id="role_value">
                                                <option value="" selected>--Select Role--</option>
                                                <option value="admin"
                                                    @if (old('role') == 'admin') {{ 'selected' }} @endif>Admin
                                                </option>
                                                <option value="Employee"
                                                    @if (old('role') == 'Employee') {{ 'selected' }} @endif>Employee
                                                </option>
                                                <option value="Client"
                                                    @if (old('role') == 'Client') {{ 'selected' }} @endif>Client
                                                </option>
                                            </select>
                                            @error('role')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="credit_union">
                                            <label for="exampleSelect1">Credit Union</label>
                                            <select class="form-control exampleSelect1" name="credit_id" >
                                                <option value="">Select Credit Union</option>
                                                @foreach ($creditUnion as $item)
                                                    <option value="{{ $item->credit_id }}">{{ $item->name }}</option>
                                                @endforeach
                                                {{-- <option value="Admin"
                                                    @if (old('role') == 'Admin') {{ 'selected' }} @endif>Admin
                                                </option> --}}

                                            </select>
                                            @error('role')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
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

    <script>
        $(document).ready(function() {

            $('#credit_union').hide();
            $('#role_value').change(function() {
                if ($('#role_value').val() == 'Client') {
                    $('#credit_union').show();
                } else {
                    $('#credit_union').hide();
                }
            });

        });
    </script>
    {{-- <script>
        $(document).ready(function() {

            $('#edit_credit_union').hide();
            $('#edit_role_value').change(function() {
                if ($('#edit_role_value').val() == 'client') {
                    $('#edit_credit_union').show();
                } else {
                    $('#edit_credit_union').hide();
                }
            });

        });
    </script> --}}
@endsection
