<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getData(Request $request) {
        $request->validate([
            'start' => 'integer|min:0',
            'length' => 'integer|min:1|max:100',
        ]);

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $page = intval(floor($start / $length)) + 1;
        $products = \App\Models\Product::query();
        // Apply filters if provided
        if ($request->has('search') && $request->input('search')['value']) {
            $searchValue = $request->input('search')['value'];
            $products->where(function($query) use ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%')
                  ->orWhere('price', 'like', '%' . $searchValue . '%');
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
                    // Only allow ordering by known columns
                    if (in_array($columnName, ['id', 'name', 'price', 'stock', 'is_active'])) {
                        $products->orderBy($columnName, $dir);
                    }
                }
            }
        }

        $products = $products->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $products->total(),
            'recordsFiltered' => $products->total(),
            'data' => $products->items(),
        ])->setStatusCode(200, 'Products retrieved successfully');
    }

    public function getDataAll(Request $request) {
        $products = \App\Models\Product::query()->where('is_active', 1);

        // Apply filters if provided
        if ($request->has('search') && $request->input('search')['value']) {
            $searchValue = $request->input('search')['value'];
            $products->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                      ->orWhere('price', 'like', '%' . $searchValue . '%');
            });
        }

        $products = $products->get();

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products->select('id', 'name', 'price'),
        ])->setStatusCode(200, 'Products retrieved');
    }

    public function read($id) {
        // Find the product by ID
        $product = \App\Models\Product::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $product,
        ])->setStatusCode(200, 'Product retrieved');
    }

    public function create(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Create a new product
        $product = \App\Models\Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'is_active' => $request->input('is_active', false) ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product,
        ])->setStatusCode(201, 'Product created');
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Find the product by ID
        $product = \App\Models\Product::findOrFail($id);
        // Update the product
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'is_active' => $request->input('is_active', false) ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product,
        ])->setStatusCode(200, 'Product updated');
    }

    public function delete($id) {
        // Find the product by ID
        $product = \App\Models\Product::findOrFail($id);

        $order = \App\Models\Order::where('product_id', $id)->first();
        
        if($order) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete product with existing orders',
            ])->setStatusCode(422, 'Product has orders');
        }

        // Delete the product
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ])->setStatusCode(200, 'Product deleted');
    }
}