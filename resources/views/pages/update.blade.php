@extends('../app')
@push('css')
    <link rel="stylesheet" href={{asset('css/show.css')}}>
@endpush
@section('content')
  <div class="main-content">
    <div class="container mt-5">
      <!-- Table -->
    <form method="POST" action="{{ route('update-data', ['id' => $data->weather_hourly_id]) }}">
    @csrf
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">
                {{-- home --}}
                <a class="btn border  btn-primary btn-sm btn-icon-only text-white" href="{{route('index')}}" role="button"><i class="fa-sharp fa-solid fa-home text-white"></i></a>
                {{-- update --}}
                <button type="submit" class="btn btn-success btn-sm btn-icon-only text-light" role="button"><i class="fa-solid text-white fa-trash"></i></button>
                @error('temp')
                    <div class="error_msg alert-danger text-red-500">{{ $message }}</div></script>
                @enderror
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
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$data->weather_hourly_id}}</td>
                    <td>
                        <input type="datetime-local" name="time" value="{{ $data->hourly_data_time }}">
                    </td>
                    <td>
                        {{-- check the temp,if its <=> of 18 --}}
                        @if ($data->hourly_data_temperature<18)
                            <i class="fa-solid text-info fa-snowflake"></i> <span class="text-info">Cold</span>                         
                        @elseif ($data->hourly_data_temperature>=18 && $data->hourly_data_temperature<=21)
                            <i class="fa-solid text-success fa-cloud-sun"></i> <span class="text-success">Warm</span>
                        @else
                            <i class="fa-sharp text-warning fa-solid fa-sun"></i> <span class="text-warning">Hot</span>
                        @endif
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <input min="-99" max="99" value="{{$data->hourly_data_temperature}}" type="number" name="temp">
                      </div>


                    </td>
                  <tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </form>
      </div>
  </div>
@endsection
