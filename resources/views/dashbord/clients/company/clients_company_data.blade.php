<div class="" style="margin-top: 30px">
    @if(isset($companies_data) && !empty($companies_data))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="70%">
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>{{trans('clients.hash') }}</th>
                <th>{{ trans('clients.company_code') }}</th>
                <th>{{ trans('clients.name') }}</th>
                <th>{{ trans('clients.phone') }}</th>
                <th>{{ trans('clients.email') }}</th>
                <th>{{ trans('clients.address') }}</th>
                <th>{{ trans('clients.actions') }}</th>

            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;
            @endphp


            @foreach ($companies_data as $item)

                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ optional($item->company)->company_code }}</td>
                    <td>
                        {{ optional($item->company)->name }}
                    </td>
                    <td>
                        {{ optional($item->company)->phone }}
                    </td>
                    <td>
                        {{ optional($item->company)->email }}
                    </td>

                    <td>
                        {{ optional($item->company)->address1 }}
                    </td>

                    <td>
                        <div class="btn-group">
                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit_company({{ optional($item->company)->id }})" class="btn btn-sm btn-warning" title="{{ trans('clients.edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('admin.client_delete_company', optional($item->company)->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px !important;">
            <div class="modal-header">
                <h3 class="modal-title">Modal title</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div class="modal-body" id="result_info">


            </div>

        </div>
    </div>
</div>

@section('js')
    <script>
        function edit_company(id)
        {
            $.ajax({
                url: "{{ route('admin.client_edit_company', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection




