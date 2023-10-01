@extends('admin.layouts.app')
@section('panel')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.product.image.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-body">
                                <div class="row align-items-end">
                                    <input type="hidden" name="id" value="{{ $product->id }}" required>

                                    <div class="col-lg-12 form-group mb-0">
                                        <label for="image">@lang('Add New Images')</label>
                                        <div class="file-upload-wrapper" data-text="@lang('Select your images!')">
                                            <input type="file" name="image[]" id="image" class="file-upload-field" accept=".jpg,.png,.jpeg" multiple/>
                                        </div>
                                        <div id="fileUploadsContainer"></div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn btn--primary btn-block">@lang('Upload')</button>
                                    </div>

                                    <div class="col-lg-12">
                                        <h5 class="my-2">@lang('Product Iamges')</h5>
                                        <div class="payment-method-header imageField">

                                            @foreach($product->images as $data)
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview" style="background-image: url('{{getImage(imagePath()['product']['path'].'/'.$data->image,imagePath()['product']['size'])}}')"></div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" name="image[]" class="profilePicUpload" id="image{{ $data->image }}" accept=".png, .jpg, .jpeg"/>
                                                        <label class="bg--danger removeImage" data-id='{{ $data->id }}'><i class="la la-trash"></i></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.product.image.delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                    <input type="hidden" name="id" value="" required>
                    <div class="modal-body">
                    <p class="font-weight-bold">@lang('Are you sure to delete this image')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--danger">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.product.update.page', $product->id) }}" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-desktop"></i>
        @lang('View Details')
    </a>
    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i>
        @lang('Go Back')
    </a>
@endpush

@push('script')
    <script>


        (function ($) {
            "use strict";
            $('.removeImage').on('click', function () {
                var modal = $('#deleteModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
