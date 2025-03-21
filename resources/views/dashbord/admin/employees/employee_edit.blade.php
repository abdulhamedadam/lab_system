@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{trans('employees.edit_employee')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.employee_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{trans('employees.back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.update_employee', $employee->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="emp_code" class="form-label">{{ trans('employees.emp_code') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <input type="text" class="form-control" name="emp_code" id="emp_code" value="{{ $employee->emp_code }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="first_name" class="form-label">{{ trans('employees.first_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}">
                                </div>
                                @error('first_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="last_name" class="form-label">{{ trans('employees.last_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}">
                                </div>
                                @error('last_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="email" class="form-label">{{ trans('employees.email') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-envelope fs-2"></i></span>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $employee->email) }}">
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="national_id" class="form-label">{{ trans('employees.national_id') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <input type="number" class="form-control" name="national_id" id="national_id" value="{{ old('national_id', $employee->national_id) }}">
                                </div>
                                @error('national_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="religion" class="form-label">{{ trans('employees.religion') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="religion" id="religion" data-placeholder="{{ trans('employees.select') }}">
                                            <option value="">{{ trans('employees.select') }}</option>
                                            <option value="muslim" {{ old('religion', $employee->religion) == 'muslim' ? 'selected' : '' }}>{{ trans('employees.muslim') }}</option>
                                            <option value="mese7y" {{ old('religion', $employee->religion) == 'mese7y' ? 'selected' : '' }}>{{ trans('employees.mese7y') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('religion')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="phone" class="form-label">{{ trans('employees.phone') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-phone fs-2"></i></span>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="whatsapp_num" class="form-label">{{ trans('employees.whatsapp_num') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-phone fs-2"></i></span>
                                    <input type="text" class="form-control" name="whatsapp_num" id="whatsapp_num" value="{{ old('whatsapp_num', $employee->whatsapp_num) }}">
                                </div>
                                @error('whatsapp_num')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="address" class="form-label">{{ trans('employees.address') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-house-door fs-2"></i></span>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $employee->address) }}">
                                </div>
                                @error('address')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="date_of_birth" class="form-label">{{ trans('employees.date_of_birth') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                                </div>
                                @error('date_of_birth')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="governate_id" class="form-label">{{ trans('employees.governate') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="governate_id" id="governate_id" onchange="get_area(this.value)" data-placeholder="{{ trans('employees.select') }}">
                                            <option value="">{{ trans('employees.select') }}</option>
                                            @foreach($governates as $item)
                                                <option value="{{ $item->id }}" {{ old('governate_id', $employee->governate_id) == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('governate_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="area_id" class="form-label">{{ trans('employees.area') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="area_id" id="area_id" value="{{ old('area_id', $employee->area_id) }}" data-placeholder="{{ trans('employees.select') }}">
                                            <option value="">{{ trans('employees.select') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('area_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="gender" class="form-label">{{ trans('employees.gender') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="gender" id="gender" data-placeholder="{{ trans('employees.select') }}">
                                            <option value="">{{ trans('employees.select') }}</option>
                                            <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>{{ trans('employees.male') }}</option>
                                            <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>{{ trans('employees.female') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="material_status" class="form-label">{{ trans('employees.material_status') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="material_status" id="material_status" data-placeholder="{{ trans('employees.select') }}">
                                            <option value="">{{ trans('employees.select') }}</option>
                                            <option value="single" {{ old('material_status', $employee->material_status) == 'single' ? 'selected' : '' }}>{{ trans('employees.single') }}</option>
                                            <option value="married" {{ old('material_status', $employee->material_status) == 'married' ? 'selected' : '' }}>{{ trans('employees.married') }}</option>
                                            <option value="divorced" {{ old('material_status', $employee->material_status) == 'divorced' ? 'selected' : '' }}>{{ trans('employees.divorced') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('material_status')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="position" class="form-label">{{ trans('employees.position') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-briefcase fs-2"></i></span>
                                    <input type="text" class="form-control" name="position" id="position" value="{{ old('position', $employee->position) }}">
                                </div>
                                @error('position')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="salary" class="form-label">{{ trans('employees.salary') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-cash fs-2"></i></span>
                                    <input type="text" class="form-control" name="salary" id="salary" value="{{ old('salary', $employee->salary) }}">
                                </div>
                                @error('salary')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="branch_id" class="form-label">{{ trans('employees.branch_id') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <select class="form-select rounded-start-0" name="branch_id" id="branch_id" data-placeholder="{{ trans('employees.select') }}">
                                        <option value="">{{ trans('employees.select') }}</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('branch_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="personal_photo" class="form-label">{{ trans('employees.personal_photo') }}</label>
                                <div class="input-group flex-nowrap">
                                    <input type="file" class="form-control" name="personal_photo" id="personal_photo">

                                </div>
                                @error('personal_photo')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                @if($employee->profile_picture)
                                    <img src="{{ asset('images/' . $employee->profile_picture) }}" alt="Current Photo" class="img-thumbnail" width="100">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save fs-2"></i> {{ trans('employees.save') }}
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>








@endsection

@section('js')


    @notifyJs
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#governate_id").trigger("change");
            }, 300);
        });
    </script>


    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function() {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>

    @notifyJs
    <script>
        function get_area(id)
        {
            $.ajax({
                url: "{{ route('admin.get_area', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#area_id').html(html);
                    $('#area_id').val(<?= old('area_id',$employee->area_id)?> );

                },
            });
        }
    </script>
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;
            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script>
        function numeric_only (event, input) {
            if ((event.which < 32) || (event.which > 126)) return true;
            return jQuery.isNumeric ($(input).val () + String.fromCharCode (event.which));
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Employees\AddEmployeeRequest', '#store_form') !!}
@endsection



