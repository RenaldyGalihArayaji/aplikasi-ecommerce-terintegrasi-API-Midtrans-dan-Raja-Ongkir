<?php

namespace App\Models;

use App\Models\DataCustomer;
use App\Models\Admin\ShippingAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';
    protected $fillable = ['province'];

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function dataCustomer()
    {
        return $this->hasMany(DataCustomer::class, 'province_id');
    }

    public function ShippingAddress()
    {
        return $this->hasMany(ShippingAddress::class, 'province_id');
    }
}
