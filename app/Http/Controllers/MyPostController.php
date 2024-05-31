<?php

namespace App\Http\Controllers;
use App\Estate;
use App\User;
use DB;
use Image;


use Illuminate\Http\Request;

class MyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //identify the id of the current login user 
        $current_user = auth()->user()->id;
         
        //fetch the products posted by the current user
        if($current_user)
            {
            //when learned well, consider improving this 
        $query = DB::table('users')->find($current_user);
        $realist = DB::table('estates')
        ->where('user_id','=',$current_user)
        ->get();
        /*dd($variable name) to see collection, just do that and have route return a blade 
        (in this example:  return view ('membersboard.index') ). 
        No need to write code to echo the dd in the blade
        */
                              
        //count the number of the user's posts            
        $Total= Estate::where('user_id',$current_user)->count();
        
        //paginate
        $est = Estate::latest()->paginate(5);
           
       return view ('myposts.index')
                ->with(compact('query','realist','Total','est'))
                ->with ('i', (request()->input('page', 1) - 1) * 5); }
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('myposts.supplyForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {   //dd($id) first to see whose id is return to infer logical steps
        $current_user = auth()->user()->id;
        $user = User::find($current_user);
        // enabling later access to properties of Estate such as filename 'coz can't pass Estate to function()
        $product = Estate::find($id);
    //dd($product->filename); để thấy tên file
        $filenam = json_decode ($product-> filename);//this is for product images
                            
        return view ('myposts.show',compact('user','product','filenam'));
    }
    /*
    !! Property[] not exist in collection instance
or ... of no-object may be because that controller can't access properties of model
, even when we pass model into  function.EX: model Estate public function show(Estate $product){
dd($product->id)} still return  null. 
 However, when we create controller, there is $id provided already like in show($id):
public function show($id).So,do dd($id)to see whose id is being returned, expectedly the id of the current item. 
Then we base on that as follows:
    { $product = Estate::find($id);
        dd($product->filename); allow us to access property filename.
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $current_user = auth()->user()->id;
        $uzer = User::find($current_user);
        // enabling later access to properties of Estate such as filename 'coz can't pass Estate to function()
        $product = Estate::find($id);
        //dd($product->filename); để thấy tên file
        $imgFilename = json_decode ($product-> filename);//this is for product images
        return view ('myposts.edit', compact('product','uzer','imgFilename'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //dd($id); to see whose id is returned
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
    public function destroy($id) //$id points to id in estates table
    {
        // enabling later access to properties of Estate such as filename 'coz can't pass Estate to function()
        $product = Estate::find($id);
        // accessin and decode filename
        $filenam = json_decode ($product-> filename);
        
                foreach($filenam as $file) 
                    {
                        if(file_exists(public_path().'/storage/photos/'.$file))
                            {
                                unlink (public_path().'/storage/photos/'.$file);
                                $product->delete();
                            }
                            else
                                {
                                    $product->delete();
                                }           
               
                return redirect()->route('myposts.index')
                                ->with('success','Product deleted successfully');
            
               
            }
        
        
    }
    public function inactiv($id)
    {   
        //dd($id) first to see whose id is return to infer logical steps
        $current_user = auth()->user()->id;
        $user = User::find($current_user);
        $product= Estate::find($id); //dòng này bỏ ra là không chạy nha
        if($product){
        $product->status ='0';
        $product->save();//bỏ dòng này ko chạy nha
        // add text to image
        $filenam = json_decode ($product-> filename);
        foreach($filenam as $file) 
            {
                $img = Image::make(public_path().'/storage/photos/'.$file);  
                $img->text('NOT AVAILABLE!',500,500);  
                $img->save(public_path().'/storage/photos/'.$file); 
            } 
        return redirect() ->route('myposts.index')
                          ->with('success','Product deactivated successfully');
        }
    }
}
