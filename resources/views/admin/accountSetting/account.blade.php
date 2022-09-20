@extends('admin.master')
@section('content')
    <section>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <!--begin::Example-->
                            <div class="example">

                                <div class="example-preview">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-chat-1"></i>
                                                </span>
                                                <span class="nav-text">Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                aria-controls="profile">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-layers-1"></i>
                                                </span>
                                                <span class="nav-text">Password</span>
                                            </a>
                                        </li>
                                    </ul>
                                    {{-- In Below Code Add Form --}}
                                    <div class="tab-content mt-5" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            {{-- Tab content 1 --}}
                                            @include('admin.accountSetting.profile')
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            {{-- Tab content 2 --}}
                                            @include('admin.accountSetting.passwordChange')
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
                {{-- Image Update --}}
                <div class="col-md-4">
                    <form action="" method="POST" enctype="multipart/form-data">

                    </form>
                    <div class="card text-center">
                        <div class="card-body " style="padding-top: 150px; ">
                            <div class="form-group">
                                <img src="{{ URL::asset($editSetting->image) }}" alt="error" width="200px" height="200px"
                                    class="image-response">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalLong">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal-->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>

                <form action="{{route('setting.settingImage')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Image</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image"/>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
