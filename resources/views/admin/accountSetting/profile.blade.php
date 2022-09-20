<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('setting.storeSetting') }}" method="POST">
                    @csrf
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (Session::has('old_password'))
                        <div class="alert alert-success">{{Session::get('old_password')}}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3>Profile Updated</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="my-input">
                                    First Name
                                </label>
                                <input id="my-input" class="form-control" type="text" name="first_name"
                                    placeholder="Enter First Name" value="{{ $editSetting->first_name }}">
                                @error('first_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="my-input">
                                    Last Name
                                </label>
                                <input id="my-input" class="form-control" type="text" name="last_name"
                                    placeholder="Enter Last Name" value="{{ $editSetting->last_name }}">
                                @error('last_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                        value="{{ $editSetting->email }}" />
                                </div>
                                @error('email')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

</section>
