<?php

namespace App\Http\Controllers;
use PDF;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Exports\RecordsExport;

class RecordController extends Controller
{
    /**
     * Display a listing of the records with optional supplier filter.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    // Retrieve supplier and date filter values
    $supplierId = $request->query('supplier_id');
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    // Build the query with relationships
    $query = Record::with(['supplier', 'category', 'product']);

    // Apply supplier filter if provided
    if ($supplierId) {
        $query->where('supplier_id', $supplierId);
    }

    // Apply start date filter if provided
    if ($startDate) {
        $query->whereDate('created_at', '>=', $startDate);
    }

    // Apply end date filter if provided
    if ($endDate) {
        $query->whereDate('created_at', '<=', $endDate);
    }

    // Fetch the filtered records
    $records = $query->get();

    // Calculate the total quantity
    $totalQuantity = $records->sum('quantity');

    // Retrieve all suppliers for the filter dropdown
    $suppliers = Supplier::all();

    // Return the view with records, total quantity, and suppliers data
    return view('records.index', compact('records', 'totalQuantity', 'suppliers'));
}

    /**
     * Display a form for creating a new record.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve data needed for the form
        $suppliers = Supplier::all();
        $categories = Category::all();
        $products = Product::all();

        // Return the view with the data
        return view('records.create', compact('suppliers', 'categories', 'products'));
    }

    /**
     * Store a newly created record in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new record
        Record::create([
            'supplier_id' => $request->input('supplier_id'),
            'category_id' => $request->input('category_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        // Redirect to the records index page with a success message
        return redirect()->route('records.index')->with('success', 'Record created successfully.');
    }

    /**
     * Export records to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new RecordsExport, 'records.xlsx');
    }

    /**
     * Show the form for editing the specified record.
     *
     * @param \App\Models\Record $record
     * @return \Illuminate\View\View
     */
    public function edit(Record $record)
    {
        // Fetch related data to populate the form
        $suppliers = Supplier::all();
        $categories = Category::all();
        $products = Product::all();

        return view('records.edit', compact('record', 'suppliers', 'categories', 'products'));
    }

    /**
     * Update the specified record in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Record $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Record $record)
    {
        // Validate the request data
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the record
        $record->update([
            'supplier_id' => $request->input('supplier_id'),
            'category_id' => $request->input('category_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        // Redirect to the records index page with a success message
        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified record from storage.
     *
     * @param \App\Models\Record $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Record $record)
    {
        try {
            // Delete the record
            $record->delete();

            // Redirect to the records index page with a success message
            return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e->getMessage());

            // Redirect with an error message
            return redirect()->route('records.index')->withErrors('An error occurred while deleting the record.');
        }
    }

    /**
     * Display the specified record.
     *
     * @param \App\Models\Record $record
     * @return \Illuminate\View\View
     */
    public function show(Record $record)
    {
        // Return a view to display the record's details
        return view('records.show', compact('record'));
    }

    /**
 * Generate PDF for records with optional supplier and date filters.
 *
 * @return \Illuminate\Http\Response
 */
public function generatePdf(Request $request)
{
    // Fetch filtered records
    $query = Record::query();

    if ($request->supplier_id) {
        $query->where('supplier_id', $request->supplier_id);
    }

    if ($request->start_date) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->end_date) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $records = $query->get();

    // Load the records into the view for PDF generation
    $pdf = PDF::loadView('records.pdf', compact('records'));

    // Stream the PDF to the browser or force download
    return $pdf->download('records.pdf');
}

}
