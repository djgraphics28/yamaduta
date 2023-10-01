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
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($brands as $brand)
                            <tr>

                                <td data-label="@lang('SL')">
                                    {{ $brands->firstItem() + $loop->index }}
                                </td>

                                <td data-label="@lang('Name')">
                                    <span class="font-weight-bold">
                                        {{ __($brand->name) }}
                                    </span>
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($brand->status == 1)
                                        <span class="badge badge--success">
                                            @lang('Enable')
                                        </span>
                                    @else
                                        <span class="badge badge--warning">
                                            @lang('Disable')
                                        </span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    <button class="icon-btn editBtn" data-toggle="tooltip" title="" data-original-title="@lang('Edit')"
                                    data-name="{{ $brand->name }}"
                                    data-id="{{ $brand->id }}"
                                    data-status='{{ $brand->status }}'
                                    >
                                        <i class="las la-edit text--shadow"></i>
                                    </button>

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
                @if($brands->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($brands) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ADD METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New Brand')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.add.brand') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label for="name">@lang('Brand Name')</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- UPDATE METHOD MODAL --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Brand')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.update.brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label for="editName">@lang('Brand Name')</label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                            <input type="hidden" name="id">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="edit_status">@lang('Status')</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" id="edit_status" data-on="@lang('Enable')" data-off="@lang('Disable')" name="status">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn--primary box--shadow1 text--small addNew" type="submit">
        <i class="las la-plus"></i>
        @lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.addNew').on('click', function () {
                var modal = $('#addModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.editBtn').on('click', function () {
                var modal = $('#editModal');
                modal.find('input[name=name]').val($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));

                if($(this).data('status') == 1){
                    modal.find('input[name=status]').bootstrapToggle('on');
                }else{
                    modal.find('input[name=status]').bootstrapToggle('off');
                }

                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
