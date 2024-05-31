<!DOCTYPE html>
<html>
<head>
    <title>Product Crud</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    
    </head>
<body>
  
<div class="container">
    @yield('content')
</div>
<style>
.containter{
    width:100%;
    height:100%;
        }
    .btn btn-primary {background-color: #008CBA;} /* Blue */
#mytableContainer {
            position:static;
            width: 100%;
            height:100%;
            padding-left:10%;
            padding-right:10%; }
        table{ 
            width:75%; /*to centralize the table */
            border:2px;
            padding:5px;
                    }
        th{
            background-color:pink;
            font: Arial, sans-serif;
            font-weight:bold;
            font-size: 2em;
            color:brown;
                }
        td{
            border-top: 1px solid greenyellow;
            padding: 5px;
            font:Arial, sans-serif;
            font-size:1em;
            /*font-style:italic;*/
            Text-align:left;
            color:black;
                }
                </style>
   
</body>
</html>