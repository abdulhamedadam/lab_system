<style>
    #kt_unpaid_dues_table tbody tr:hover {
        background-color: #e9ecef !important;
        transition: background-color 0.3s ease;
    }

    #kt_unpaid_dues_table {
        border-collapse: separate;
        border-spacing: 0;
    }

    #kt_unpaid_dues_table th,
    #kt_unpaid_dues_table td {
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    #kt_unpaid_dues_table th:first-child,
    #kt_unpaid_dues_table td:first-child {
        border-left: 1px solid #dee2e6;
    }

    #kt_unpaid_dues_table thead th {
        border-top: 1px solid #dee2e6;
        position: sticky;
        top: 0;
    }

    #kt_unpaid_dues_table tfoot tr:last-child td {
        border-bottom: 2px solid #2c3e50 !important;
    }

    #kt_unpaid_dues_table tfoot tr td {
        border-top: 2px solid #2c3e50;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #kt_unpaid_dues_table, #kt_unpaid_dues_table * {
            visibility: visible;
        }
        #kt_unpaid_dues_table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 2px solid #2c3e50 !important;
        }
        #kt_unpaid_dues_table th,
        #kt_unpaid_dues_table td {
            border-color: #ddd !important;
        }
        #kt_unpaid_dues_table tfoot tr td {
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
        <table id="kt_unpaid_dues_table" class="table table-row-bordered table-row-dashed fw-bold">
            <thead class="fs-7" style="background-color: #2c3e50; color: #ffffff;">
            <tr>
                <th style="text-align-last: center">#</th>
                <th style="text-align-last: center">{{trans('company.company_name')}}</th>
                <th style="text-align-last: center">{{trans('company.test_code')}}</th>
                <th style="text-align-last: center">{{trans('company.test_name')}}</th>
                <th style="text-align-last: center">{{trans('company.test_value')}}</th>
                <th style="text-align-last: center">{{trans('company.paid_amount')}}</th>
                <th style="text-align-last: center">{{trans('company.remaining_amount')}}</th>
                <th style="text-align-last: center">{{trans('company.wared_num')}}</th>
                <th style="text-align-last: center">{{trans('company.wared_date')}}</th>
                <th style="text-align-last: center">{{trans('company.sader_num')}}</th>
                <th style="text-align-last: center">{{trans('company.sader_date')}}</th>
            </tr>
            </thead>
            <tbody class="fs-6">
            @foreach($all_data as $record)
                @php
                    $paid_amount = optional($record->client_test_payment)->sum('value') ?? 0;
                    $remaining_amount = $record->test_value - $paid_amount;
                @endphp
                <tr style="background-color: #f8f9fa;">
                    <td style="text-align-last: center">{{$loop->iteration}}</td>
                    <td style="text-align-last: center">{{optional($record->company)->name}}</td>
                    <td style="text-align-last: center">{{optional($record->test)->test_code_st}}</td>
                    <td style="text-align-last: center">{{$record->test_name}}</td>
                    <td style="text-align-last: center">{{ number_format($record->test_value, 2) }}</td>
                    <td style="color: #27ae60; text-align-last: center">{{ number_format($paid_amount, 2) }}</td>
                    <td style="color: #e74c3c; font-weight: bold; text-align-last: center">{{ number_format($remaining_amount, 2) }}</td>
                    <td style="text-align-last: center">{{optional($record->test)->wared_number}}</td>
                    <td style="text-align-last: center">{{optional($record->test)->wared_date}}</td>
                    <td style="text-align-last: center">{{optional(optional($record->test)->sader)->num}}</td>
                    <td style="text-align-last: center">{{optional(optional($record->test)->sader)->date}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr style="background-color: #34495e; color: #ffffff;">
                <td colspan="4" class="text-end fw-bold" style="border-left: 1px solid #dee2e6;">{{trans('payment.total')}}:</td>
                <td class="fw-bold">{{ number_format($all_data->sum('test_value'), 2) }}</td>
                <td class="fw-bold" style="color: #27ae60">{{ number_format($all_data->sum(function($item) {
                    return optional($item->client_test_payment)->sum('value') ?? 0;
                }), 2) }}</td>
                <td class="fw-bold" style="color: #e74c3c">{{ number_format($all_data->sum('test_value') - $all_data->sum(function($item) {
                    return optional($item->client_test_payment)->sum('value') ?? 0;
                }), 2) }}</td>
                <td colspan="4" style="border-right: 1px solid #dee2e6;"></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-center mt-4">
        <a id="printButton" href="{{route('admin.print_unpaid_dues',[$company_id,$from_date,$to_date])}}" class="btn btn-primary print-button">
            <i class="fas fa-print"></i> {{trans('payment.print_report')}}
        </a>
    </div>
</div>
