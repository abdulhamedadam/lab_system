<option value="">{{trans('select')}}</option>


@foreach($projects as $item)

    <option value="{{$item->id}}">{{$item->project_name}}</option>
@endforeach
