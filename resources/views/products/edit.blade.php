@extends('products.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('products.update',$product->id) }}" method="POST"enctype = "multipart/form-data"> <?php //quan trọng: quên mulipart/form-data ở đây nó ko upload đâu nha ?>
        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            
            <label for = "image"> <strong> Photo: <strong></label>
				<input type = "file" name = "image[]" id = "image" multiple > <br>
                <tr>  
                
                @foreach($imgFilename as $file) 
                    <img src= "{{asset('/storage/photos/'.$file)}}"  title="image" class="img-thumbnail" width="300" height="300">
                @endforeach
             
            
				<!-- dòng giới hạn filesize nhất định phải nằm ở giữa nhãn và input type của file hình, nếu không nó sẽ không work -->
                
                </tr>
                </div>
        </div>
    </div>
   
    <label for="realtype">Real estate type: </label>
							<input type="text" id="realtype" name="realtype" value="{{$product->realtype}}"/>
							<br>
						<label for="area"> Area (m2)</label>
							<input type="number" id="area" name="area" value="{{$product->area}}"/>
							<br>
						<label for="district"> Which district is the real estate located?</label>
							<input type="text" id="district" name="district" value="{{$product->district}}"/>
							<br>
						<label for="address">On which road?</label>
							<input type="text" id="address" name="address" value="{{$product->address}}"/>
							<br>
						<label for = "transaction"> Transaction type: </label>
							<select name ="transaction" id="transaction" name= "transaction" value="<?php if(empty($purpose)) echo 'Xin vui lòng chọn loại giao dịch'; ?>"><br>
								<option value = "sell" >  Sale </option> <br>
								<option value = "lease" > Lease </option> <br>
								<option value = "sublet" > Sublet</option> <br>
							</select><br>
						<label for="price"> Price:</label>
							<input type="text" id="price" name="price" value="{{$product->price}}"><br>
						<label for = "contact_time"> Preferred contact time:</label>
							<input type ="contact_time" id="contact_time" name="contact_time" value="{{$product->contact_time}}"><br>
						<label for="description"> Description </label>
<textarea id ="description" name="description" type="description" style="margin: 0px; width: 992px; height: 130px;" placeholder="Detail">{{$product->description}} </textarea><br\>
					<p class ="submit">
					<input type="submit" value="Upload" name="submit">
					</p>
				</form>
@endsection