<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductWeight;
use App\Models\Category;

class ProductsController extends Controller
{
    public function index(Request $request){

        $products = Product::paginate(3);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.partials.products', compact('products'))->render(),
                'html2' => view('frontend.partials.products_list', compact('products'))->render(),
                'pagination_links' => $products->links()->render(),
                'product_ids' => $products->pluck('id')->toArray(),
            ]);
        }

        return view('frontend.pages.products',compact('products'));
    }


    public function view($id){


        $product = Product::find($id);

        return view('frontend.pages.product_details',compact('product'));
    }

    public function get_availability($id){

        $availability = ProductWeight::find($id);

        return response()->json($availability);
    }

    public function category_products($id){

        $category = Category::find($id);

        $products = Product::where('category_id',$id)->paginate(3);


        return view('frontend.pages.category_products',compact('category','products'));
    }


    public function products_sort(Request $request)
    {
        // Validate the input to ensure it contains valid JSON and a sorting option
        $request->validate([
            'products' => 'required|json',
            'sort_option' => 'nullable|string|in:high_price,low_price,nothing',
        ]);

        // Decode the product IDs
        $productIds = json_decode($request->input('products'));

        // Ensure $productIds is an array
        if (!is_array($productIds) || empty($productIds)) {
            return response()->json([
                'error' => 'Invalid product IDs',
            ], 400);
        }

        // Get the selected sorting option (default to 'nothing')
        $sortBy = $request->input('sort_option', 'nothing');

        // Start the query to fetch the products based on the selected IDs
        $query = Product::whereIn('id', $productIds);

        // Apply sorting based on the selected option
        if ($sortBy === 'high_price') {
            $query->orderByDesc('price');
        } elseif ($sortBy === 'low_price') {
            $query->orderBy('price');
        }

        // Retrieve all products without pagination
        $products = $query->get();

        // Render the views
        $html = view('frontend.partials.products', compact('products'))->render();
        $html2 = view('frontend.partials.products_list', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'html2' => $html2,
        ]);
    }



    public function product_price_filter(Request $request)
    {
        // Retrieve filter parameters with defaults
        $minPrice = $request->query('min_price', 0); // Minimum price filter
        $maxPrice = $request->query('max_price', 4000); // Maximum price filter

        // Fetch products filtered by price range
        $products_by_price = Product::whereBetween('price', [$minPrice, $maxPrice])
                                    ->paginate(3); // Paginate the results

        // Append current query parameters to pagination links
        $products_by_price->appends($request->query());

        // Render product HTML views for both grid and list views
        $html = view('frontend.partials.products_by_price', compact('products_by_price'))->render();
        $html2 = view('frontend.partials.products_by_price_list', compact('products_by_price'))->render();

        // Generate pagination links with appended query parameters
        $pagination_links = $products_by_price->links()->render();

        // Return a JSON response with all necessary data
        return response()->json([
            'html' => $html,                              // HTML for the grid view
            'html2' => $html2,                            // HTML for the list view
            'product_ids' => $products_by_price->pluck('id')->toArray(), // Filtered product IDs
            'price_pagination_links' => $pagination_links, // Pagination links for price filter
            'minPrice' => $minPrice,                      // Minimum price value
            'maxPrice' => $maxPrice,                      // Maximum price value
        ]);
    }
    





}
