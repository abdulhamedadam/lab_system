@extends('dashbord.layouts.master')

@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
            $breadcrumbs = [
            ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
            ['label' => trans('Toolbar.tests'), 'link' => ''],
            ['label' => trans('tests.sader_data'), 'link' => '']
            ];

            PageTitle($title, $breadcrumbs);
        @endphp

        <div class="d-flex align-items-center gap-2 gap-lg-3">

            <div class="d-flex">
                <button type="button" class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
            <span class="svg-icon svg-icon-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                      transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                </svg>
            </span>
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{route('admin.save_sader')}}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <div class="mb-3">
                                    <label for="modalDate2" class="form-label">Date 2</label>
                                    <input type="date" class="form-control" id="modalDate2" name="date">
                                </div>
                                <div class="mb-3">
                                    <label for="modalNumber" class="form-label">Number</label>
                                    <input type="number" class="form-control" id="modalNumber" name="num">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="saveModalData">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.add_sader','admin.test.index',' ')
            @endphp


            <div class="card-body">
                <div class="row">
                    @foreach($saderData as $sader)
                        <div class="col-md-1 mb-4">
                            <div class="border text-center"
                                 style="width: 100px; height: 100px; @if($sader->test) background-color: lightgreen; @endif">
                                <p style="@if(!$sader->test) font-weight: bold; @endif">{{ $sader->num }}</p>
                                <p>{{ $sader->date }}</p>
                                @if($sader->test && $sader->test->test_sub_category =='soil')
                                    <a href="{{route('admin.samples_test',$sader->id)}}"><p>{{ optional($sader->test)->test_code_st }}</p></a>
                                @elseif($sader->test && $sader->test->test_sub_category =='hasa')
                                    <a href="{{route('admin.hasa_samples_test',$sader->id)}}"><p>{{ optional($sader->test)->test_code_st }}</p></a>
                                @else

                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>


@stop
@section('js')

    <script>
        $(document).on('click', '.save-btn', function () {
            let id = $(this).data('id');
            let saderNumber = $('.sader_number[data-id="' + id + '"]').val();
            let saderDate = $('.sader_date[data-id="' + id + '"]').val();

            if (saderNumber === '' || saderDate === '') {
                alert('Please fill all fields.');
                return;
            }

            $.ajax({
                url: "{{ route('admin.save_sader') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    sader_number: saderNumber,
                    sader_date: saderDate
                },
                success: function (response) {
                    if (response.success) {
                        alert('Saved successfully!');
                        location.reload();
                    } else {
                        alert('Failed to save.');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        alert('Sader Number must be unique for this year.');
                    } else {
                        alert('Something went wrong!');
                    }
                }
            });
        });
    </script>




@endsection
