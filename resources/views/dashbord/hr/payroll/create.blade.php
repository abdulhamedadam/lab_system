<table class="table table-bordered" id="data" style="margin-top: 30px">
    <thead>
    <tr class="fw-semibold fs-6 text-gray-800">
        <th>{{trans('reports.Emp_ID')}}</th>
        <th>{{trans('reports.emp_code')}}</th>
        <th>{{trans('reports.emp_name')}}</th>
        <th>{{trans('reports.main_salary')}}</th>
        <th>{{trans('reports.bonus')}}</th>
        <th>{{trans('reports.deductions')}}</th>
        <th>{{trans('reports.loan')}}</th>
        <th>{{trans('reports.total')}}</th>

    </tr>
    </thead>
    <tbody>
    @php
        $total_bonus = 0;
        $total_deductions = 0;
        $total_loans = 0;
        $total_trainer_percentage = 0;
        $total_salaries = 0;
        $total_main_salary= 0 ;
    @endphp

    @foreach($all_data as $record)
        @php
            $bonus = $record->all_bonus->sum('value') ?? 0.00;
            $deductions = $record->all_deductions->sum('value') ?? 0.00;
            $loan = $record->all_loan->sum('value') ?? 0.00;
            $totalSalary = optional($record->employee_salary)->total_salary ?? 0 + $bonus - ($deductions + $loan);

            // Accumulate totals
            $total_main_salary +=optional($record->employee_salary)->total_salary ?? 0;
            $total_bonus += $bonus;
            $total_deductions += $deductions;
            $total_loans += $loan;
            $total_salaries += $totalSalary;
        @endphp

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $record->emp_code }}</td>
            <td>{{ $record->first_name .' '.$record->last_name}}</td>
            <td>{{ optional($record->employee_salary)->total_salary ?? 0 }}</td>
            <td>{{ $bonus }}</td>
            <td>{{ $deductions }}</td>
            <td>{{ $loan }}</td>
            <td>{{ $totalSalary }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot style="background-color: lightgreen">
    <tr style="">
        <td colspan="3"><strong>Total</strong></td>
        <td><strong>{{ $total_main_salary }}</strong></td>
        <td><strong>{{ $total_bonus }}</strong></td>
        <td><strong>{{ $total_deductions }}</strong></td>
        <td><strong>{{ $total_loans }}</strong></td>
        <td><strong>{{ $total_salaries }}</strong></td>
    </tr>
    </tfoot>

</table>

<div class="mt-4">
    <form action="{{route('admin.payroll.store')}}" method="POST">
        @csrf
        <input type="hidden" name="from_date" value="{{ $from_date }}">
        <input type="hidden" name="to_date" value="{{ $to_date }}">
        <input type="hidden" name="report_date" value="{{ now()->format('Y-m-d') }}">
        <input type="hidden" name="total_main_salary" value="{{ $total_main_salary }}">
        <input type="hidden" name="total_bonus" value="{{ $total_bonus }}">
        <input type="hidden" name="total_deductions" value="{{ $total_deductions }}">
        <input type="hidden" name="total_loans" value="{{ $total_loans }}">
        <input type="hidden" name="grand_total" value="{{ $total_salaries }}">

        <!-- Hidden fields for each employee's data -->
        @foreach($all_data as $record)
            @php
                $bonus = $record->all_bonus->sum('value') ?? 0.00;
                $deductions = $record->all_deductions->sum('value') ?? 0.00;
                $loan = $record->all_loan->sum('value') ?? 0.00;
                $totalSalary = $record->main_salary + $bonus - ($deductions + $loan) ;
            @endphp

            <input type="hidden" name="employees[{{ $record->id }}][emp_code]" value="{{ $record->emp_code }}">
            <input type="hidden" name="employees[{{ $record->id }}][emp_name]" value="{{ $record->name }}">
            <input type="hidden" name="employees[{{ $record->id }}][main_salary]" value="{{ optional($record->employee_salary)->total_salary ?? 0 }}">
            <input type="hidden" name="employees[{{ $record->id }}][bonus]" value="{{ $bonus }}">
            <input type="hidden" name="employees[{{ $record->id }}][deductions]" value="{{ $deductions }}">
            <input type="hidden" name="employees[{{ $record->id }}][loan]" value="{{ $loan }}">
            <input type="hidden" name="employees[{{ $record->id }}][total]" value="{{ $totalSalary }}">
        @endforeach

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i> {{ trans('reports.save_report') }}
        </button>
    </form>
</div>
<script>
    $('form').on('submit', function(e) {
        e.preventDefault();

        // Collect form data
        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('admin.payroll.store') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 400) {
                    // Date range already exists
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Other errors
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message || 'An unexpected error occurred',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
</script>
