<div class="row" style="margin-top: 10px">
    <div class="col-md-4">
        <label class="required form-label">{{trans('dues.payment_type')}}
        </label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
            <select class="form-select" name="payment_type" id="payment_type" required>
                @php
                    $payment_type=['cash'=>trans('dues.cash'),'bank'=>trans('dues.bank'),'check'=>trans('dues.check'),]
                @endphp
                @foreach($payment_type as $key=>$value)
                    <option value="{{$key}}" @if(old('payment_type')==$key) selected @endif >{{$value}}</option>
                @endforeach
            </select>
        </div>
        @error('remain')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="required form-label">{{trans('dues.receivable')}}
        </label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
            <select data-control="select2" class="form-control" name="received_by" id="received_by" required>
                <option value="0">select</option>
                @foreach($all_emps as $emp)
                    <option value="{{$emp->id}}"
                            @if(old('received_by')==$emp->id) selected @endif >{{$emp->first_name.' '.$emp->last_name}}</option>
                @endforeach
            </select>
        </div>
        @error('remain')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="required form-label">{{trans('dues.paid_date')}}
        </label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
            <input type="date" name="paid_date" class="form-control" value="{{old('paid_date',date('Y-m-d'))}}" required/>
        </div>
        @error('paid_date')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row col-md-12 " style="margin-top: 10px">
    <div class="col-md-12">
        <label class="required form-label">{{trans('dues.notes')}}
        </label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('notes') !!}</span>
            <textarea name="notes" class="form-control" value="{{old('notes')}}">

                </textarea>
        </div>
        @error('notes')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr style="margin-top: 30px; width: 100%; border: 2px solid #000000;">
@foreach($dues as $index => $due)
    <div class="row" style="margin-top: 10px">
        <input type="hidden" name="client_test_id[]" value="{{$due->id}}">
        <div class="col-md-3">
            <label class="required form-label">{{trans('dues.num')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="text" name="num[]" class="form-control" value="{{$invoice_num + $index}}" />
            </div>
        </div>

        <div class="col-md-3">
            <label class="required form-label">{{trans('dues.test_code')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="text" name="test_code[]" class="form-control"
                       value="{{get_app_config_data(in_array($due->test_type, ['soil', 'hasa']) ? 'soil_prefix' : optional($due->test)->test_type . '_prefix') . optional($due->test)->test_code}}"
                       readonly/>
            </div>
        </div>

        <div class="col-md-3">
            <label class="required form-label">{{trans('dues.value')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="number" step="any" name="value[]" class="form-control" value="{{$due->pay_now}}" />
            </div>
        </div>

        <div class="col-md-3">
            <label class="required form-label">{{trans('dues.remain')}}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="number" step="any" name="remain[]" class="form-control" value="{{$due->remain_after}}"
                       readonly/>
            </div>
        </div>
    </div>
@endforeach
