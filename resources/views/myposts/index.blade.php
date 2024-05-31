
@extends('myposts.layout_index')
@section('total_Pro')

@endsection

@section('ProductCrud')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="Total">
                <h2>Total Products:{{$Total}}            
                </h2>
                            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('myposts.create') }}">Add</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif 
      
    <table class="table table-bordered">
           
            <tr>
            <th scope ="col">No</th>    
            <th scope ="col">Photos</th>            
            <th scope ="col" width="35%">Details</th>
            <th scope ="col">Contact</th>
            <th scope ="col" width="280px">Action</th>
            </tr>
                    
            @foreach ($realist as $pr)
            <!--$real is draw from the compact('real') in function index of ProductController
            Though $real is the join of two tables ->with two id colums, it can still work properly 
            when we, after foreach($real as $pr), call to $pr->id as in
            <a class="btn btn-info" href="{{ route('products.show',$pr->id) }}">Show</a> 
            (it will use the id of the estates table though)            
            in the form group Add, Edit, Delete below! And thus, we can draw data from two tables as well
            as perform CRUD accordingly. The relation of the two tables is as follows:
            $real = DB::table('declarers')
            ->join ('estates','declarers.id','estates.item_id')
            ->get(); -->                        
              

        <tr>
            <td>{{$pr->id}}</td> 
            <td>
            <?php                      
                               
                        $imgs = json_decode($pr->filename);
                        //print_r($imgs);
                
            ?>        
            <img src= "{{asset('/storage/photos/'.$imgs[0])}}"  title="image" class="img-thumbnail" width="300" height="300" 
                        onmouseover = "this.src='{{asset('/storage/photos/'.$imgs[1])}}'"title="image" class="img-thumbnail" width="300" height="300" 
                        onmouseout="this.src='{{asset('/storage/photos/'.$imgs[0])}}'"title="image" class="img-thumbnail" width="300" height="300" /> 
                                 
            </td>
            <td> 
                Realtype: {{$pr->realtype}}<br>
                Area: {{$pr->area}}<br>
                District: {{$pr->district}}<br>
                Address: {{$pr->address }}<br>
                Transaction: {{$pr->area}}<br>
                Price: {{$pr->price}}<br>
                Contact: {{$pr->contact_time}}<br>
                Description: {{$pr->description}}<br>
                        </td>
                        
                        
                        <td> {{$query->name}} <br>
                             {{$query-> phone}} <br>  
                             {{$pr->contact_time}} <br>  
                             {{$query-> email}}
                        </td>
                        
                    
                        <td>
            
            <form action="{{ route('myposts.destroy',$pr->id) }}" method="POST">
            {{ csrf_field() }}
   
            <a class="btn btn-info" href="{{ route('myposts.show',$pr->id) }}">Show</a>

            <a class="btn btn-primary" href="{{ route('myposts.edit',$pr->id) }}">Edit</a>
            <a class="btn btn-warning" href="{{ route('myposts.inactiv',$pr->id) }}">Deactivate</a>
            
   @csrf
   @method('DELETE')

   <button type="submit" class="btn btn-danger">Delete</button>
   </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $est->links() !!}
    @endsection
    