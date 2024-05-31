@extends('myposts.layout2')
@section('content')

	
		<h1> LET TENANTS KNOW ABOUT YOUR SERVICE</h1>
		<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('myposts.index') }}"> Back</a>
            </div>
<!-- nếu quên bật xampp lên thì có vẽ như cái trang này vẫn chạy nhưng report1.php không chạy, nhấn submit nó hiện luôn code của report1.php
 đầu trang php không thêm DOCTYPE html nó vẫn work bình thường-->
				<form action= "/UserUps" method = "POST" enctype = "multipart/form-data">
						@csrf				
						<label for = "image"> Photo: </label>
							<!--<input type= "hidden" name ="MAX_FILE_SIZE" value ="<?//= $max ?>"> -->
							<input type = "file" name = "image[]" id = "image" multiple> <br>
				<!-- dòng giới hạn filesize nhất định phải nằm ở giữa nhãn và input type của file hình, nếu không nó sẽ không work -->
						<label for="realtype">Real estate type: </label>
							<input type="text" id="realtype" name="realtype" placeholder="e.g warehouse, appartment,town house, villa"/>
							<br>
						<label for="area"> Area (m2)</label>
							<input type="number" id="area" name="area" placeholder="Enter the area (in m2)"/>
							<br>
						<label for="district"> Which district is the real estate located?</label>
							<input type="text" id="district" name="district" placeholder="Enter the district"/>
							<br>
						<label for="address">On which road?</label>
							<input type="text" id="address" name="address" placeholder="Enter the address"/>
							<br>
						<label for = "transaction"> Transaction type: </label>
							<select name ="transaction" id="transaction" name= "transaction" value="<?php if(empty($purpose)) echo 'Xin vui lòng chọn loại giao dịch'; ?>"><br>
								<option value = "sell" >  Sale </option> <br>
								<option value = "lease" > Lease </option> <br>
								<option value = "sublet" > Sublet</option> <br>
							</select><br>
							
						<label for="price"> Price:</label>
							<input type="text" id="price" name="price" placeholder="enter your expected price for the house or appartment"><br>
						<label for = "contact_time"> Preferred contact time:</label>
							<input type ="contact_time" id="contact_time" name="contact_time" placeholder= "When should tenant phone you? e.g. From 9 to 11 on Saturday"><br>
						<label for="description"> Description </label>
							<textarea id = "description" name="description" type="description" placeholder="Further description of the expected house/apartment that you want to stress" style="margin: 0px; width: 992px; height: 130px;"></textarea><br\>
				
					<p class ="submit">
					<input type="submit" value="Upload" name="submit">
					</p>
				</form>
	
	</body>
@endsection