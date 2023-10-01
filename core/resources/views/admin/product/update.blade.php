@extends('admin.layouts.app')
@section('panel')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}" required>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('Main Image') <span class="text--danger">*</span></label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url({{ getImage(imagePath()['product']['path'].'/'.$product->image) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>

                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                            <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png').</b> @lang('Image will be resized into 450x495') </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <label for="name">@lang('Product Name')<span class="text--danger">*</span></label>
                                </label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-xl-6">
                                    <label class="font-weight-bold">
                                        @lang('Category') <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <select name="category" class="form-control select2-basic" required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-xl-6">
                                    <div class="input-group mb-3">
                                        <label class="font-weight-bold">
                                            @lang('Brand') <span class="text-danger">*</span>
                                        </label>
                                        <select name="brand" class="form-control select2-basic" required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ __($brand->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="font-weight-bold">
                                        @lang('Price') <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">{{ __($general->cur_sym) }}</div>
                                        </div>
                                        <input type="number" class="form-control" step="any" placeholder="0" name="price" value="{{ getAmount($product->price) }}" required>
                                    </div>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="font-weight-bold">@lang('Discount')</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" step="0.01" placeholder="0" name="discount" value="{{ getAmount($product->discount) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">@lang('%')</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="font-weight-bold">
                                        @lang('SKU') <span class="text-danger">*</span>
                                        <strong></strong>
                                    </label>
                                    <input type="text" class="form-control "  name="sku" value="{{ $product->sku }}" required>
                                </div>

                                <div class="form-group  col-xl-6">
                                    <label class="font-weight-bold">@lang('Product Stock')<span class="text--danger">*</span></label>
                                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="featured">@lang('Featured')</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" id="featured" data-on="@lang('Enable')" data-off="@lang('Disable')" name="featured" @if($product->featured) checked @endif>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="status">@lang('Status')</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" id="status" data-on="@lang('Enable')" data-off="@lang('Disable')" name="status" @if($product->status) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">@lang('Description')</label>
                        <textarea rows="15" class="form-control border-radius-5 nicEdit" name="description">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn--primary btn-block">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('breadcrumb-plugins')
<a href="{{ route('admin.product.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small d-inline-flex justify-content-center align-items-center mt-2">
    <i class="la la-fw la-backward"></i>@lang('Go Back')
</a>
@endpush


@push('script')
    <script>
        'use strict';
        (function($){
            $('select[name=category]').val({{ $product->category_id }}).select2();
            $('select[name=brand]').val({{ $product->brand_id }}).select2();
        })(jQuery)
    </script>
@endpush
