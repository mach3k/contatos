<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller {
    
    public function testando(Request $request){
        dd($request);
    }
}
