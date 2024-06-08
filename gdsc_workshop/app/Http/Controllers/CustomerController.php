<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer; // Import the Customer model

class CustomerController extends Controller
{
    //
    public function index()
{
    $customers = \App\Models\Customer::all();
    return view('customers.index', compact('customers'));
}

public function create()
{
    return view('customers.create');
}

// public function store (Request $request)
// {
// Customer::create($request->all());
// return redirect()->route('customers.index');

// }
public function store(Request $request)
{
    $customer = Customer::create($request->all());
    session()->flash('message', 'Customer created successfully.');

    return redirect()->route('customers.index')->with('customer', $customer);
}
public function show(string $id)
{
$customer = Customer::find($id);
return view('customers.show', compact('customer'));
}


public function edit(string $id)
{
$customer = Customer::find($id);
return view('customers.edit', compact('customer'));
}


public function update (Request $request, string $id)
{
$customer = Customer::find($id);
$customer->update($request->all());
return redirect()->route('customers.index');
}


public function destroy(string $id)
{
    $customer = Customer::find($id);
    $customer->delete();
    
    // Flash success message
    session()->flash('message', 'Customer deleted successfully.');

    return redirect()->route('customers.index');
}

}
