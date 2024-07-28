<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\ProducRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct(protected $perPage = 15){
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
    public function create(User $user, Request $request,Product $product)
    {
        // if (Gate::denies('create-product')) {
        //     // $messeg =(string) auth()->user()->role;
        //     abort(403, 'no');
        // }
        $this->authorize('create-gate');

        // if(!(request()->user()->role == Role::admin || request()->user()->role == Role::root)){
        //     dd(request()->user()->role);
        //     abort(403 , 'no');
        // }
        // if($user->cannot('create'))
        //     abort(403 , 'no');
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProducRequest $request)
    {
        $this->authorize('create-gate');
        $product = Product::create($data = $request->getData());
        $product->syncCategories($data['categorie']);
        return to_route('products.index')->with('message','products has been uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $productInCart = Cart::where('user_id', auth()->id())
        //     ->where('product_id', $product->id)
        //     ->exists(); // change to return cart
        $item = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)->first();
        // dd($item);
        $relatedProducts = $product->relatedProducts();
        return view('products.show' , compact('product','item','relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // if (Gate::denies('update')) {
        //     abort(403, "Access denied");
        // }
        // if(!Gate::allows('update-product', $product)){
        //     return back()->with('message','Access Denied!');
        //     // abort(403,'Access Denied!');
        // }

        $this->authorize('delete-or-update-gate',$product);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProducRequest $request, Product $product)
    {
        // if (Gate::denies('update')) {
        //     abort(403, "Access denied");
        // }
        $this->authorize('delete-or-update-gate',$product);
        $product->update($data = $request->getData());
        $product->syncCategories($data['categorie']);
        return to_route('products.index')->with('message','products has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // if (Gate::denies('delete')) {
        //     abort(403, "Access denied");
        // }
        // $this->authorize('delete-or-update-gate',$product);
        Gate::authorize('delete', $product);
        $product->delete();
        return to_route('products.index')->with('message','products has been deleted successfully!');

    }
}
