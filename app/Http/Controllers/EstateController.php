<?php

namespace App\Http\Controllers;
use App\Estate;
use App\User;
use DB;
use Image;
use Illuminate\Http\Request;


class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      return view('products.SupplyForm');        
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { // get the logged in user
        $request->user();        
        // get the user's id
        $request->user()->id;
        $this->validate($request, [
            'image' => 'required',
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
            if($request->hasFile('image'))
                 {   foreach ($request->image as $file)
                        {   $Nowname = time().$file->getClientOriginalName().'.'.$file->extension();
                            $path ="storage/photos/";
                            $file->move(public_path().'/storage/photos/', $Nowname);
                            $imgResize = Image::make($path.$Nowname);
                            $imgResize->resize(600,600);
                            $imgResize->text('NEW PRODUCT!',500,500);/*,function($font) {  
                                $font->file(public_path('path/font.ttf'));  
                                $font->size(28);  
                                $font->color('#e1e1e1');  
                                $font->align('center');  
                                $font->valign('bottom');  
                                $font->angle(90);  
                            }); 
                            */   
                            $imgResize->save($path.$Nowname);

                            $data[] = $Nowname;
                                    }
                                        
                            $estate = Estate::create([
                                'user_id' =>$request->user()->id,
                                        /*this may return error 
                                        ErrorException: Trying to get property 'id' of non-object
                                        as in the config/auth.php,
                                        we set 'expire' => 60, and thus, if the user leave the page for
                                        over 60 minutes, it will report such error when the submit the form
                                        => solve this, hide the code as it return the code 
                                        &inform so that the user know to sign in again*/

                                'realtype'=> $request-> realtype,
                                'area'=> $request-> area,
                                'district' => $request-> district,
                                'address' => $request-> address,
                                'transaction' => $request-> transaction,
                                'price' => $request-> price,
                                'contact_time'=> $request-> contact_time,
                                'description' => $request-> description,
                                'filename'=> json_encode($data)
                                    ]);

                                if ($estate) {
                                    return back()->with('Data have been successfully added');// THIS COMFORMATION NOT YET DISPLAYED ON SCREEN

                                    }
                                    

    
                                }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        $real = DB::table('users')
                    ->join ('estates','users.id','estates.user_id')
                    ->where('status','=',1)                  
                    ->get();
              
        return view ('usersearch.UserSearchMatch', compact('real'));        
        
    }
//count Number of users
public function UserCount()
    {$TotalUser = DB::table('users')
    ->count();
    return view ('admin.dashboard', compact('TotalUser'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estate $estat)
        {
        }
}