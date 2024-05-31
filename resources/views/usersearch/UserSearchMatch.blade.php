
@extends('layouts.uzersearch')

 @section('content')
     
    <h1>Search Results</h1>
        <div id="tableContainer">
            <div id="tableRow">
                <table>
                    <tr>
                        <th scope ="col">Photos</th>             
                        <th scope ="col">Details</th>
                        <th scope ="col">Contact</th>
                            <!DOCTYPE html>
                            <!-- The scope attribute specifies the association of table cells and table row or column
                            headers. It is used to indicate whether a table cell is a header for a column (scope="col")
                            or row (scope="row"). -->
                            </html>
                    </tr>

                    
@foreach ($real as $pr)        

                    <tr>     
                        <td> 
                         <?php
                        //$real ở trên nằm trong app/Http/Controllers/EstateController.php
                               
                        $imgs = json_decode($pr->filename);
                        //print_r($imgs);
                
                         ?>
                        <img src="{{asset('/storage/photos/'.$imgs[0])}}"  title="image" class="img-thumbnail" width="300" height="300" 
                        onmouseover = "this.src='{{asset('/storage/photos/'.$imgs[1])}}'"title="image" class="img-thumbnail" width="300" height="300" 
                        onmouseout="this.src='{{asset('/storage/photos/'.$imgs[0])}}'"title="image" class="img-thumbnail" width="300" height="300" />
                                               
                                <?php
                                /* phương án display cùng lúc tất cả hình của từng cell                                                      
                                @foreach ($imgs as $imag)
                                <img src= "{{asset('/storage/photos/'.$imag)}}"  title="image" width="300" height="300"/>
                                 @ */
                                ?> 
                    
                        </td>
            

                        <td> District: {{$pr->district}}<br>
                             Address: {{$pr->address }}<br>
                             Description: {{$pr->description}} 
                        </td>
                        <td> {{$pr->name}} <br>
                             {{$pr-> phone}} <br>  
                             {{$pr->contact_time}} <br>  
                             {{$pr-> email}}
                        </td>
                
                         @endforeach
           
                    </tr>
                </table>
            </div>
        </div>
           

 @endsection
 