<div class="d-flex justify-content-between flex-column">
    <!--begin::Table-->

    <div class="col-md-12">
        <table class="table table-bordered hl white-border" style="table-layout: fixed;">
            <tbody>
            <tr>
                <th style="">{{trans('receipt_voucher.num')}} </th>
                <td style=""> {{$all_data->num}}</td>


                <th style=" ">{{trans('receipt_voucher.date_at')}}</th>
                <td style="">{{$all_data->date_at}}</td>
                <th style="">{{trans('receipt_voucher.create_by')}}</th>
                <td style="">{{$all_data->user->name}}</td>

            </tr>
            <tr>
                <th style=";">{{trans('receipt_voucher.type')}} </th>
                <td style=""> {{$all_data->type}}</td>

                <th style="">{{trans('receipt_voucher.notes')}}</th>
                <td colspan="3" style="">{{$all_data->notes}}</td>

            </tr>

            </tbody>
        </table>
    </div>

    <div class="table-responsive border-bottom mb-9 mt-20">
        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
            <thead>
            <tr class="border-bottom fs-6 fw-bold ">
                <th class="min-w-175px text-center pb-2">{{trans('receipt_voucher.account')}}</th>
                <th class="min-w-175px text-center pb-2">{{trans('receipt_voucher.type')}}</th>
                <th class="min-w-70px text-center pb-2">{{trans('receipt_voucher.amount')}}</th>
                <th class="min-w-80px text-center pb-2">{{trans('receipt_voucher.notes')}}</th>

            </tr>
            </thead>
            <tbody class="fw-semibold ">

            @foreach($all_data->lines as $item)
                <tr>

                    <td class="text-center"> {{optional($item->account)->name}}</td>

                        <?php $type_arr = ['creditor' => trans('receipt_voucher.Creditor'), 'debtor' => trans('receipt_voucher.Debtor')] ?>
                    <td class="text-center"> {{$type_arr[$item->type]}}</td>
                    <td class="text-center"> {{$item->amount}}</td>
                    <td class="text-center"> {{$item->notes}}</td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->
</div>
