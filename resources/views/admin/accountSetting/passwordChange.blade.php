<section>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 offset-md-12">
                <form action="{{ route('setting.settingPassword') }}" method="POST">
                    @csrf
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                                <h3>Password Update</h3>
                        </div>
                        <div class="card-body">
                            {{-- Row_1 --}}
                            <div class="row">
                                {{-- col-md-6 --}}
                                <div class="col-md-12 offset-md-12">
                                    <div class="form-group">
                                        <label for="my-input">
                                            Current Password
                                        </label>
                                        <input id="my-input" class="form-control" type="password" name="old_password"
                                            placeholder="Current Password" value="{{ old('old_password') }}">
                                        @if ($errors->has('old_password'))
                                            <div class="text text-danger">{{ $errors->first('old_password') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="my-input">
                                            New Password
                                        </label>
                                        <input id="my-input" class="form-control" type="password" name="new_password"
                                            placeholder="New Password" value="{{ old('new_password') }}">
                                        @if ($errors->has('new_password'))
                                            <div class="text text-danger">{{ $errors->first('new_password') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="my-input">
                                            Confirm Password
                                        </label>
                                        <input id="my-input" class="form-control" type="password"
                                            name="confirmed_password" placeholder="Confirm Password"
                                            value="{{ old('confirmed_password') }}" required>
                                        @if ($errors->has('confirmed_password'))
                                            <div class="text text-danger">{{ $errors->first('confirmed_password') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                {{-- col-md-6 --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
