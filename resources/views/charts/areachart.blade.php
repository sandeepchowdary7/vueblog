<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel GeoChart Example</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">  
  </head>
  <body>
    <div class="container">
      <h2>Laravel Chart Example</h2><br/>
      <div id="pop_div"></div>
      @areachart('Population', 'pop_div')
   </div>
  </body>
</html>