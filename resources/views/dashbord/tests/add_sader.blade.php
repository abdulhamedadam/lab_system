@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.tests'), 'link' => ''],
                  ['label' => trans('tests.tests_table'), 'link' => '']
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.add_sader','admin.test.index',' ')
            @endphp


            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Test Code</th>
                        <th>Test Title</th>
                        <th>Sader Number</th>
                        <th>Sader Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_data as $item)
                        <tr>
                            <td>{{ $item->test_code_st }}</td>
                            <td>{{ $item->talab_title }}</td>
                            <td>
                                <input type="text" class="form-control sader_number" data-id="{{ $item->id }}" placeholder="Enter Sader Number">
                            </td>
                            <td>
                                <input type="date" class="form-control sader_date" data-id="{{ $item->id }}">
                            </td>
                            <td>
                                <button class="btn btn-primary save-btn" data-id="{{ $item->id }}">Save</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>


@stop
@section('js')

  <script>
      $(document).on('click', '.save-btn', function() {
          let id = $(this).data('id');
          let saderNumber = $('.sader_number[data-id="'+id+'"]').val();
          let saderDate = $('.sader_date[data-id="'+id+'"]').val();

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
              success: function(response) {
                  if (response.success) {
                      alert('Saved successfully!');
                      location.reload();
                  } else {
                      alert('Failed to save.');
                  }
              },
              error: function(xhr) {
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

