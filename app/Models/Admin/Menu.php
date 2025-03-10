<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'admin_menus';
    protected $guarded = ['id'];
    public function subs()
    {
        return $this->hasMany(Submenu::class, 'menu_id');
    }
}
