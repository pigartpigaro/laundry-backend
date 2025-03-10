<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function rincians()
    {
        return  $this->hasMany(Transaksirinci::class, 'no_nota', 'no_nota');
    }
}
