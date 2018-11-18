<?php

namespace App\Http\Controllers\Admin\Menu;

use App\MenuCategory;
use App\MenuSubCategory;
use App\MenuTriSubCategory;
use App\MenuForthSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class MenuController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:admin');
    }

    public function menuCategory()
    {
        $categories = MenuCategory::all();
    	return view('admin.menu.category',compact('categories')); 
    }

    public function menuCategoryStore(Request $request)
    {
    	$category = new MenuCategory;
    	$category->category_name = $request->category;
    	$category->save();
    	return back()->with('success','Category Successfully Inserted'); 
    }

    public function menuCategoryEdit($id)
    {
        $category = MenuCategory::where('id', $id )->first();
        return view('admin.menu.edit_category',compact('category'));
    }

    public function menuCategoryUpdate(Request $request)
    {
        $MenuCategory = MenuCategory::find($request->id);
        $MenuCategory->category_name = $request->category;
        $MenuCategory->save();
        return redirect('admin/menu-category')->with('success','Category Successfully Updated'); 
    }

    public function menuCategoryDelete($id)
    {
        MenuCategory::find($id)->delete();
        MenuSubCategory::where('category_id',$id)->delete();
        MenuTriSubCategory::where('category_id',$id)->delete();
        MenuForthSubCategory::where('category_id',$id)->delete();
        return back()->with('success','Category Successfully Deleted');
    }
    public function menuSubCategory()
    {
        $subcategory = MenuSubCategory::all();
    	$categories = MenuCategory::all();
    	return view('admin.menu.sub_category',compact('categories','subcategory')); 
    }
     public function menuSubCategoryEdit($id,$cat_id)
    {
         $categories = MenuCategory::all();
         $sub_category = MenuSubCategory::where('id', $id )->first();
         return view('admin.menu.edit_sub_category',compact('categories','cat_id','sub_category','id'));
    }

    public function menuSubCategoryUpdate(Request $request)
    {

        $MenuSubCategory = MenuSubCategory::find($request->id);
        $MenuSubCategory->sub_category_name = $request->sub_category;
        $MenuSubCategory->category_id = $request->category_id;
        $MenuSubCategory->save();
        return redirect('admin/menu-sub-category')->with('success','Sub Category Successfully Updated'); 
    }

    public function menuSubCategoryDelete($id)
    {
        MenuSubCategory::find($id)->delete();
        MenuTriSubCategory::where('sub_category_id',$id)->delete();
        MenuForthSubCategory::where('sub_category_id',$id)->delete();
        return back()->with('success','Sub category Successfully Deleted');
    }



    public function menuSubCategoryStore(Request $request)
    {
    	$MenuSubCategory = new MenuSubCategory;
    	$MenuSubCategory->category_id =  $request->category;
    	$MenuSubCategory->sub_category_name =  $request->sub_category;
    	$MenuSubCategory->save();
    	return redirect('admin/menu-sub-category')->with('success','Sub category Successfully Updated'); 

    }














    public function menuTriSubCategory()
    {
        $MenuTriSubCategory = MenuTriSubCategory::all();

    	$categories = MenuCategory::all();
    	return view('admin.menu.tri_sub_category',compact('categories','MenuTriSubCategory')); 
    }

    public function menuTriSubCategoryEdit($tri,$sub,$cat)
    {
        $categories = MenuCategory::all();
        $tri_category = MenuTriSubCategory::where('id',$tri)->first();
        return view('admin.menu.edit_tri_sub_category',compact('categories','tri_category','cat','sub','tri'));
    }

    public function menuTriSubCategoryUpdate(Request $request)
    {

        $MenuTriSubCategory = MenuTriSubCategory::find($request->id);
        $MenuTriSubCategory->category_id = $request->category;
        $MenuTriSubCategory->sub_category_id = $request->sub_category;
        $MenuTriSubCategory->tri_sub_category_name = $request->tri_sub_category;
        $MenuTriSubCategory->save();
        return redirect('admin/menu-tri-sub-category')->with('success','Tri Sub Category Successfully Updated'); 
    }
    public function menuTriSubCategoryDelete($id)
    {

        MenuTriSubCategory::find($id)->delete();
        MenuForthSubCategory::where('tri_sub_category_id',$id)->delete();
        return back()->with('success','Tri Sub category Successfully Deleted');
    }



    public function getSubCategory(Request $request)
    {
    	
    	$sub_categorories = MenuSubCategory::where('category_id', $request->id )->get();
    	$item = '';
    	foreach ($sub_categorories  as  $sub_categorory) {
    		$item .='<option value="'.$sub_categorory->id.'">'.$sub_categorory->sub_category_name.'</option>';
    		
    	}
    	echo $item;

    	//return response()->json(['msg'=>$sub_category_id]);
    }
    public function menuTriSubCategoryStore(Request $request)
    {
        $MenuTriSubCategory  = new MenuTriSubCategory;
        $MenuTriSubCategory->category_id  = $request->category;
        $MenuTriSubCategory->sub_category_id  = $request->sub_category; 
        $MenuTriSubCategory->tri_sub_category_name  = $request->tri_sub_category;
        $MenuTriSubCategory->save();
        return back()->with('success','Tri Sub category Successfully Inserted'); 
    }
    public function menuForthSubCategory()
    {
        $MenuForthSubCategory = MenuForthSubCategory::all();
        $categories = MenuCategory::all();
        return view('admin.menu.forth_sub_category',compact('categories','MenuForthSubCategory'));
    }

    public function getTriSubCategory(Request $request)
    {
        
        $sub_categorories = MenuTriSubCategory::where('sub_category_id', $request->id )->get();
        $item = '';
        foreach ($sub_categorories  as  $sub_categorory) {
            $item .='<option value="'.$sub_categorory->id.'">'.$sub_categorory->tri_sub_category_name.'</option>';
            
        }
        echo $item;





        //return response()->json(['msg'=>$sub_category_id]);
    }

    public function menuForthSubCategoryStore(Request $request)
    {
        $MenuForthSubCategory  = new MenuForthSubCategory;
        $MenuForthSubCategory->category_id  = $request->category;
        $MenuForthSubCategory->sub_category_id  = $request->sub_category; 
        $MenuForthSubCategory->tri_sub_category_id  = $request->tri_sub_category;
        $MenuForthSubCategory->forth_sub_category_name  = $request->forth_sub_category;
        $MenuForthSubCategory->save();
        return back()->with('success','Forth Sub category Successfully Inserted'); 
    }

    public function menuForthSubCategoryDelete($id)
    {
        MenuForthSubCategory::find($id)->delete();
        return back()->with('success','Forth Sub category Successfully Deleted'); 
    }

    public function menuForthSubCategoryEdit($cat,$sub,$tri,$forth)
    {
        $categories = MenuCategory::all();
        $forth_category = MenuForthSubCategory::where('id',$forth)->first();

        return view('admin.menu.edit_forth_sub_category',compact('categories','forth_category','cat','sub','tri','forth'));

        
    }
    public function menuForthSubCategoryUpdate(Request $request)
    {
        
        $MenuForthSubCategory  = MenuForthSubCategory::find($request->id);
        $MenuForthSubCategory->category_id  = $request->category;
        $MenuForthSubCategory->sub_category_id  = $request->sub_category; 
        $MenuForthSubCategory->tri_sub_category_id  = $request->tri_sub_category;
        $MenuForthSubCategory->forth_sub_category_name  = $request->forth_sub_category;
        $MenuForthSubCategory->save();
         return redirect('admin/menu-forth-sub-category')->with('success','Forth Sub Category Successfully Updated'); 


    }


}

 