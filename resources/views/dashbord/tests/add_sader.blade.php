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
                                    <input type="date" class="form-control" id="modalDate2" name="date"
                                           min="{{ date('Y-m-d', strtotime('-1 day')) }}"
                                           max="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ date('Y-m-d') }}">
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
                            <div class="border text-center sader-box"
                                 data-id="{{ $sader->id }}"
                                 data-num="{{ $sader->num }}"
                                 data-date="{{ $sader->date }}"
                                 style="cursor: pointer; width: 100px; height: 100px;
                                 @if($sader->test)
                                     background-color: lightgreen;
                                 @elseif($sader->date)
                                     background-color: lightgoldenrodyellow;
                                 @else
                                     background-color: lightcoral;
                                 @endif
                                     ">
                                <p style="@if(!$sader->test) font-weight: bold; @endif">{{ $sader->num }}</p>
                                <p>{{ $sader->date }}</p>
                                @if($sader->test && $sader->test->test_sub_category =='soil')
                                    <a href="{{route('admin.samples_test',$sader->id)}}"><p>{{ optional($sader->test)->test_code_st }}</p></a>
                                @elseif($sader->test && $sader->test->test_sub_category =='hasa')
                                    <a href="{{route('admin.hasa_samples_test',$sader->id)}}"><p>{{ optional($sader->test)->test_code_st }}</p></a>
                                @endif
                            </div>
                        </div>
                    @endforeach



                   <!-- <div class="d-flex">
                            <a   onclick="return confirm('هل أنت متأكد أنك تريد إضافة صادر جديد؟')" href="{{route('admin.add_new_sader')}}" class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4" >
            <span class="svg-icon svg-icon-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                      transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                </svg>
            </span>
                            </a>
                        </div>-->
                </div>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editSaderModal" tabindex="-1" aria-labelledby="editSaderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editSaderForm" method="POST" action="{{route('admin.update_sader')}}">
                @csrf
                <input type="hidden" name="id" id="saderId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل البيانات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="saderNum" class="form-label">رقم الصادر</label>
                            <input type="text" class="form-control" name="num" id="saderNum">
                        </div>
                        <div class="mb-3">
                            <label for="saderDate" class="form-label">تاريخ الصادر</label>
                            <input type="date" class="form-control" name="date" id="saderDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@section('js')


    <script>
        document.querySelectorAll('.sader-box').forEach(function(box) {
            box.addEventListener('click', function () {
                const id = this.dataset.id;
                const num = this.dataset.num;
                const date = this.dataset.date;

                document.getElementById('saderId').value = id;
                document.getElementById('saderNum').value = num;
                document.getElementById('saderDate').value = date;

                const modal = new bootstrap.Modal(document.getElementById('editSaderModal'));
                modal.show();
            });
        });
    </script>

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
