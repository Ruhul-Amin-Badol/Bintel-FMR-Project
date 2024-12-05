<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

class CategoryController extends Controller
{
   

    public function CategoryNew(){

       return view('dashboard.layouts.cat.new-cat');
    }

    public function CategoryNewAction(Request $request){

        $validated = $request->validate([
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories|regex:/^[a-zA-Z0-9]+$/u',
            'descriptions' => 'nullable',
            'image'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);

        $image_name="public/uploads/cat.png";

        if( isset($request['image']) ){

            $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
            $imageName = time().'.'.$request->image->extension();

            $request->image->move($path, $imageName);

            $image_name= $path.$imageName;
    
        }

        $credentials = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'descriptions' => $validated['descriptions'],
            'image' =>  $image_name,
            'created_by' => Auth::user()->id,
           
        ];

        Category::create($credentials);
        return back()->with('message', 'Category added Successfully!');




    }
    public function CategoryList(){

        $categories=Category::get();
        return view('dashboard.layouts.cat.cat-list')->with(compact('categories'));
    }

    public function CategoryDelete(Request $request){

        
        $id=decrypt($request->id);
    
        $cat=Category::find($id);
        
        if(isset($cat->id)){
            Category::find($cat->id)->delete();
            return back()->with('message', 'Category Deleted Successfully!');
        }
        else{
            return back()->withErrors(['msg' => 'Category Not Found']);
        }

    }

    public function CategoryDeleteAll(Request $request){

      $token=base64_decode($request->get("token"));

      $ids=json_decode($token);

      foreach($ids as $i){

        Category::find($i)->delete();

      }
      return back()->with('message', 'Successfully Deleted.');
    

    }

    public function CategoryUpdate(Request $request){

        $id=decrypt($request->id);
        $category=Category::find($id)->first();
        return view('dashboard.layouts.cat.update-cat')->with(compact('category'));

    }

    public function CategoryUpdateAction(Request $request){

        //dd($request->all());
        $id=$request->id;
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'slug' => 'required|regex:/^[a-zA-Z0-9]+$/u|unique:categories,slug,'.$id,
            'descriptions' => 'nullable',
            'image'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);


        $credentials = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'descriptions' => $validated['descriptions'],
            'updated_by' => Auth::user()->id,
        ];

        if( isset($request['image']) ){

            $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
            $imageName = time().'.'.$request->image->extension();

            $request->image->move($path, $imageName);

            $image_name= $path.$imageName;

            $credentials = [
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'descriptions' => $validated['descriptions'],
                'updated_by' => Auth::user()->id,
                'image'      => $image_name
            ];

    
        }
         Category::find($id)->update($credentials);
         return back()->with('message', 'Category Updated');



    }

     public function TagNew(){

        return view('dashboard.layouts.cat.new-tag');
     }

    public function TagNewAction(Request $request){

        $validated = $request->validate([
            'name' => 'required|unique:tags',
            'slug' => 'required|unique:tags|regex:/^[a-zA-Z0-9]+$/u',
            'descriptions' => 'nullable',
            'image'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);

        $image_name="public/uploads/cat.png";

        if( isset($request['image']) ){

            $path ="public/uploads/".date("Y")."/".date("m")."/".date("d")."/";
            $imageName = time().'.'.$request->image->extension();

            $request->image->move($path, $imageName);

            $image_name= $path.$imageName;
    
        }

        $credentials = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'descriptions' => $validated['descriptions'],
            'image' =>  $image_name,
            'created_by' => Auth::user()->id,
           
        ];

        Tag::create($credentials);
        return back()->with('message', 'Tag added Successfully!');




    }

    public function TagList(){

        $tag=Tag::get();
        return view('dashboard.layouts.cat.tag-list')->with(compact('tag'));
    }


    public function TagDeleteAll(Request $request){

        $token=base64_decode($request->get("token"));
  
        $ids=json_decode($token);
  
        foreach($ids as $i){
  
          Tag::find($i)->delete();
  
        }
        return back()->with('message', 'Successfully Deleted.');
      
  
      }

      public function TagDelete(Request $request){

        
        $id=decrypt($request->id);
    
        $cat=Tag::find($id);
        
        if(isset($cat->id)){
            Tag::find($cat->id)->delete();
            return back()->with('message', 'Tag Deleted Successfully!');
        }
        else{
            return back()->withErrors(['msg' => 'Tag Not Found']);
        }

    }

    public function TagUpdate(Request $request){

        $id=decrypt($request->id);
        $tag=Tag::find($id)->first();
        return view('dashboard.layouts.cat.update-tag')->with(compact('tag'));

    }



}
