<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class AdminMenuController extends Controller
{ 
		/*Redirect to admin Menu drag drop page*/
    public function index()
    {
         $menu_data=Category::with('subcat','subcat.subsubcat')->orderby('orders','asc')->get();
         return view('admin.menu.index',compact('menu_data'));
    	
    	//return view('admin.menu.index',compact('category'));
    }

    public function setMenu(Request $request)
    {
        //return $request->nestable_input;
        $arr=json_decode($request->nestable_input);
        $i=1;//cat order
       
        foreach ($arr as $main_cat ) { //category loop
            $temp_cat=explode("_", $main_cat->id);
            echo $cat_id=$temp_cat[1];
            $cat=Category::where('id',$cat_id)->update(['orders'=>$i]); 
            $i++;
        }
        return redirect('admin-menu');
    }   

    // public function setMenu(Request $request)
    // {
    //     $arr=json_decode($request->nestable_input);
    //     $i=1;//cat order
    //     $j=1;//Subcat order
    //     $k=1;//Subsbucat order
    //     foreach ($arr as $main_cat ) { //category loop
    //         $temp_cat=explode("_", $main_cat->id);
    //         $cat_id=$temp_cat[1];
    //         $cat_type=$temp_cat[0];
           
    //         if($cat_type=='cat')
    //         {
    //             //updating cat order
    //             $cat=Category::where('id',$cat_id)->update(['orders'=>$i]);  
    //         }
    //         elseif($cat_type=='subcat')
    //         {
    //             $old=SubCategory::where('id',$cat_id)->first(); //fetch old data
    //             $cat=new Category; //add in cat table
    //             $cat->name=$old->name;
    //             $cat->slug=$old->slug;
    //             $cat->orders=$i;
    //             $cat->save();
    //             SubCategory::where('id',$cat_id)->delete();//delete data from subcat table
    //             $cat_id=$cat->id; //new cat id
    //         }
    //         elseif($cat_type=='subsubcat')
    //         {
    //             $old=SubSubCategory::where('id',$cat_id)->first(); //fetch old data
    //             $cat=new Category; //add in cat table
    //             $cat->name=$old->name;
    //             $cat->slug=$old->slug;
    //             $cat->orders=$i;
    //             $cat->save();
    //             SubSubCategory::where('id',$cat_id)->delete();//delete data from subcat table
    //             $cat_id=$cat->id; //new cat id
    //         }
            

    //         if(isset($main_cat->children))
    //          {
    //             foreach($main_cat->children as $subcat){ //Sub category loop
    //                 print_r($subcat);
    //                  $temp_subcat=explode("_", $subcat->id);
    //                  $subcat_id=$temp_subcat[1];
    //                  $subcat_type=$temp_subcat[0];

    //                    if($subcat_type=='subcat')
    //                     {
    //                         //updating cat order
    //                         $cat=SubCategory::where('id',$subcat_id)->update(['orders'=>$i]);  
    //                     }
    //                     elseif($subcat_type=='cat')
    //                     {
    //                         $old=Category::where('id',$subcat_id)->first(); //fetch old data
    //                         $subcat=new SubCategory; //add in subcat table
    //                         $subcat->parent_id=$cat_id;
    //                         $subcat->name=$old->name;
    //                         $subcat->slug=$old->slug;
    //                         $subcat->orders=$j;
    //                         $subcat->save();
                            
    //                         Category::where('id',$subcat_id)->delete();//delete data from subcat table
    //                         $subcat_id=$subcat->id; //new subcat id
    //                     }
    //                     elseif($subcat_type=='subsubcat')
    //                     {
    //                         $old=SubSubCategory::where('id',$subcat_id)->first(); //fetch old data
    //                         $subcat=new SubCategory; //add in subcat table
    //                         $subcat->parent_id=$cat_id;
    //                         $subcat->name=$old->name;
    //                         $subcat->slug=$old->slug;
    //                         $subcat->orders=$j;
    //                         $subcat->save();
                            
    //                         SubSubCategory::where('id',$subcat_id)->delete();//delete data from subcat table
    //                         $subcat_id=$subcat->id; //new subcat id
    //                     }






    //                 if(isset($subcat->children))
    //                 {
    //                  foreach($subcat->children as $subsubcat){ //subsubcat loop
    //                      $temp_subsubcat=explode("_", $subsubcat->id);
    //                      $subsubcat_id=$temp_subsubcat[1];
    //                      $subsubcat_type=$temp_subsubcat[0];


    //                     if($subsubcat_type=='subsubcat')
    //                     {
    //                         //updating cat order
    //                         $cat=SubSubCategory::where('id',$subsubcat_id)->update(['orders'=>$k]);  
    //                     }
    //                     elseif($subsubcat_type=='cat')
    //                     {
    //                         $old=Category::where('id',$subsubcat_id)->first(); //fetch old data
    //                         $subsubcat=new SubSubCategory; //add in subcat table
    //                         $subsubcat->parent_id=$subcat_id;
    //                         $subsubcat->name=$old->name;
    //                         $subsubcat->slug=$old->slug;
    //                         $subsubcat->orders=$k;
    //                         $subsubcat->save();
                            
    //                         Category::where('id',$subsubcat_id)->delete();//delete data from subcat table
                           
    //                     }
    //                     elseif($subsubcat_type=='subcat')
    //                     {
    //                         $old=SubCategory::where('id',$subsubcat_id)->first(); //fetch old data
    //                         $subsubcat=new SubSubCategory; //add in subcat table
    //                         $subsubcat->parent_id=$subcat_id;
    //                         $subsubcat->name=$old->name;
    //                         $subsubcat->slug=$old->slug;
    //                         $subsubcat->orders=$k;
    //                         $subsubcat->save();
                            
    //                         SubCategory::where('id',$subsubcat_id)->delete();//delete data from subcat table
                          
    //                     }


                        
    //                      $k++;
    //                   }
    //                 }
    //                  $j++;
    //               }
    //           }
    //         $i++;
    //     }

    //     return redirect('admin-menu');
    // }
    

}
