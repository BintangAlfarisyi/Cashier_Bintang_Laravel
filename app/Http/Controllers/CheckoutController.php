<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $data['jenis'] = Jenis::with(['menu'])->get();

        return view('checkout.index')->with($data);
    }

    public function store()
    {
        $data['jenis'] = Jenis::with(['menu'])->get();

        return view('checkout.index')->with($data);
    }
}
