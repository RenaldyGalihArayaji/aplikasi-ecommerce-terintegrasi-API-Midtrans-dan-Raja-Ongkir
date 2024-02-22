<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class GetCityController extends Controller
{
    public function getCity(Request $request){
            $provinsi_id = $request->provinsi_id;
            $cities = City::where('province_id', $provinsi_id)->get();
            $options = '<option value="">Select a City</option>';
            echo $options;
            foreach ($cities as $city) {
                echo "<option value='$city->id'>$city->city_name</option>";
            }
        }
}
