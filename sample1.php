<!DOCTYPE html>
<html>
<head>
  <title>Seat Mapping</title>
  <style>
    .screen {
      text-align: center;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .seat {
      display: inline-block;
      width: 30px;
      height: 30px;
      margin: 5px;
      background-color: #CCCCCC;
      border-radius: 3px;
      cursor: pointer;
    }
    
    .seat.selected {
      background-color: #00FF00;
    }
    
    .seat.booked {
      background-color: #FF0000;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <div class="screen">Screen 1</div>
  <div id="screen1"></div>
  
  <div class="screen">Screen 2</div>
  <div id="screen2"></div>
  
  <div class="screen">Screen 3</div>
  <div id="screen3"></div>

  <script>
    // Seat mapping data
    var screens = {
      screen1: {
        movie: "Movie 1",
        seats: [
          [0, 0, 0, 1, 1, 1, 0, 0, 0],
          [0, 0, 0, 0, 0, 0, 0, 0, 0],
          [0, 0, 1, 1, 1, 1, 1, 0, 0],
          [0, 0, 1, 1, 1, 1, 1, 0, 0],
          [0, 0, 0, 1, 1, 1, 0, 0, 0]
        ]
      },
      screen2: {
        movie: "Movie 2",
        seats: [
          [1, 1, 1, 1, 1, 1, 1, 1, 1],
          [1, 1, 1, 1, 1, 1, 1, 1, 1],
          [1, 1, 1, 1, 1, 1, 1, 1, 1],
          [1, 1, 1, 1, 1, 1, 1, 1, 1],
          [1, 1, 1, 1, 1, 1, 1, 1, 1]
        ]
      },
      screen3: {
        movie: "Movie 3",
        seats: [
          [0, 0, 0, 0, 0, 0, 0, 0, 0],
          [0, 0, 0, 0, 0, 0, 0, 0, 0],
          [0, 0, 0, 0, 0, 0, 0, 0, 0],
          [0, 0, 0, 0, 0, 0, 0, 0, 0],
          [0, 0, 0, 0, 0, 0, 0, 0, 0]
        ]
      }
    };

    // Render seats for each screen
    for (var screen in screens) {
      var container = document.getElementById(screen);
      var seats = screens[screen].seats;
      
      for (var i = 0; i < seats.length; i++) {
        var row = document.createElement("div");
        
        for (var j = 0; j < seats[i].length; j++) {
          var seat = document.createElement("div");
          seat.className = "seat";
          
          if (seats[i][j] === 0) {
            seat.classList.add("selected");
          } else if (seats[i][j] === 1) {
            seat.classList.add("booked");
          }
          
          row.appendChild(seat);
        }
        
        container.appendChild(row);
      }
    }
  </script>
</body>
</html>
