@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Category | Brand')</th>
                                <th>@lang('Price | Discount')</th>
                                <th>@lang('Final Price')</th>
                                <th>@lang('Stock | SKU')</th>
                                <th>@lang('Sold')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td data-label="@lang('SL')">
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                <td data-label="@lang('Name')" class="text-left">
                                    @if($product->featured)
                                    <h3 class="text--success fw-bold d-inline" data-toggle="tooltip" title="@lang('Featured')">&#9679;</h3>
                                    @endif
                                    <span class="font-weight-bold">{{ shortDescription($product->name, 30) }}</span>
                                </td>

                                <td data-label="@lang('Category | Brand')">
                                    <div>{{ __($product->category->name) }}</div>
                                    <strong>{{ __($product->brand->name) }}</strong>
                                </td>
                                <td data-label="@lang('Amount')">

                                    {{ $general->cur_sym }}{{ showAmount($product->price) }}
                                    <div class="font-weight-bold">
                                        {{ getAmount($product->discount, 2) }}@lang('%')
                                    </div>

                                </td>

                                <td data-label="@lang('Final Price')">
                                    @php
                                        $discount = $product->hot_deal == 1 ? $general->hot_deal_discount :  $product->discount;
                                    @endphp
                                    <span class="font-weight-bold">{{ $general->cur_sym }}{{ afterDiscount($product->price,  $discount) }}</span>
                                </td>
                                <td data-label="@lang('Stock')">
                                    <div class="font-weight-bold">{{$product->stock != 0 ? $product->stock : 'Stock Out'  }}</div>
                                    {{ $product->sku }}

                                </td>

                                <td data-label="@lang('Sold')">
                                    {{ $product->sold }} @lang('Pcs')
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($product->status == 0)
                                        <span class="badge badge--danger">@lang('Disabled')</span>
                                    @else
                                        <span class="badge badge--success">@lang('Enabled')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.product.image.page', $product->id) }}" class="icon-btn btn--dark ml-1" data-toggle="tooltip"  data-original-title="@lang('Images')">
                                        <i class="las la-image text--shadow"></i>
                                    </a>



                                    @if($product->hot_deal == 0)
                                        <button data-route="{{ route('admin.product.hot.deal', $product->id) }}" class="icon-btn btn--info hot-deal ml-1" data-toggle="tooltip"  data-original-title="@lang('Add as hot deal')">
                                            <i class="las la-fire-alt"></i>
                                        </button>
                                    @else
                                        <button data-route="{{ route('admin.product.hot.deal', $product->id) }}" class="icon-btn btn--danger remove-hot-deal ml-1" data-toggle="tooltip"  data-original-title="@lang('Remove from hot deals')">
                                            <i class="las la-fire-alt"></i>
                                        </button>
                                    @endif

                                    <a href="{{ route('admin.product.update.page', $product->id) }}" class="icon-btn ml-1" data-toggle="tooltip"  data-original-title="@lang('Edit')">
                                        <i class="la la-pencil-alt text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($products) }}
                </div>
            </div>
        </div>

    </div>

 <div class="modal fade" id="hotdealModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">

                    <i class="las la-exclamation-circle text--info display-2 mb-15"></i>

                    <h5 class="text--secondary mb-15">@lang('Are you sure want to add this product as hot deal?')</h5>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                <button type="submit"  class="btn btn--info del">@lang('Yes')</button>
            </div>

            </form>
        </div>
    </div>
</div>

 <div class="modal fade" id="removedealModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">

                    <i class="las la-exclamation-circle text--danger display-2 mb-15"></i>
                    <h6 class="text--secondary mb-15">@lang('Are you sure want to remove this product from hot deal?')</h6>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                <button type="submit"  class="btn btn--danger del">@lang('Yes')</button>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection



@push('breadcrumb-plugins')
<div class="d-flex flex-wrap justify-content-sm-end">

    <form action="" method="GET" class="form-inline float-sm-right bg--white mt-2 mr-2">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Name / SKU')" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <a href="{{ route('admin.product.add.page') }}" class="btn btn-sm btn--primary box--shadow1 text--small d-inline-flex justify-content-center align-items-center mt-2">
        <i class="la la-fw la-plus"></i>@lang('Add New')
    </a>
</div>
@endpush

@push('script')
    <script>
        'use strict';
        $('.hot-deal').on('click',function(){
            var route = $(this).data('route')
            var modal = $('#hotdealModal');
            modal.find('form').attr('action',route)
            modal.modal('show');
        })
        $('.remove-hot-deal').on('click',function(){
            var route = $(this).data('route')
            var modal = $('#removedealModal');
            modal.find('form').attr('action',route)
            modal.modal('show');
        })
    </script>
@endpush
