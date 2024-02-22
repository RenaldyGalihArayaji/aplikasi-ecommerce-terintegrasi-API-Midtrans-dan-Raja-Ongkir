<?php

namespace App\Models;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataCustomer extends Model
{
    use HasFactory;

    protected $table = 'data_customers';
    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Relasi dengan tabel cities
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
