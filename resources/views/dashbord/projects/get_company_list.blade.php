<option value="">{{trans('select')}}</option>


@foreach($companies as $item)

    <option value="{{optional($item->company)->id}}">{{optional($item->company)->name}}</option>
@endforeach
