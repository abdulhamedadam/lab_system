

<div class="col-md-12">
    <div class="card" style="margin-top: 5px;margin-bottom:10px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11">
                    <a href="{{route('admin.samples_test',$all_data->id)}}" class="btn btn-success p-2">
                        <i class="bi bi-file-earmark-text"></i> {{ trans('tests.tests') }}
                    </a>

                    <a href="{{route('admin.test_dues',$all_data->id)}}" class="btn btn-info p-2">
                        <i class="bi bi-cash-stack"></i> {{ trans('tests.money_track') }}
                    </a>
                </div>

                <div class="col-md-1 text-end">
                    <a class="btn btn-warning" href="{{ route('admin.test.index') }}">
                        <i class="bi bi-arrow-left-circle fs-3"></i>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>


