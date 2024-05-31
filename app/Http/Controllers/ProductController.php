<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estate;
use App\User;
use DB;

class ProductController extends Controller
{
  
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         $real = DB::table('users')
        ->join ('estates','users.id','estates.user_id')
        ->get();
       $TotalPro= Estate::count();
       $estates = Estate::latest()->paginate(5);
           
       return view ('products.index')
                ->with(compact('real','TotalPro','estates'))
                ->with ('i', (request()->input('page', 1) - 1) * 5);   
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.supplyForm');
        /*this form already has route for storing data,
        This make it superfluous to add cod for the store 
        method below
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Estate $product,User $decr)    { 
        /*the two tables users & estates connected via id
        the Show button on index.blade, however take the estates id
        (in its link:... $pr->id. Therefore, for the show blade to display 
        corresponding info from declarers table, the following logic applied)
        */
        //filter array of users, => one specific post
        //dd($var = $product->id);
        $a= $decr->id;
        $b = $product->user_id;                                   
        if($a=$b){
             $query= DB::table('users')->find($a);           
        }
        $filenam = json_decode ($product-> filename);//this is for product images
                            
        return view ('products.show',compact('product','filenam','query'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $product, User $decr)
    {   //this is just to view the edit form, the action is update, as per stated in the form
        $imgFilename = json_decode ($product-> filename);//this is for product images
        return view('products.edit',compact('product','decr','imgFilename'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { //dd($id); to see whose id is returned
        $request->validate([
            'image' => 'nullable',
            'image.*' =>'mimes:pdf,jpg,png,jpeg,gif,pjpeg,mp4',
            'realtype'=>'required',
            'area' =>'required',
            'district' =>'required',
            'address' =>'required',
            'transaction' =>'required',
            'price' =>'required',
            'contact_time' =>'required',                                  
            'description' =>'required',

        ]);
        
         $product= Estate::find($id); //dòng này bỏ ra là không chạy nha
         if($request->hasFile('image')) //if new file added
         {   // delete the old photo in public/storage/photos
           $fileOldName = json_decode ($product-> filename);
           foreach($fileOldName as $file) {
               if(file_exists(public_path().'/storage/photos/'.$file))
                   {
                        unlink (public_path().'/storage/photos/'.$file);
                       
                       }
                  }
                  //save the new file
           foreach($request->image as $file) 
           {   
               $Nowname = time().$file->getClientOriginalName().'.'.$file->extension();
               $file->move(public_path().'/storage/photos/', $Nowname); 
               $data[] = $Nowname;
               }
                $product->filename = json_encode($data); 
                
                $product->update($request->all());
           } else{                        
               $product->update($request->all());
           }
      

   return redirect()->route('myposts.index')
                   ->with('success','Product updated successfully');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
        public function destroy(Estate $product, User $decr)
        {
                       
         // enabling later access to properties of Estate such as filename 'coz can't pass Estate to function()
         //$product = Estate::find($id);
         // accessin and decode filename
         $filenam = json_decode ($product-> filename);
         
                 foreach($filenam as $file) 
                     {
                         if(file_exists(public_path().'/storage/photos/'.$file))
                             {
                                 unlink (public_path().'/storage/photos/'.$file);
                                }                          
                                
                                     $product->delete();
                                 }           
                
                 return redirect()->route('products.index')
                                 ->with('success','Product deleted successfully');
             
                
             }
         
         
     }
        
        /* This is a resource controller designated for products tab of dashboard
* it incorporate Estate and Declarer for the sake of product CRUD 
*/

