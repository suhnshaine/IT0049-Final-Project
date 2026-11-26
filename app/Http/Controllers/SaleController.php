<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with([
            'product',
            'customer',
            'staff'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.form', [
            'products' => Product::where('stock_quantity', '>', 0)
                ->orderBy('name')
                ->get(),

            'customers' => Customer::orderBy('full_name')
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'nullable|exists:customers,id',
            'quantity' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::findOrFail(
                $request->product_id
            );

            if ($request->quantity > $product->stock_quantity) {

                throw new \Exception(
                    'Insufficient stock. Available quantity: '
                    . $product->stock_quantity
                );
            }

            $product->decrement(
                'stock_quantity',
                $request->quantity
            );

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $request->customer_id,
                'sold_by' => auth()->id(),
                'quantity' => $request->quantity,
                'total_price' =>
                    $product->price * $request->quantity
            ]);
        });

        return redirect()
            ->route('sales.index')
            ->with('message', 'Sale recorded successfully.');
    }
}