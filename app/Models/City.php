<?php

namespace App\Models;

use App\Models\Admin\ShippingAddress;
use App\Models\DataCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = ['city_name'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function dataCustomer()
    {
        return $this->hasMany(DataCustomer::class, 'city_id');
    }

    public function ShippingAddress()
    {
        return $this->hasMany(ShippingAddress::class, 'city_id');
    }
}
