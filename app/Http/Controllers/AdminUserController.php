<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    function list()
    {
        return view('admin.user.list');
    }
}
