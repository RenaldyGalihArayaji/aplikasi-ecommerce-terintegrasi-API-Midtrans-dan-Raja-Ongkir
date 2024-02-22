<?php

namespace App\Models\Admin;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $table ='shipping_address';
    protected $fillable = [
        'province_id',
        'city_id',
        'address',
    ];

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
