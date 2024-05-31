
@extends('layouts.dashboardv')
@section('contentTotal')
{{$TotalPro}}
@endsection

@section('ProductCrud')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Danh muc</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}">Add</a>
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
            <th scope ="col">Contact</th>
            <th scope ="col">Details</th>
            <th scope ="col" width="280px">Action</th>
            </tr>
            
        
            @foreach ($estat as $pr)                        
              

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
            <td> District: {{$pr->district}}<br>
                             Address: {{$pr->address }}<br>
                             Description: {{$pr->description}} 
                        </td>
                        <td> {{$pr->cusname}} <br>
                             {{$pr-> phone}} <br>  
                             {{$pr->contact_time}} <br>  
                             {{$pr-> email}}
                        </td>
                        <td>
           <?php
            
            ?>
            <form action="{{ route('products.destroy',$pr->id) }}" method="POST">
            {{ csrf_field() }}
   
            <a class="btn btn-info" href="{{ route('products.show',$pr->id) }}">Show</a>

            <a class="btn btn-primary" href="{{ route('products.edit',$pr->id) }}">Edit</a>
            
   @csrf
   @method('DELETE')
   
   <button type="submit" class="btn btn-danger">Delete</button>
   
   </form>
  
            </td>
        </tr>
        @endforeach
    </table>
    {!! $estates->links() !!}
    @endsection
    