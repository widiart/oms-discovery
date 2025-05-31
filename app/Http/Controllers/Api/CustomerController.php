<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getData(Request $request) {
        $request->validate([
            'start' => 'integer|min:0',
            'length' => 'integer|min:1|max:100',
        ]);

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $page = intval(floor($start / $length)) + 1;
        $customers = \App\Models\Customer::query();
        // Apply filters if provided
        if ($request->has('search') && $request->input('search')['value']) {
            $searchValue = $request->input('search')['value'];
            $customers->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                      ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }
        
        // Apply ordering if provided
        if ($request->has('order') && is_array($request->input('order'))) {
            $columns = $request->input('columns', []);
            foreach ($request->input('order') as $order) {
            $columnIdx = $order['column'] ?? null;
            $dir = $order['dir'] ?? 'asc';
            if ($columnIdx !== null && isset($columns[$columnIdx]['data'])) {
                $columnName = $columns[$columnIdx]['data'];
                // Only allow ordering by known customer columns
                if (in_array($columnName, ['id', 'name', 'email', 'phone'])) {
                    $customers->orderBy($columnName, $dir);
                }
            }
            }
        }

        $customers = $customers->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $customers->total(),
            'recordsFiltered' => $customers->total(),
            'data' => $customers->items(),
        ])->setStatusCode(200, 'Customers retrieved successfully');
    }

    public function getDataAll(Request $request) {
        $customers = \App\Models\Customer::query();

        // Apply filters if provided
        if ($request->has('search') && $request->input('search')['value']) {
            $searchValue = $request->input('search')['value'];
            $customers->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                      ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $customers = $customers->get();

        return response()->json([
            'success' => true,
            'message' => 'Customers retrieved successfully',
            'data' => $customers->select('id', 'name', 'email'),
        ])->setStatusCode(200, 'Customers retrieved');
    }

    public function read($id) {
        // Find the customer by ID
        $customer = \App\Models\Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Customer retrieved successfully',
            'data' => $customer,
        ])->setStatusCode(200, 'Customer retrieved');
    }

    public function create(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'nullable|string|max:20',
        ]);

        // Create a new customer
        $customer = \App\Models\Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'is_active' => $request->input('is_active', false) ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully',
            'data' => $customer,
        ])->setStatusCode(201, 'Customer created');
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        // Find the customer by ID
        $customer = \App\Models\Customer::findOrFail($id);
        // Update the customer
        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'is_active' => $request->input('is_active', false) ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully',
            'data' => $customer,
        ])->setStatusCode(200, 'Customer updated');
    }

    public function delete($id) {
        // Find the customer by ID
        $customer = \App\Models\Customer::findOrFail($id);

        // Delete the customer
        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully',
        ])->setStatusCode(200, 'Customer deleted');
    }
}