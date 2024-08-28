<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Supplier;



class SupplierController  extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */


     // Other methods (index, store, edit, update, destroy) go here

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('.suppliers.create');
    }

/**
     * Store a newly created category in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Supplier::create([
            'name' => $request->name,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

   
   
     /**
     * Display a listing of the suppliers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all suppliers from the database
        $suppliers = Supplier::all();

        // Pass the suppliers to the view
        return view('.suppliers.index', compact('suppliers'));
    }

    // Other methods (create, store, show, edit, update, destroy) go here

    // Other methods (create, store, edit, update, destroy) go here
    // Other methods (index, create, store, update, destroy) go here

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified Supplier in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $supplier->update([
            'name' => $request->name,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
        
    }

    // Other methods (index, create, store, edit, update) go here

    /**
     * Remove the specified Supplier from the database.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Category deleted successfully.');
    }
}
