@extends('dashbord.layouts.master')
@section('css')
    <style>
        .permission-group {
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 0.475rem;
            padding: 15px;
        }
        .permission-group-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 8px 15px;
            background-color: #f5f8fa;
            border-radius: 6px;
        }
        .permission-group-title {
            font-size: 16px;
            font-weight: 600;
            margin-left: 10px;
            color: #3f4254;
        }
        .permission-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            padding: 10px 10px 5px 35px;
            margin-top: 5px;
            background-color: #f9fafb;
            border-radius: 6px;
            border-left: 3px solid #e1e3ea;
        }
        .select-all-label {
            font-weight: 500;
            color: #3f4254;
        }
    </style>
@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('users.users');
            $breadcrumbs = [
                ['label' => trans('Toolbar.home'), 'link' =>''],
                ['label' => trans('Toolbar.users'), 'link' => ''],
                ['label' => trans('Toolbar.'.$role->name), 'link' => ''],
            ];

            PageTitle($title, $breadcrumbs);
        @endphp

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ BackButton(route('admin.users.index'))}}
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content_container" class="t_container">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">{{trans('users.add_permission')}}</h3>
                <div class="card-toolbar">
                    <button type="button" id="select-all-permissions" class="btn btn-sm btn-primary me-2">
                        <i class="bi bi-check-all me-1"></i>{{ trans('roles.select_all_permissions') }}
                    </button>
                    <button type="button" id="deselect-all-permissions" class="btn btn-sm btn-light-primary">
                        <i class="bi bi-x-lg me-1"></i>{{ trans('roles.deselect_all_permissions') }}
                    </button>
                </div>
            </div>

            <form action="{{ route('admin.roles.role_permission.store',$role->id) }}" method="post" enctype="multipart/form-data" id="store_form">
                @csrf
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                @endif

                <!-- Permission Groups Container -->
                    <div class="permission-groups-container">
                        @foreach($permissions as $permission)
                            <div class="permission-group">
                                <div class="permission-group-header">
                                    <div class="form-check form-check-custom form-check-solid me-3">
                                        <input class="form-check-input permission-group-checkbox"
                                               type="checkbox"
                                               data-group="{{ $permission->id }}"
                                               id="select_all_{{ $permission->id }}" />
                                        <label class="form-check-label select-all-label" for="select_all_{{ $permission->id }}">
                                            {{ trans('roles.select_all') }}
                                        </label>
                                    </div>
                                    <span class="permission-group-title">{{ trans('roles.'.$permission->name) }}</span>
                                </div>

                                <!-- Child Permissions -->
                                <div class="permission-actions">
                                    @foreach($permission->children as $child)
                                        <div class="form-check form-check-custom form-check-solid mb-3">
                                            <input class="form-check-input permission-checkbox"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $child->id }}"
                                                   data-parent="{{ $permission->id }}"
                                                   id="permission_{{ $child->id }}"
                                                {{ in_array($child->id, $rolePermissions ?? []) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="permission_{{ $child->id }}">
                                               {{ trans('roles.'.$child->name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endforeach

                    <!-- Include parent permissions as hidden fields if selected -->
                        <div id="parent-permissions-container"></div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize checkboxes on page load
            updateAllParentCheckboxes();

            // Select all checkboxes for a specific group
            const groupCheckboxes = document.querySelectorAll('.permission-group-checkbox');
            groupCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const groupId = this.getAttribute('data-group');
                    const childCheckboxes = document.querySelectorAll(`[data-parent="${groupId}"]`);

                    childCheckboxes.forEach(function(childCheckbox) {
                        childCheckbox.checked = checkbox.checked;
                    });

                    // If the parent is checked, add it to the form submission
                    updateParentPermissionField(groupId, checkbox.checked);
                });
            });

            // Update parent checkbox state based on children
            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const parentId = this.getAttribute('data-parent');
                    updateParentCheckboxState(parentId);
                });
            });

            // Select all permissions button
            document.getElementById('select-all-permissions').addEventListener('click', function() {
                document.querySelectorAll('.permission-checkbox, .permission-group-checkbox').forEach(function(checkbox) {
                    checkbox.checked = true;

                    // If it's a parent checkbox, add it to the form
                    if(checkbox.classList.contains('permission-group-checkbox')) {
                        const groupId = checkbox.getAttribute('data-group');
                        updateParentPermissionField(groupId, true);
                    }
                });
            });

            // Deselect all permissions button
            document.getElementById('deselect-all-permissions').addEventListener('click', function() {
                document.querySelectorAll('.permission-checkbox, .permission-group-checkbox').forEach(function(checkbox) {
                    checkbox.checked = false;
                    checkbox.indeterminate = false;

                    // If it's a parent checkbox, remove it from the form
                    if(checkbox.classList.contains('permission-group-checkbox')) {
                        const groupId = checkbox.getAttribute('data-group');
                        updateParentPermissionField(groupId, false);
                    }
                });
            });

            // Add form submit handler
            document.getElementById('store_form').addEventListener('submit', function(e) {
                // Ensure all selected parent permissions are included
                groupCheckboxes.forEach(function(checkbox) {
                    if(checkbox.checked) {
                        const groupId = checkbox.getAttribute('data-group');
                        updateParentPermissionField(groupId, true);
                    }
                });
            });

            // Function to update parent checkbox state
            function updateParentCheckboxState(parentId) {
                const parentCheckbox = document.querySelector(`[data-group="${parentId}"]`);
                const siblingCheckboxes = document.querySelectorAll(`[data-parent="${parentId}"]`);

                const allChecked = Array.from(siblingCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(siblingCheckboxes).some(cb => cb.checked);

                parentCheckbox.checked = allChecked;
                parentCheckbox.indeterminate = someChecked && !allChecked;

                // Update parent permission field
                updateParentPermissionField(parentId, allChecked);
            }

            // Function to update all parent checkboxes on page load
            function updateAllParentCheckboxes() {
                const parentIds = new Set();

                // Collect all unique parent IDs
                document.querySelectorAll('.permission-checkbox').forEach(function(checkbox) {
                    parentIds.add(checkbox.getAttribute('data-parent'));
                });

                // Update each parent checkbox state
                parentIds.forEach(function(parentId) {
                    updateParentCheckboxState(parentId);
                });
            }

            // Function to add/remove parent permission hidden field
            function updateParentPermissionField(parentId, isChecked) {
                const container = document.getElementById('parent-permissions-container');
                const existingField = document.getElementById(`parent_permission_${parentId}`);

                // Remove existing field if any
                if(existingField) {
                    existingField.remove();
                }

                // Add new field if checked
                if(isChecked) {
                    const hiddenField = document.createElement('input');
                    hiddenField.setAttribute('type', 'hidden');
                    hiddenField.setAttribute('name', 'permissions[]');
                    hiddenField.setAttribute('value', parentId);
                    hiddenField.setAttribute('id', `parent_permission_${parentId}`);
                    container.appendChild(hiddenField);
                }
            }
        });
    </script>
@endsection
