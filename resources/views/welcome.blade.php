<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<div class="wrapper">
		<head>
        	<meta charset="utf-8">
        	<meta name="viewport" content="width=device-width, initial-scale=1">
        	<title>New Ideas</title>        
       	 <!-- Styles -->
			<link href="/css/nhastyle.css" rel="stylesheet">
        <!-- Styles -->        
		  	<!-- <div class="head-wrapper"> -->
        		<div class ="row">
					<div class ="sm-col-span-2 lg-col-span-4">
		        		<div class="title"> Title </div>
			        		<div class="header"> Header 
				                <form action ="userSearch" method="GET">
					                <input type="text" name="usersearch" placeholder="Enter your search">
					                <button type="submit" name="submit"> Search </button>
								</form>
						         				
           							 
							</div>
					</div>
				</div>
			<!-- </div> -->
					
				<div class ="row">
					<div class ="sm-col-span-2 lg-col-span-4">
						<div class="navbar">
							
							<nav>								
								<ul id="">
									<li><a href="nha">Home </a></li> 
									<li><a href="#">About Us</a></li> 
									<li><a href="login">You sell</a>
									<!--UserUps is the form action in resources\views\products\SupplyForm.blade.php
									<form action= "/UserUps" method = "POST" enctype = "multipart/form-data">
									and controlled by route:
									//show the form
									Route::get('/UserUps', 'EstateController@create');
									//store users' uploads from the supply form
									Route::post('/UserUps', 'EstateController@store');
									 -->
										<ul>
											<li><a href="#"> Apartments </a></li>
											<li><a href="#"> Villas</a></li>
											<li><a href="#"> Warehouses </a></li>
										</ul>
									</li>								
									<li><a href="#">Services</a></li>
								</ul>	
							</nav>
								
							@if (Route::has('login'))
                						<div class="top-right links">
                   							@auth
                        						<a href="{{ url('/myposts') }}">My Store</a>
                   						 		@else
                       								<a href="{{ route('login') }}">Login</a>
                        								@if (Route::has('register'))
                            								<a href="{{ route('register') }}">Register</a>
                        								@endif
                    						@endauth
               							 </div>
            						@endif
								
						</div>
					</div>
				</div>

		</head>
  
		<body>  
			<header>Header: company name or logo </header> 
			<h1>What's next?</h1>         
                
        		<div class="content-wrapper"> Content
					<div class="main">
				        <p> Please select, html, CSS has always been used to design the layout and looking of web pages but producing complicated multi-column layouts has always been fiddly and hackish, and frustrating to get working consistently and precisely across browsers as well. First, we used tables, floats, positioning and inline-block, but all of these techniques left out a lot of major functionality (vertical centering, for example).
                         To solve these layout complications, we invented proper responsive layout models available natively in the browser, out of which - Flexbox, CSS Grid and Bootstrap became most popular and are widely supported across all platforms & browsers. These not only equipped us to create layouts that previously wasn’t feasible to create without involving JavaScript, but these also make code easier to understand and maintain.
						</p>
						<br> 
						</br>
						<p> Mockup house </p>
            				<img src ="/SiteImage/mockup.jpg"  alt ="site image">
            			<p> 
            			The housing market has been on fire this year with record-low mortgage rates and a sudden wave of relocations made possible by remote work. Meanwhile, home prices have pushed new boundaries as buyer demand continues to surge. As we near the end of 2020, here’s a look at the expectations of real estate experts for 2021.

						Danielle Hale, realtor.com chief economist: We expect sales to grow 7 percent and prices to rise another 5.7 percent on top of 2020’s already high levels. While we expect mortgage rates to tick up gradually, sales and price growth will be propelled by still strong demand, a recovering economy, and still low mortgage rates. High buyer demand and still-lagging supply will keep prices growing, but at a slower pace than 2020 as buyers contend with mortgage rate and price increases that create affordability challenges. 

						While younger Millennial and Gen-Z buyers are expected to play a growing role in the housing market, fast-rising prices will create a bigger barrier to entry for the many first-time buyers in these generations who don’t have existing home equity to tap for down payment savings. Although supply is expected to lag, we do expect the declines to slow and potentially stop by the end of the year as sellers grow more comfortable with the market environment and new construction picks up. Single-family housing starts are expected to grow another 9 percent in 2021. On the whole, the market will remain seller-friendly, but buyers will still have relatively low mortgage rates and an eventually improving selection of homes for sale.
						The housing market has been on fire this year with record-low mortgage rates and a sudden wave of relocations made possible by remote work. Meanwhile, home prices have pushed new boundaries as buyer demand continues to surge. As we near the end of 2020, here’s a look at the expectations of real estate experts for 2021.
          				</p>
            
					</div>						
				</div>
				<div class="footer"> Footer</div>
        </body>
	</div>
</html>

