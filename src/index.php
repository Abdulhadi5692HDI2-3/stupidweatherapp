<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="mphase.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>
<body>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="btnSwitch" name="btnSwitch">Color switch</button>
                <script src="modepick.js"></script>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" onclick="location.replace('changeregion.html');" href="#frame">Change Region shown in Weather Report</a>
            </li>
        </ul>
            <div class="blurimg"></div>
            <div class="tab-pane container-fluid active" id="home">
                <h1>Weather</h1>
                <?php
                    $variablea = $_GET["region"];
                    $conta = file_get_contents("https://wttr.in/?format=%f");
                    $conta2 = "↑" . $conta[1] . $conta[2] . $conta[3] . $conta[4] . $conta[5];
                    /*$bildstr = "https://wttr.in/" . $variablea . "?format=j1";*/
                    $obj = json_decode(file_get_contents("https://wttr.in/?format=j1"), true);
                    echo "<h2>", get_weather_icon(), $obj['current_condition'][0]['weatherDesc'][0]['value'], "</h2><br>";
                    echo "Temperature: <b><i>", $obj['current_condition'][0]['temp_C'], "°C</i></b>  <span style='color: #00ff00;'>", $conta2, "</span><br>";
                    echo "Feels like: <b><i>", $obj['current_condition'][0]['FeelsLikeC'], "°C</i></b> <br>";

                    function get_weather_icon() {
                        return file_get_contents("https://wttr.in/?format=%c");
                    }
                    ?>
                <div class="container-fluid col rounded-1 border-2" style="padding: 50px;width:250px;background-image: url('https://abdulhadi5692hdi2.github.io/index.jpg');">
                    <div class="row-sm-3 wht">Sunrise: <b><i><?php 
                        echo $obj['weather'][0]['astronomy'][0]['sunrise'];
                    ?></i></b>
                    </div>
                    <div class="row-sm-3 wht">Sunset: <b><i><?php 
                        echo $obj['weather'][0]['astronomy'][0]['sunset'];
                    ?></i></b>
                    </div>
                    <div class="row-sm-3 wht">Moonrise: <b><i><?php 
                        echo $obj['weather'][0]['astronomy'][0]['moonrise'];
                    ?></i></b>
                    </div>
                    <div class="row-sm-3 wht">Moonset: <b><i><?php 
                        echo $obj['weather'][0]['astronomy'][0]['moonset'];
                    ?></i></b>
                    </div>
                </div>
                <h3>Weather Report</h3> <button type="button" onclick="changeaccordingly();" id="ident" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#w++">Show More ↓</button>
                <script>
                    function changeaccordingly() {
                        var a = document.getElementById("ident");
                        if (a.innerHTML == "Show Less ↑") {
                            a.innerHTML="Show More ↓";
                            return;
                        }
                        a.innerHTML="Show Less ↑";
                    }
                </script>
                <div class="collapse" id="w++">
                <?php
                $variablea = $_GET["region"];
                if ($variablea == NULL) {
                    echo "<div class='alert alert-danger alert-dismissible fade show'>No region specified!</div>";
                } else {
                    $variablea = $_GET["region"];
                    $inner = file_get_contents("https://v3.wttr.in/$variablea.png");
                    if ($inner == "ERROR: Not found: $variablea") {echo "<div class='alert alert-danger alert-dismissible fade show'>No Weather report found for $variablea";}
                    echo "<img src='https://v3.wttr.in/$variablea.png' />";
                }
                ?>
                <h3>Stuff to do with wind</h3>
                <?php
                    echo "Wind Speed: <b><i>→", $obj['current_condition'][0]['windspeedKmph'], " km/h</i></b><br>";
                ?>
                <h3>Moon Phase: <mphase><?php echo(file_get_contents("https://wttr.in/?format=%m"));?></mphase>(<?php echo $obj['weather'][0]['astronomy'][0]['moon_phase'];?>)</h3></div>
            </div>
        </div>
        <footer class="container-fluid bg-4 text-center">
            <hr>
            Weather info possible by <a href="https://wttr.in/"><i>wttr.in</i></a><br>
            Styling by <a href="https://getbootstrap.com"><i>Bootstrap 5.3.0</i></a><br>
            Made by <i>Abdulhadi</i><br>
        </footer>
</body>
</html>
