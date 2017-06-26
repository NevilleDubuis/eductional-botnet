<!doctype html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
      body {
        background: black;
      }

      canvas {
        display: block;
      }

      .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
      }

      .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
    <div class="flex-center position-ref full-height">
      @if (Route::has('login'))
        <div class="top-right links">
          @if (Auth::check())
            <a href="{{ url('/home') }}">Home</a>
          @else
            <a href="{{ url('/login') }}">Login</a>
          @endif
        </div>
      @endif
    </div>
    <canvas id="c"></canvas>
    <script>
      var c = document.getElementById("c");
      var ctx = c.getContext("2d");

      //making the canvas full screen
      c.height = window.innerHeight;
      c.width = window.innerWidth;

      var chinese = "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
      chinese = chinese.split("");

      var font_size = 10;
      var columns = c.width/font_size
      var drops = [];
      var dropsSpeed = [];

      for(var x = 0; x < columns; x++) {
        drops[x] = Math.ceil(Math.random() * c.height);
      }

      for(var x = 0; x < columns; x++) {
        dropsSpeed[x] = 1 + (Math.random() - 0.5);
      }

      function draw() {
        ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
        ctx.fillRect(0, 0, c.width, c.height);

        ctx.fillStyle = "#0F0"; //green text
        ctx.font = font_size + "px arial";

        for(var i = 0; i < drops.length; i++) {
          var text = chinese[Math.floor(Math.random()*chinese.length)];
          ctx.fillText(text, i*font_size, drops[i]*font_size);

          if(drops[i] * font_size > c.height && Math.random() > 0.975) {
            drops[i] = 0;
            dropsSpeed[i] = 1 + (Math.random() - 0.5);
          }

          drops[i] += dropsSpeed[i];
        }
      }

      setInterval(draw, 33);
    </script>
  </body>
</html>
