<?php

$weather = "";
$error = "";
if ($_GET['city']) {
    
    
  $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=15d9bb359ac3a17e0b4de0088c3511cb");
    // Use "urlencode()" to get rid of special characters. Solves problem of spaces in city names giving errors. 
    
$weatherArray = json_decode($urlContents, true);
        //json_decode used since API data is in JSON format
        //add "true" flag to return data in an associative array

    
$weather = "The current weather in ".$_GET['city']." is ".$weatherArray['weather'][0]['description'].". ";

$tempInF = round(($weatherArray['main']['temp'] - 273.15)*1.8 + 32);
    
$weather .= "The temperature is ".$tempInF."&deg;F and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
    
    
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
      
      <style>
          html { 
              background: url(lightning.jpeg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
          
          body {
              
              text-align: center;
              background: none;
            
        
          }
          .container {
              
              width: 620px;
          }
          #content-bg {
              background: rgba(255, 255, 255, 0.3);
              margin-top: 100px;
              padding: 50px;
              border-radius: 10px;
          }
          
          .lead {
              margin-bottom: 30px;
          }
          #submit {
              margin-top: 20px;
          }
          #weather {
              margin-top: 20px;
          }
      </style>
      
      
  </head>
  <body>
      
    <div class="container">
      <div class="row">
        <div id="content-bg">
          <h1 class="display-4">What's The Weather?</h1>
          <p class="lead">Enter the name of the city.</p>
            
          <form method="get">
            <div class="form-group">
              <input type="text" class="form-control" id="city" name="city" value = "<?php echo $_GET['city']; ?>"> 
              </div><!-- 'value' keeps the search phrase in input box after entered-->
            <button type="submit" class="btn btn-primary btn-lg" id="submit" name="submit">Submit</button>
          </form>
        
            
            <div id="weather"><?php
                if ($weather) {
                    
                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                        //Bootstrap Alert style
                } else if ($error) {
                    
                     echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    
                }
                
                ?></div>
        </div>
      </div>
    </div>
      
      
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  </body>
</html>