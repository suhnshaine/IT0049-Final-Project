<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.form', [
            'title' => 'Add Customer',
            'customer' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|max:20'
        ]);

        Customer::create([
            'full_name' => trim($request->full_name),
            'email' => trim($request->email),
            'phone' => trim($request->phone)
        ]);

        return redirect()
            ->route('customers.index')
            ->with('message', 'Customer added successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', [
            'title' => 'Edit Customer',
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'full_name' => 'required|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|max:20'
        ]);

        $customer->update([
            'full_name' => trim($request->full_name),
            'email' => trim($request->email),
            'phone' => trim($request->phone)
        ]);

        return redirect()
            ->route('customers.index')
            ->with('message', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('message', 'Customer deleted successfully.');
    }
}