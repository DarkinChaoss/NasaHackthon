<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPedido extends Controller
{
    public function indexView()
    {
        return view('pedido');
    }
}
