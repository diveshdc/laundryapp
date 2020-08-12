<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     abort_unless(\Gate::allows('category_access'), 403);
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         abort_unless(\Gate::allows('category_create'), 403);
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       abort_unless(\Gate::allows('category_create'), 403);

       $formInput=$request->except('image');
       $this->validate($request,[
        'name'=>'required',
        'description' => ['required',],
        'image'=>'image|mimes:png,jpg,jpeg|max:10000'
    ]);

       $image=$request->image;
       if($image){
         $image =$request->file('image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/category_images/';
                $image->move(public_path() .$imagePath ,$imageName);
                $formInput['image'] =  url('/').$imagePath.$imageName;
    }
        $category = Category::create($formInput);
        return redirect()->route('admin.category.index');

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        abort_unless(\Gate::allows('category_edit'), 403);
        $category = Category::find($id);

        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        abort_unless(\Gate::allows('category_edit'), 403);
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      abort_unless(\Gate::allows('category_edit'), 403);
        $formInput=$request->except('image');
        $image=$request->image;
        if($image){
                $image     = $request->file('image');
                $parts     = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/category_images/';
                $image->move(public_path() .$imagePath ,$imageName);
                $formInput['image'] =  url('/').$imagePath.$imageName;
        }
        $category->update($formInput);
        // $category->update($request->all());
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //    abort_unless(\Gate::allows('category_delete'), 403);
    //     $category = Category::find($id)->delete();
    //     return back();
    // }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

}
