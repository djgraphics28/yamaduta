@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <form class="register prevent-double-click create__ticket__form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form--group">
                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                            data-trigger="fileinput">
                                        <img class="w-100" src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="@lang('Image')" id="imgShow">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>

                                    <div class="img-input-div mt-3">

                                        <input type="file" class="form-control form--control m-0 profilePicUpload" name="image" accept="image/*">

                                    </div>

                                    <code>@lang('Image size') {{imagePath()['profile']['user']['size']}}</code>
                                </div>
                            </div>

                            <div class="form--group">
                                <div class="mb-2">@lang('Full Name'): {{$user->fullname}}</div>
                                <div class="mb-2">@lang('Username'): {{$user->username}}</div>
                                <div class="mb-2">@lang('E-mail Address'): {{$user->email}}</div>
                                <div class="mb-2">@lang('Mobile Number'): {{$user->mobile}}</div>
                                <div class="mb-2">@lang('Country'):{{@$user->address->country}}</div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form--group">
                                <label for="InputFirstname" class="col-form-label">@lang('First Name'):</label>
                                <input type="text" class="form-control form--control" id="InputFirstname" name="firstname" placeholder="@lang('First Name')" value="{{$user->firstname}}" minlength="3">
                            </div>
                            <div class="form--group">
                                <label for="lastname" class="col-form-label">@lang('Last Name'):</label>
                                <input type="text" class="form-control form--control" id="lastname" name="lastname" placeholder="@lang('Last Name')" value="{{$user->lastname}}" required>
                            </div>

                            <div class="form--group">
                                <label for="address" class="col-form-label">@lang('Address'):</label>
                                <input type="text" class="form-control form--control" id="address" name="address" placeholder="@lang('Address')" value="{{@$user->address->address}}" required="">
                            </div>
                            <div class="form--group">
                                <label for="state" class="col-form-label">@lang('State'):</label>
                                <input type="text" class="form-control form--control" id="state" name="state" placeholder="@lang('state')" value="{{@$user->address->state}}" required="">
                            </div>

                            <div class="form--group">
                                <label for="zip" class="col-form-label">@lang('Zip Code'):</label>
                                <input type="text" class="form-control form--control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{@$user->address->zip}}" required="">
                            </div>

                            <div class="form--group">
                                <label for="city" class="col-form-label">@lang('City'):</label>
                                <input type="text" class="form-control form--control" id="city" name="city" placeholder="@lang('City')" value="{{@$user->address->city}}" required="">
                            </div>
                        </div>

                    </div>



                    <div class="form--group row pt-5">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn--primary border-0 w-100">@lang('Update Profile')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



@push('script')
     <script>
            'use strict';
            (function ($) {
                function proPicURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imgShow').attr('src',e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                }

                $(".profilePicUpload").on('change', function () {
                  proPicURL(this);
                });
            })(jQuery);
     </script>
@endpush
