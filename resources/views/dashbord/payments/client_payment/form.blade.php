<form method="post" action="{{ route('admin.employee_add_files',$all_data->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row col-md-12 ">

        <div class="col-md-4">
            <label class="required form-label">{{trans('dues.num')}}
            </label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="text"  name="num" class="form-control"  value="{{old('value',$num)}}" readonly/>
            </div>
            @error('num')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="required form-label">{{trans('dues.paid_date')}}
            </label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                <input type="date" name="paid_date" class="form-control"  value="{{old('paid_date',date('Y-m-d'))}}"/>
            </div>
            @error('paid_date')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="required form-label">{{trans('dues.value')}}
            </label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                <input type="number" step="any" name="value" class="form-control"  value="{{old('value')}}"/>
            </div>
            @error('value')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>




    </div>

</form>
