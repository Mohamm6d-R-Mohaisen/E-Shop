<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products=Product::with(['categary','store'])->paginate();
        return view('dashboard.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $products=Product::findorfail($id);
        $categary=Category::all();
        $tags=implode(',', $products->tags()->pluck('name')->ToArray());

        return view('dashboard.products.edit',compact('products','categary','tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

     $product->update($request->except('tags'));
    //  $tags=explode(',',$request->post('tags'));
    $tags=json_decode($request->post('tags'));
     $tag_ids=[];
     $saved_tag=Tags::all();
     foreach ($tags as $item) {
         $slug=Str::slug($item->value);
         $tag=Tags::where('slug',$slug)->first();
         if(!$tag){
             $tag=Tags::create([
                 'name'=>$item->value,
                 'slug'=>$slug,
             ]);
         }
         $tag_ids[]=$tag->id;
     }
     $product->tags()->sync($tag_ids);
     return redirect()->route('dashboard.products.index')
         ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
