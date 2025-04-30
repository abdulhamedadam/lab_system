@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('permissions.permissions');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' =>''],
                  ['label' => trans('Toolbar.roles'), 'link' => ''],
                  ['label' => trans('Toolbar.create_permission'), 'link' => ''],


                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ BackButton(route('admin.permissions.index'))}}

        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

            <div class="card-header">
                <h3 class="card-title">{{trans('roles.add_permission')}}</h3>
                <div class="card-toolbar">

                    <div class="text-center">

                    </div>
                </div>
            </div>


            <form action="{{ route('admin.permissions.store') }}" method="post" enctype="multipart/form-data"
                  id="store_form">
                @csrf
                <div class="card-body">
                    <div class="row col-md-12" style="margin: 10px">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{trans('permission.name')}}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">{{trans('users.parent_page')}}</label>
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="parent_id" name="parent_id">
                                <option value="">{{trans('products.select')}}</option>
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}" {{ old('parent_id') == $permission->id ? 'selected' : '' }}>{{$permission->name}}</option>
                                @endforeach

                            </select>
                        </div>


                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ trans('tests.save') }}
                    </button>
                </div>
            </form>
        </div>

    </div>


@stop
@section('js')
    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function () {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


@endsection

