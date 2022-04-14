<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock()
    {
        $stock = Stock::join('products', 'stocks.product_id', 'products.id')
        ->get();
        return view('inventory.stock',[
            'stocks'  => $stock
        ]
    );
    }
}
