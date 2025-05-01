<style>
    #kt_profile_overview_table {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #dee2e6;
    }

    #kt_profile_overview_table th,
    #kt_profile_overview_table td {
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
        padding: 12px 15px;
    }

    #kt_profile_overview_table th:first-child,
    #kt_profile_overview_table td:first-child {
        border-left: 1px solid #dee2e6;
    }

    #kt_profile_overview_table thead th {
        border-top: 1px solid #dee2e6;
        position: sticky;
        top: 0;
    }

    #kt_profile_overview_table tfoot tr td {
        border-top: 2px solid #2c3e50;
        border-bottom: 2px solid #2c3e50;
    }

    #kt_profile_overview_table tbody tr:hover {
        background-color: #e9ecef !important;
        transition: background-color 0.3s ease;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #kt_profile_overview_table,
        #kt_profile_overview_table * {
            visibility: visible;
        }
        #kt_profile_overview_table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 2px solid #2c3e50 !important;
        }
        #kt_profile_overview_table th,
        #kt_profile_overview_table td {
            border-color: #ddd !important;
        }
        #kt_profile_overview_table tfoot tr td {
            border-top: 2px solid #2c3e50 !important;
            border-bottom: 2px solid #2c3e50 !important;
        }
        .card-body, .table-responsive {
            overflow: visible;
        }
        .print-button {
            display: none;
        }
    }
</style>

<div class="card-body pt-0">
    <div class="table-responsive">
        <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed fw-bold">
            <thead class="fs-7" style="background-color: #2c3e50; color: #ffffff;">
            <tr>
                <th style="text-align-last: center">#</th>
                <th style="text-align-last: center">{{trans('company.company_name')}}</th>
                <th style="text-align-last: center">{{trans('company.test_code')}}</th>
                <th style="text-align-last: center">{{trans('company.test_name')}}</th>
                <th style="text-align-last: center">{{trans('company.inv_num')}}</th>
                <th style="text-align-last: center">{{trans('company.value')}}</th>
                <th style="text-align-last: center">{{trans('company.paid_date')}}</th>
                <th style="text-align-last: center">{{trans('company.payment_type')}}</th>
                <th style="text-align-last: center">{{trans('company.notes')}}</th>
            </tr>
            </thead>
            <tbody class="fs-6">
            @foreach($all_data as $record)
                <tr style="background-color: #f8f9fa;">
                    <td style="text-align-last: center">{{$loop->iteration}}</td>
                    <td style="text-align-last: center">{{optional($record->company)->name}}</td>
                    <td style="text-align-last: center">{{optional($record->client_test->test)->test_code_st}}</td>
                    <td style="text-align-last: center">{{optional($record->client_test)->test_name}}</td>
                    <td style="text-align-last: center">INV{{$record->num}}</td>
                    <td style="color: #27ae60; font-weight: bold; text-align-last: center">{{ number_format($record->value, 2) }}</td>
                    <td style="text-align-last: center">{{$record->paid_date}}</td>
                    <td style="text-align-last: center">{{$record->payment_type}}</td>
                    <td style="text-align-last: center">{{$record->notes}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr style="background-color: #34495e; color: #ffffff;">
                <td colspan="8" class="text-end fw-bold" style="border-left: 1px solid #dee2e6;">{{trans('payment.total_revenue')}}:</td>
                <td class="fw-bold" style="border-right: 1px solid #dee2e6;">{{ number_format($all_data->sum('value'), 2) }}</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-center mt-4">
        <a id="printButton" href="{{route('admin.print_Payments_received',[$company_id,$from_date,$to_date])}}" class="btn btn-primary print-button">
            <i class="fas fa-print"></i> {{trans('payment.print_report')}}
        </a>
    </div>
</div>
