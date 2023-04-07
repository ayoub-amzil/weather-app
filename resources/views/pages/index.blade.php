@extends('../app')
@push('css')
    <link rel="stylesheet" href={{asset('css/show.css')}}>
@endpush
@section('content')
  <div class="main-content">
    <div class="container mt-5">
      <!-- Table -->
        <div class="col">
        <form action="{{ route('delete-data') }}" method="POST">
        @csrf
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">
                {{-- home --}}
                <a class="btn border  btn-primary btn-sm btn-icon-only text-white" href="{{route('index')}}" role="button"><i class="fa-sharp fa-solid fa-home text-white"></i></a>
                {{-- get data button --}}
                <a class="btn border btn-sm btn-secondary btn-icon-only text-light" href="{{route('get-data')}}" role="button"><i class="fa-sharp fa-solid fa-download text-white"></i></a>
                {{-- get graph --}}
                <a class="btn border btn-sm btn-icon-only btn-dark text-white" href="{{route('graph')}}" role="button"><i class="fa-sharp fa-solid fa-chart-simple text-white"></i></a>
                {{-- delete --}}
                <button type="submit" class="btn btn-danger btn-sm btn-icon-only text-light" role="button"><i class="fa-solid text-white fa-trash"></i></button>
               @if(session('success'))
                  <div style="display:inline;" id="success-message" class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  <script>
                      setTimeout(function() {
                          document.getElementById('success-message').style.display = 'none';
                      }, 3000);
                  </script>
                @endif
@if(session('success-update'))
                  <div style="display:inline;" id="success-message" class="alert alert-success">
                      {{ session('success-update') }}
                  </div>
                  <script>
                      setTimeout(function() {
                          document.getElementById('success-message').style.display = 'none';
                      }, 3000);
                  </script>
                @endif
                </h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Temperature °C</th>
                    <th scope="col"></th>
                    {{-- checl all the button for deleting --}}
                    <th scope="col" class="text-align-left"><button id="deleting" type="button" class="btn btn-warning  text-dark" role="button "onclick="toggleCheckboxes()">check [F]</button></th>
                    <script>
                      var isChecked = false;
                      function toggleCheckboxes() {
                          var checkboxes = document.getElementsByName('weather_hourly_ids[]');
                          isChecked = !isChecked; // switch the state
                          for (var i = 0; i < checkboxes.length; i++) {
                              checkboxes[i].checked = isChecked;
                          }
                          var buttonText = isChecked ? 'check [T]' : 'check [F]'; // update the button text
                          document.getElementById('deleting').textContent = buttonText;
                      }
                    </script>
                  </tr>
                </thead>
                <tbody>
                {{-- retrive the data --}}
                @foreach ( $weather_hourly_data as $hdata ) 
                  <tr>
                    <td>{{$hdata->weather_hourly_id}}</td>
                    <td>
                      {{ $hdata->hourly_data_time }}
                    </td>
                    <td>
                        {{-- check the temp,if its <=> of 18 --}}
                        @if ($hdata->hourly_data_temperature<18)
                            <i class="fa-solid text-info fa-snowflake"></i> <span class="text-info">Cold</span>                         
                        @elseif ($hdata->hourly_data_temperature>=18 && $hdata->hourly_data_temperature<=21)
                            <i class="fa-solid text-success fa-cloud-sun"></i> <span class="text-success">Warm</span>
                        @else
                            <i class="fa-sharp text-warning fa-solid fa-sun"></i> <span class="text-warning">Hot</span>
                        @endif
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        {{$hdata->hourly_data_temperature}}
                      </div>
                    </td>
                    <td class="text-right">
                      {{-- update button --}}
                        <a class="edit btn btn-sm btn-icon-only text-light " id="{{$hdata->weather_hourly_id}}" href="{{ route('find-data', ['id' => $hdata->weather_hourly_id]) }}" role="button">
                            <i class="fa-sharp text-dark fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    {{-- checkbow for delete --}}
                    <td class="text-center">
                        <div class="d-flex align-items-center"><input name="weather_hourly_ids[]" class="form-check-input" value="{{$hdata->weather_hourly_id}}" type="checkbox" id="{{$hdata->weather_hourly_id}}" ></div>
                    </td>
                    </tr>
                  <tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                    {{-- pagination goes 100per page --}}
                    {{-- condition to check where the link is using  LengthAwarePaginator instance. Only shows if nessecary --}}
                    @if (!$weather_hourly_data->onFirstPage())
                        <li class="page-item">
                        <a class="page-link" href="{{ $weather_hourly_data->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"></i><span class="sr-only">Previous</span></a></li>
                    @endif
                    @if (!$weather_hourly_data->onLastPage())
                        <li class="page-item">
                        <a class="page-link" href="{{ $weather_hourly_data->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i><span class="sr-only">Next</span></a></li>
                    @endif

                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </form>
        </div>
      </div>

@endsection
