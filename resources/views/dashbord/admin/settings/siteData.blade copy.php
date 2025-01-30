@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row col-md-12">
            <div class="col-md-3">
                @include('dashbord.admin.settings.sidebar')
            </div>
            <div class="col-md-9">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="" style="padding-top: 20px">
                        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('settings.siteData') }}</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    {{-- <table id="table1" class="table table-bordered">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th style="width: 5%">{{ trans('m') }}</th>
                                                <th style="text-align: center">{{ trans('settings.name') }}</th>
                                                <th style="text-align: center">{{ trans('settings.email') }}</th>
                                                <th style="text-align: center">{{ trans('settings.address') }}</th>
                                                <th style="text-align: center">{{ trans('settings.fax') }}</th>
                                                <th style="text-align: center">{{ trans('settings.phone') }}</th>
                                                <th style="width: 20%; text-align: center">{{ trans('settings.actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> --}}
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('admin.save_siteData') }}" enctype="multipart/form-data"
                                            id="form">
                                            @csrf
                                            <input type="hidden" name="row_id" id="row_id" value="">

                                            <div class="row col-md-12" style="margin: 10px">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">{{ trans('settings.name') }}</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">{{ trans('settings.email') }}</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address" class="form-label">{{ trans('settings.address') }}</label>
                                                    <input type="text" class="form-control" name="address" id="address" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fax" class="form-label">{{ trans('settings.fax') }}</label>
                                                    <input type="text" class="form-control" name="fax" id="fax" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label">{{ trans('settings.phone') }}</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="discount_ratio" class="form-label">{{ trans('settings.discount_ratio') }}</label>
                                                    <input type="number" class="form-control" name="discount_ratio" id="discount_ratio" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tax_number" class="form-label">{{ trans('settings.tax_number') }}</label>
                                                    <input type="text" class="form-control" name="tax_number" id="tax_number" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="commercial_registration_number" class="form-label">{{ trans('settings.commercial_registration_number') }}</label>
                                                    <input type="text" class="form-control" name="commercial_registration_number" id="commercial_registration_number" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="maplocation" class="form-label">{{ trans('settings.maplocation') }}</label>
                                                    <input type="text" class="form-control" name="maplocation" id="maplocation" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="video" class="form-label">{{ trans('settings.video') }}</label>
                                                    <input type="text" class="form-control" name="video" id="video" value="">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="description" class="form-label">{{ trans('settings.description') }}</label>
                                                    <textarea class="form-control" name="description" id="description"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="short_about" class="form-label">{{ trans('settings.short_about') }}</label>
                                                    <textarea class="form-control" name="short_about" id="short_about"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="contract_terms" class="form-label">{{ trans('settings.contract_terms') }}</label>
                                                    <textarea class="form-control" name="contract_terms" id="contract_terms"></textarea>
                                                </div>
                                            </div>
                                            <div class="row col-md-12" style="margin: 10px">
                                                <div class="col-md-6">
                                                    <label for="image" class="form-label">{{ trans('settings.image') }}</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="image_print" class="form-label">{{ trans('settings.image_print') }}</label>
                                                    <input type="file" class="form-control" name="image_print" id="image_print">
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="margin-top: 10px">
                                                <button type="submit" name="submit" value="add"
                                                    class="btn btn-primary">{{ trans('settings.save') }}</button>
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">{{ trans('settings.cancel') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="modalsiteData">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{ trans('settings.add_siteData') }}</h3>


                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>
                {{-- <div class="modal-body">
                    <form method="post" action="{{ route('admin.save_siteData') }}" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <input type="hidden" name="row_id" id="row_id" value="">

                        <div class="row col-md-12" style="margin: 10px">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ trans('settings.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ trans('settings.email') }}</label>
                                <input type="email" class="form-control" name="email" id="email" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">{{ trans('settings.address') }}</label>
                                <input type="text" class="form-control" name="address" id="address" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="fax" class="form-label">{{ trans('settings.fax') }}</label>
                                <input type="text" class="form-control" name="fax" id="fax" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{ trans('settings.phone') }}</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="discount_ratio" class="form-label">{{ trans('settings.discount_ratio') }}</label>
                                <input type="number" class="form-control" name="discount_ratio" id="discount_ratio" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="tax_number" class="form-label">{{ trans('settings.tax_number') }}</label>
                                <input type="text" class="form-control" name="tax_number" id="tax_number" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="commercial_registration_number" class="form-label">{{ trans('settings.commercial_registration_number') }}</label>
                                <input type="text" class="form-control" name="commercial_registration_number" id="commercial_registration_number" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="maplocation" class="form-label">{{ trans('settings.maplocation') }}</label>
                                <input type="text" class="form-control" name="maplocation" id="maplocation" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="video" class="form-label">{{ trans('settings.video') }}</label>
                                <input type="text" class="form-control" name="video" id="video" value="">
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="form-label">{{ trans('settings.description') }}</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="short_about" class="form-label">{{ trans('settings.short_about') }}</label>
                                <textarea class="form-control" name="short_about" id="short_about"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="contract_terms" class="form-label">{{ trans('settings.contract_terms') }}</label>
                                <textarea class="form-control" name="contract_terms" id="contract_terms"></textarea>
                            </div>
                        </div>
                        <div class="row col-md-12" style="margin: 10px">
                            <div class="col-md-6">
                                <label for="image" class="form-label">{{ trans('settings.image') }}</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                            <div class="col-md-6">
                                <label for="image_print" class="form-label">{{ trans('settings.image_print') }}</label>
                                <input type="file" class="form-control" name="image_print" id="image_print">
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 10px">
                            <button type="submit" name="submit" value="add"
                                class="btn btn-primary">{{ trans('settings.save') }}</button>
                            <button type="button" class="btn btn-light"
                                data-bs-dismiss="modal">{{ trans('settings.cancel') }}</button>
                        </div>
                    </form>
                </div> --}}

            </div>
        </div>
    </div>
@endsection

@section('js')
    "use strict";
    <script type="text/javascript">
        var save_method; // For the save method string
        var table;
        var dt;
    </script>


    <script>
        "use strict";
        var KTDatatablesServerSide = function() {
            var initDatatable = function() {
                $.ajax({
                url: "{{ route('admin.edit_siteData', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function(data) {
                    var allData = data.all_data;

                    // Set values for standard fields
                    $('#row_id').val(allData.id);
                    $('#email').val(allData.email);
                    $('#fax').val(allData.fax);
                    $('#phone').val(allData.phone);
                    $('#video').val(allData.video);
                    $('#discount_ratio').val(allData.discount_ratio);
                    $('#tax_number').val(allData.tax_number);
                    $('#commercial_registration_number').val(allData.commercial_registration_number);
                    $('#maplocation').val(allData.maplocation);
                    $('#short_about').val(allData.short_about);
                    $('#transport_value').val(allData.transport_value);

                    $('#name').val(data.translations.name || '');
                    $('#address').val(data.translations.address || '');
                    $('#description').val(data.translations.description || '');
                    $('#contract_terms').val(data.translations.contract_terms || '');
                    // console.log(allData.image);
                    if (allData.image) {
                        $('#image').next('.image-preview').remove();
                        $('#image').after('<img src="' + allData.image +
                            '" alt="Image Preview" class="image-preview" style="max-width: 100px; margin-top: 10px;">'
                            );
                    }

                    if (allData.image_print) {
                        $('#image_print').next('.image-preview').remove();
                        $('#image_print').after('<img src="' + allData.image_print +
                            '" alt="Image Print Preview" class="image-preview" style="max-width: 100px; margin-top: 10px;">'
                            );
                    }
                },
                error: function() {
                    alert('Error fetching data. Please try again.');
                }
            });
            };

            return {
                init: function() {
                    initDatatable();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function() {
            KTDatatablesServerSide.init();
        });
    </script>


    <script>
        function edit_siteData(id) {
            $.ajax({
                url: "{{ route('admin.edit_siteData', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function(data) {
                    var allData = data.all_data;

                    // Set values for standard fields
                    $('#row_id').val(allData.id);
                    $('#email').val(allData.email);
                    $('#fax').val(allData.fax);
                    $('#phone').val(allData.phone);
                    $('#video').val(allData.video);
                    $('#discount_ratio').val(allData.discount_ratio);
                    $('#tax_number').val(allData.tax_number);
                    $('#commercial_registration_number').val(allData.commercial_registration_number);
                    $('#maplocation').val(allData.maplocation);
                    $('#short_about').val(allData.short_about);
                    $('#transport_value').val(allData.transport_value);

                    $('#name').val(data.translations.name || '');
                    $('#address').val(data.translations.address || '');
                    $('#description').val(data.translations.description || '');
                    $('#contract_terms').val(data.translations.contract_terms || '');
                    // console.log(allData.image);
                    if (allData.image) {
                        $('#image').next('.image-preview').remove();
                        $('#image').after('<img src="' + allData.image +
                            '" alt="Image Preview" class="image-preview" style="max-width: 100px; margin-top: 10px;">'
                            );
                    }

                    if (allData.image_print) {
                        $('#image_print').next('.image-preview').remove();
                        $('#image_print').after('<img src="' + allData.image_print +
                            '" alt="Image Print Preview" class="image-preview" style="max-width: 100px; margin-top: 10px;">'
                            );
                    }
                },
                error: function() {
                    alert('Error fetching data. Please try again.');
                }
            });
        }
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\SaveSiteDataRequest', '#form') !!}
@endsection
