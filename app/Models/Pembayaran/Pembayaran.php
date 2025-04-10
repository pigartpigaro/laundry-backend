<?php

namespace App\Models\Pembayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rincians()
    {
        return $this->hasMany(Pembayaranrinci::class, 'kodebayar', 'kodebayar');
    }
}
