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
                  ['label' => trans('Toolbar.permission_list'), 'link' => ''],


                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ AddButton(route('admin.permissions.create')) }}


        </div>
    </div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="t_container"
         style="">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">


            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <h2>{{ trans('roles.permissions_list') }}</h2>
                </div>

            </div>


            <div class="card-body">
                <div class="card-body">
                    <div class="">

                        {{-- views/admin/categories/index.blade.php --}}
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="text-align: center;">{{ trans('permissions.id') }}</th>
                                <th style="text-align: center;">{{ trans('permissions.name') }}</th>
                                <th style="text-align: center;">{{ trans('permissions.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr style="background: #f0f0f0;">
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: start; font-weight: bold;">{{ $permission->name }}</td>
                                    <td style="text-align: end;">
                                        <a href="{{ route('admin.roles.edit', $permission->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> {{ trans('roles.edit') }}
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ trans('users.delete_confirm') }}');">
                                                <i class="bi bi-trash"></i> {{ trans('roles.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @foreach($permission->children as $child)
                                    <tr>
                                        <td style="text-align: center;">--</td>
                                        <td style="text-align: center; padding-left: 30px;"> {{ $child->name }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('admin.permissions.edit', $child->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> {{ trans('roles.edit') }}
                                            </a>

                                            <form action="{{ route('admin.permissions.destroy', $child->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ trans('users.delete_confirm') }}');">
                                                    <i class="bi bi-trash"></i> {{ trans('roles.delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>




                    </div>
                </div>


            </div>


        </div>
    </div>


@endsection

@section('js')

@endsection
