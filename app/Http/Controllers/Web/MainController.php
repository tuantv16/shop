<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct() {

    }

    public function index(Request $request) {
        $master = 'TRAN TUAN008';
        // return view('main', [
        //     'master' => $master
        // ]);

        return view('layout.web', [
            'master' => $master
        ]);
    }

}
