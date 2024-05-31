@extends('myposts.layout2')
@section('content')
 <!--$query,$filenam,$product hereinafter are compacted & passed 
 from the show method(function show) in ProductController --> 
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('myposts.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
        <div id="tableContainer">
            <div id="tableRow">
                <table>
                    <tr>            
                        <th scope ="row">Contact:</th>
                    </tr>
                            <td>
                                                       
                            <strong>Name:</strong> {{$user->name}}<br>
                            <strong>Contact time:</strong> {{$product->contact_time}}<br> 
                            <strong>Phone:</strong> {{$user->phone }}<br>
                            <strong>Email:</strong> {{$user->email}}<br>
                            <strong>Cus_ID:</strong> {{$user->id }}<br>

                                                    
                                          
                            
                            </td>
        <!--As we go to this view via the index view's link at btn "Show" which track $pr-id,
        $pr is in the foreach($real as $pr) the $real compacted in function index of ProductController.
        This blade is control by the function show of ProductController, so if we $pr->cusname here, 
        for example, it wouldn't work-->
                                               
                    <tr>     
                            <td> 
                            
    
                            @foreach($filenam as $file) 
                            <img src= "{{asset('/storage/photos/'.$file)}}"  title="image" class="img-thumbnail" width="300" height="300">
                            @endforeach
                            </td>
                    </tr>
        <?php
        /*$filename in the foreach loop here is from compact('filenam') in function show of ProductController
        where $filenam = json_decode ($product-> filename); By json_decode filename in the Productcontroller and
        then loop through it in the show view together with the link for Show in the index blade as follows(@***@) help 
        showing just the images corresponding with the id, and thus preventing dumping all database images on the 
        screen as it would in the index blade where we use foreach loop through $product right on the view blade
    
        @***@  <form action="{{ route('products.destroy',$pr->id) }}" method="POST">
            {{ csrf_field() }}   
            <a class="btn btn-info" href="{{ route('products.show',$pr->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('products.edit',$pr->id) }}">Edit</a>            
        @csrf
        @method('DELETE')
        */    
        ?>                      
                    <tr>            
                        <th scope ="row">Description:</th>
                    </tr>                      
                            <td>
                                <strong>Cus_ID:</strong> {{$product->user_id}}<br> 
                                <strong>Pro_ID:</strong> {{$product->id}}<br> 
                                <strong>Realtype:</strong> {{$product->realtype}}<br>
                                <strong>Area:</strong> {{$product->area}}<br>
                                <strong>District:</strong> {{$product->district}}<br>
                                <strong>Address:</strong> {{$product->address }}<br>
                                <strong>Transaction:</strong> {{$product->transaction}}<br>
                                <strong>Price:</strong> {{$product->price}}<br>
                                <strong>Contact:</strong> {{$product->contact_time}}<br>
                                <strong>Description:</strong> {{$product->description}}<br>
                                
                            </td>
                            
                    </tr>       

   
                </table>
            </div>
        </div>
    
@endsection
