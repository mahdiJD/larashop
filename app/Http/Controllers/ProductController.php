<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProducRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct(protected $perPage = 5){
//        $this->middleware(['auth']);
//        $this->authorizeResource(blogs::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =
            Product::latest()
                ->paginate($this->perPage)
                -> WithQueryString();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return "<p>hi</p>";
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProducRequest $request)
    {
        $product = Product::create($data = $request->getData());
        $product->syncCategories($data['categorie']);
        return to_route('products.index')->with('message','products has been uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $relatedProducts = $product->relatedProducts();
        // $comments = $product->comments()->with('user')->approved()->latest()->get();
        return view('products.show' , compact('product',
        // 'comments',
        'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if(!Gate::allows('update-product', $product)){
            return back()->with('message','Access Denied!');
            // abort(403,'Access Denied!');
        }
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($data = $request->getData());
        $product->syncTags($data['tags']);
        return to_route('products.index')->with('message','products has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);
        $product->delete();
        return to_route('products.index')->with('message','products has been deleted successfully!');

    }
}
