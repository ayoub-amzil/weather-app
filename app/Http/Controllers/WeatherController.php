<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Models\WeatherHourly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class WeatherController extends Controller
{

    public function index(){
        // i used paginte() method instead of all() to show/read from the db 
        $weather_hourly_data = WeatherHourly::paginate(100); // 100 per page
        return view('pages/index', ['weather_hourly_data' => $weather_hourly_data]);
    }// end index()


    public function gWeatherData() // this method is used to fetch/save data, through web route and artisan command
    {
        // fetch Data from API
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [ // GET request to the Open Meteo API's /forecast endpoint
            'latitude' => '28.50', // param
            'longitude' => '-10.00', // param
            'hourly' => 'temperature_2m' // param
        ]);
        
        $data = $response->json(); // convert the JSON response data into a PHP array.

        if(Route::currentRouteName() === 'graph') { // this for fetching the data, call the graph but without saving the data. The graph is for live data
            return view('pages/graph', ['weatherData' => $data]);
        }

        $weatherData = new Weather();
                $weatherData->latitude = $data['latitude'];
                $weatherData->longitude = $data['longitude'];
                $weatherData->generationtime_ms = $data['generationtime_ms'];
                $weatherData->utc_offset_seconds = $data['utc_offset_seconds'];
                $weatherData->timezone = $data['timezone'];
                $weatherData->timezone_abbreviation = $data['timezone_abbreviation'];
                $weatherData->elevation = $data['elevation'];
                $weatherData->hourly_units_time = $data['hourly_units']['time'] ;
                $weatherData->hourly_units_temperature = $data['hourly_units']['temperature_2m'];
                $weatherData->save();

                foreach (range(0, count($data['hourly']['time'])-1) as $index) {
                    $weatherHourlyData = new WeatherHourly();
                    $weatherHourlyData->hourly_data_time = $data['hourly']['time'][$index];
                    $weatherHourlyData->hourly_data_temperature = $data['hourly']['temperature_2m'][$index];
                    $weatherHourlyData->weather_data_id = $weatherData->weather_data_id;
                    $weatherHourlyData->save();
                }
        return redirect()->back();
        
        // i am using (control structures) to limit some action 
        if(Route::currentRouteName() === 'graph') { // this for fetching the data, call the grapg view
            return view('pages/graph', ['weatherData' => $data]);
        }

    } //end gweatherdata()

    public function delete(Request $request)
    {
        // return the ids
        $ids = $request->input('weather_hourly_ids', []);

        // Delete all the WeatherHourly models with the given IDs
        WeatherHourly::whereIn('weather_hourly_id', $ids)->delete();

        // Redirect the user back to the original page with a success message
        return redirect()->back()->with('success', 'deleted successfully');

    } //end deletedata()

    public function find($id)
    {
        $data = WeatherHourly::find($id);
        return view('pages/update', ['data' => $data]);
    }

    public function update(Request $request, $weather_hourly_id)
    {
        $data = WeatherHourly::findOrFail($weather_hourly_id);

        $request->validate(['time' => 'required|date_format:Y-m-d\TH:i',
            'temp' => 'required|numeric|between:-99,99',
        ], [
            'temp.between' => 'The temperature must be between -99 and 99.',
        ]);

        $data->hourly_data_time = $request->input('time');
        $data->hourly_data_temperature = $request->input('temp');

        $data->save();
        return redirect()->route('index')->with('success-update', 'updated successfully!');
    }

}
