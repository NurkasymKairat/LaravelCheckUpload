<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $checks = DB::table('checks')
            ->join('users', 'checks.user_id', '=', 'users.id')
            ->select('checks.*', 'users.name as user_name')
            ->paginate(8);

        $checks->withPath(route('index'));

        return view('index', compact('checks'));
    }

    public function register_page()
    {
        return view('register');
    }

    public function login_page()
    {
        return view('login');
    }

}
