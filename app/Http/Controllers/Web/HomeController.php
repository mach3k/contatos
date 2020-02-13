<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller {

    public function index() {

        return view('welcome');
    }

    public function show($id) {
        return redirect()->route('pessoa.show', $id);
    }
}
