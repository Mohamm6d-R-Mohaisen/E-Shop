<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        //
         $request= request();



           // return cokkection object //you can use as array
        $catogaries=Category::with('parent')
            ->withCount([
                'products'=>function($query){
                $query->where('status','=','active');
                }
            ])
//        leftjoin('catogaries as parents','parents.id','=','catogaries.parent_id')
//        ->select(
//            'catogaries.*',
//            'parents.name as parent_name'
//
//        )
            ->filters($request->query())
        ->paginate();

        return view('dashboard.catogaries.index',compact('catogaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents=Category::all();
        $catogary=new Category();
     return view('dashboard.catogaries.create',compact('parents','catogary'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

    // $request->validate(Catogary::rules());

        $request->merge(['slug'=>Str::slug($request->post('name'))]);

        $data=$request->except('image');
        if($request->hasFile('image')){
            $file=$request->file('image');

            $path= $file->store('uploads',[
                'disk'=>'public'
            ]);

            $data['image']=$path;

         }

        $catogary=Category::create( $data );

        //
        // $catogary=new Catogary($request->all());
        // $catogary->save();




    //PRG
    // return redirect()->route('catogaries.index');
    return Redirect::route('dashboard.catogaries.index')->with('success','the catogary is added');


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $catogary)
    {
return view('dashboard.catogaries.show',compact('catogary'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       $catogary= Category::findorfail($id);
       $parents=Category::where('id','<>',$id)

       ->where(function($query)use($id) {
       $query ->whereNull('parent_id')
        ->orwhere('parent_id','<>',$id);
       })->get();
    return view('dashboard.catogaries.edit',compact('catogary','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([Category::rules($id)]);

        $catogary=Category::find($id);
        $data=$request->except('image');
        $old_image = $catogary->image;

        if($request->hasFile('image')){
            $file=$request->file('image');
            $path= $file->store('uploads','public');
            $data['image']=$path;

         }

        $catogary->update( $data );
        if($old_image && isset($data['image'])){
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.catogaries.index')
        ->with('success','the catogary is updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Catogary::destroy($id);
        $catogary=Category::findOrfail($id);
        $catogary->delete();



        return Redirect::route('dashboard.catogaries.index')
        ->with('success','the catogary is deleted');
    }
    public function trash(){

        $catogaries=Category::onlyTrashed()->paginate();

        return view('dashboard.catogaries.trash',compact('catogaries'));

    }
    public function restore(Request $request,$id)
    {
        $catogaries=Category::onlyTrashed()->findOrFail($id);
        $catogaries->restore();
        return redirect()->route('dashboard.catogaries.trash')
        ->with('sucsess','the recored is restored');

    }
    public function forecdelete($id){
        $catogaries=Category::onlyTrashed()->findOrFail($id);
        $catogaries->forecDeleted();
        return redirect()->route('dashboard.catogaries.trash')
        ->with('sucsess','the recored is deleted for ever!');
        if($catogaries->image){
            Storage::disk('public')->delete($catogaries->image);
        }


    }
}
