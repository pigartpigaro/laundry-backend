<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function list()
    {
        $data = Menu::with('subs')->oldest('urutan')->get();

        return new JsonResponse($data);
    }
}
