<style>
    #kt_profile_overview_table tbody tr:hover {
        background-color: #e9ecef !important;
        transition: background-color 0.3s ease;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #kt_profile_overview_table, #kt_profile_overview_table * {
            visibility: visible;
        }
        #kt_profile_overview_table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .card-body, .table-responsive {
            overflow: visible;
        }
        .print-button {
            display: none; /* Hide the print button when printing */
        }
    }
</style>

<div class="card-body pt-0">
    <div class="table-responsive">
        <table id="kt_profile_overview_table"
               class="table table-row-bordered table-row-dashed fw-bold">
            <thead class="fs-7" style="background-color: #2c3e50; color: #ffffff;">
            <tr>
                <th style="text-align-last: center">#</th>
                <th style="text-align-last: center">{{trans('payment.band')}}</th>
                <th style="text-align-last: center">{{trans('payment.sarf_date')}}</th>
                <th style="text-align-last: center">{{trans('payment.sarf_details')}}</th>
                <th style="text-align-last: center">{{trans('payment.created_at')}}</th>
                <th style="text-align-last: center">{{trans('payment.notes')}}</th>
                <th style="text-align-last: center">{{trans('payment.amount')}}</th>
            </tr>
            </thead>
            <tbody class="fs-6">
            @foreach($all_data as $record)
                <tr style="background-color: #f8f9fa;">
                    <td style="text-align-last: center">{{$loop->iteration}}</td>
                    <td style="text-align-last: center">{{optional($record->sarf_band)->title}}</td>
                    <td style="text-align-last: center">{{$record->sarf_date}}</td>
                    <td style="text-align-last: center">{{$record->sarf_details}}</td>
                    <td style="text-align-last: center">{{$record->created_at}}</td>
                    <td style="text-align-last: center">{{$record->notes}}</td>
                    <td style="color: #27ae60; font-weight: bold; text-align-last: center">{{ number_format($record->value, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr style="background-color: #34495e; color: #ffffff;">
                <td colspan="6" class="text-end fw-bold">{{trans('payment.total_revenue')}}:</td>
                <td class="fw-bold">{{ number_format($all_data->sum('value'), 2) }}</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-center mt-4">
        <a id="printButton" href="{{route('admin.payment.print_expense_report',[$band_id,$from_date,$to_date])}}" class="btn btn-primary print-button">
            <i class="fas fa-print"></i> {{trans('payment.print_report')}}
        </a>
    </div>
</div>

