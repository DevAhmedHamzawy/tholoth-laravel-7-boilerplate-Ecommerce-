<?php

namespace App\Http\Controllers;

use App\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function store(Request $request)
    {
        $shippingAddress = auth()->user()->shippingAddresses()->create($request->all());
        return response()->json($shippingAddress);
    }
}
