<!DOCTYPE html>
<html lang="en">
<head>
    <title>Springfest 2018 at Rochester Institute of Technology</title>
    <meta name="description" content="SpringFest 2018 is happening April 19-22. Find out everything you need to know here! Presented by RIT College Activities Board.">
    <meta property="og:image" content="http://www.rit.edu/studentaffairs/cab/springfest/images/spring2.png"> <!-- Facebook Looks at this as the preview image when the page is shared -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

    <link href="datepick/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="datepick/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="css/frame.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:300|Oswald:600" rel="stylesheet">

</head>
<script>


</script>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>

<body onload="carousel()">

<!-- Wrap all page content here -->
<div id="wrap">

        <div class="navigation navbar-header">

            <a href="#1" class="nav navbar-btn btn btn-default btn-plus"> TH </a>
            <a href="#2" class="nav navbar-btn btn btn-default btn-plus"> FR </a>
            <a href="#3" class="nav navbar-btn btn btn-default btn-plus"> SA </a>
            <a href="#4" class="nav navbar-btn btn btn-default btn-plus"> SU </a>
            <a href="#4" class="nav reg navbar-btn btn btn-default btn-plus" > REGISTER </a>

        </div>

    <header class="masthead">
        <div class="landingContainer" id="top">
          <button class="regBtn"><a href="#register">REGISTER YOUR EVENT</a></button>
        </div>
    </header>
<!--ad belt-->

    <!--<div class="artist"></div>
     <div class="swag">
        <div class="text-center" style="padding: 2%">
            <h3>THE SWAG</h3>
            <p>Swag will be distributed randomly at Events.</p>
        </div>
        <div class="slideshow">
            <img class="mySlides" src="images/swag.jpg" style="width:100%">
            <img class="mySlides" src="images/shirt.jpg" style="width:100%">
            <img class="mySlides" src="images/glasses.jpg" style="width:100%">
            <img class="mySlides" src="images/hat.jpg" style="width:100%">
            <img class="mySlides" src="images/socks.jpg" style="width:100%">
        </div>
    </div>-->

    <?php include("events.php"); ?>

    <!--Events-->


    <div id="1" class="section seventy">

        <div class="grid">

            <div class="column cols-6">
                <h2>THURSDAY</h2>
            </div>
            <?php

            $i   = 0;
            $n   = 0;
            //event time in epoch
            $thu = get_springfest_events(1524110459, 1524218400);
            foreach ($thu as $event):
                if ($i == 0) {
                    echo '<div class="column cols-2">';
                    $i++;
                }
                ?>
                <div class="card" >
                    <div class="card-image" style="background-image: url(images/<?php
                    if($event->name == 'Kickoff BBQ')
                        echo 'bbqweb.png';
                    else if($event->name == 'DIY Flower Crowns')
                        echo 'flowercrownweb.png';
                    else if($event->name == 'Star Wars: The Last Jedi')
                        echo 'StarWars_Web.png';
                    else
                        echo 'sf_thumb.png';
                    ?>)"></div>
                    <h3><?= $event->name; ?></h3>
                    <h4>Sponsored by <?= $event->sponsor; ?></h4>
                    <br>
                    <p><?= $event->date; ?></p>
                    <p><?= $event->location; ?></p>
                    <div class="desc">
                        <p><?= $event->details; ?></p>
                    </div>
                </div>

                <?php
                if ($i == 1) {
                    echo '</div>';
                    $i--;
                }
            endforeach;
            ?>
        </div>
    </div>

    <div id="2" class="section eighty">

        <div class="grid">

            <div class="column cols-6">
                <h2>FRIDAY</h2>
            </div>
            <?php

            $i   = 0;
            $n   = 0;
            $thu = get_springfest_events(1524196859,1524304800);
            foreach ($thu as $event):
                if ($i == 0) {
                    echo '<div class="column cols-2">';
                    $i++;
                }
                ?>
                    <div class="card" >
                        <div class="card-image" style="background-image: url(images/<?php
                        if($event->name == 'Pizza Palooza!')
                            echo 'Pizza_Web.png';
                        else if($event->name == 'PuppyFest')
                            echo 'puppyfestweb.png';
                        else if($event->name == 'An Evening of Bob Ross')
                            echo 'bobrossweb.png';
                        else if($event->name == 'Heathers: The Musical')
                            echo 'heathers.jpg';
                        else if($event->name == 'Be-you-tiful Week - Fearless Friday')
                            echo 'beautiful.png';
                        else if($event->name == 'Dance in the Dark')
                            echo 'dance.JPG';
                        else
                            echo 'sf_thumb.png';
                        ?>)"></div>
                        <h3><?= $event->name; ?></h3>
                        <h4>Sponsored by <?= $event->sponsor; ?></h4>
                        <br>
                        <p><?= $event->date; ?></p>
                        <p><?= $event->location; ?></p>
                        <div class="desc"><p><?= $event->details; ?></p></div>
                    </div>

                <?php
                if ($i == 1) {
                    echo '</div>';
                    $i--;
                }
                endforeach;
                ?>
        </div>

    </div>

    <div id="3" class="section ninety">

        <div class="grid">

            <div class="column cols-6">
                <h2>SATURDAY</h2>
            </div>
            <?php

            $i   = 0;
            $n   = 0;
            $thu = get_springfest_events( 1524283259, 1524391200);
            foreach ($thu as $event):
            if ($i == 0) {
            echo '<div class="column cols-2">';
                $i++;
                }
                ?>
                <div class="card" >
                    <div class="card-image" style="background-image: url(images/<?php
                        if($event->name == 'Guts!')
                            echo 'GUTs_Web.png';
                        else if($event->name == 'Build a Buddy!')
                            echo 'buddyweb.png';
                        else if($event->name == 'Sk8ing!')
                            echo 'Sk8ting_Web.png';
                        else if($event->name == 'Humans versus Zombies Invitational')
                            echo 'hvz.jpeg';
                        else if($event->name == 'Phat! Food Trucks')
                            echo 'FoodtrucksWeb.jpg';
                        else
                            echo 'sf_thumb.png';
                        ?>)"></div>
                    <h3><?= $event->name; ?></h3>
                    <h4>Sponsored by <?= $event->sponsor; ?></h4>
                    <br>
                    <p><?= $event->date; ?></p>
                    <p><?= $event->location; ?></p>
                    <div class="desc">
                        <p><?= $event->details; ?></p>
                    </div>
                </div>

                <?php
                if ($i == 1) {
                    echo '</div>';
                    $i--;
                }
                endforeach;
                ?>
            <div id="4" class="column cols-6" style="margin-top: 25px;">

                <h2>SUNDAY</h2>
            </div>
                <?php

                $i   = 0;
                $n   = 0;
                $thu = get_springfest_events(1524369659, 1524477600);
            foreach ($thu as $event):
            if ($i == 0) {
            echo '<div class="column cols-2">';
                $i++;
                }
                ?>
                <div class="card" >
                    <div class="card-image" style="background-image: url(images/<?php
                    if($event->name == 'Heel Violence')
                        echo 'heel.png';
                    else if($event->name == 'Color Run')
                        echo 'color.JPG';
                    else
                        echo 'sf_thumb.png';
                    ?>)"></div>
                    <h3><?= $event->name; ?></h3>
                    <h4>Sponsored by <?= $event->sponsor; ?></h4>
                    <br>
                    <p><?= $event->date; ?></p>
                    <p><?= $event->location; ?></p>
                    <div class="desc">
                        <p><?= $event->details; ?></p>
                    </div>

                </div>

                <?php
                if ($i == 1) {
                    echo '</div>';
                    $i--;
                }
                endforeach;
                ?>
        </div>

    </div>

<div class="column" id="register">

    <br>

    <div>

        <div class="cols-5 col-sm-offset-2">
            <form action="processRegistration.php" method="POST">

                <div class="row form-group">
                    <div class="col-xs-12">
                        <h1>Register Your Event</h1>
                        <p>Only events registered by April 1st will be on the print admats</p>
                    </div>
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="name" name="name" placeholder="Your Name" type="text">
                    </div>
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="email" name="email" placeholder="Email" type="text">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="organization" name="organization" placeholder="Organization" type="text">
                    </div>
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="event_name" name="event_name" placeholder="Event Name" type="text">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-10">
                        <textarea class="form-control disabled" id="description" name="description" placeholder="Event Description"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="location" name="location" placeholder="Location" type="text">
                    </div>
                    <div class="col-xs-5">
                        <input class="form-control disabled" id="alt_location" name="alt_location" placeholder="Alternate Location" type="text">
                    </div>
                </div>

                <div class="row form-group">

                    <div class="input-group date form_datetime col-xs-5" data-date="2018-03-19T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="start">
                        <input class="form-control disabled" size="16" type="text" name="realStart" placeholder="Start" id="realStart" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="start" name="start" value="" />


                    <div class="input-group date form_datetime2 col-xs-5" data-date="2018-03-19T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="end">
                        <input class="form-control disabled" size="16" type="text" name="realEnd" placeholder="End" id="realEnd" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="end" value="" name="end" />

                </div>

                <div class="row form-group">
                    <div class="col-xs-10">
                        <textarea class="form-control disabled" id="needs" name="needs" placeholder="Needs for your event"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-4">
                        <input class="form-control disabled" id="funds" name="funds" placeholder="Requests from CAB" type="text">
                    </div>
                    <div class="col-xs-4">
                        <input class="form-control disabled" id="ems" name="ems" placeholder="EMS Registration Number" type="text">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-xs-10">
                        <button type="submit" id="submit" class="btn btn-default pull-right disabled">Submit</button>
                    </div>
                </div>

        </div>
    </div>
</div> -->

</div><!--/wrap-->
<div id="footer">
    <div class="container">
        <p class="text-muted">&copy; 2018 <a href="http://cab.rit.edu">College Activities Board</a> at <a href="https://rit.edu">RIT</a> — <a href="https://twitter.com/search?f=realtime&q=%23sf18">#SF18</a></p>
    </div>
</div>

<script type="text/javascript" src="datepick/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datepick/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: "2018-04-19 0:01",
        endDate: "2018-04-22 23:59"
    });

    $('.form_datetime2').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: "2018-04-19 0:01",
        endDate: "2018-04-22 23:59"
    });

</script>





<!-- JavaScript jQuery code from Bootply.com editor  -->

<script type='text/javascript'>

    $(document).ready(function() {

        $("#submit").click(function(){
            var event_name = $("#event_name").val();
            var start = $("#start").val();
            var end = $("#end").val();
            var realEnd = $("#realEnd").val();
            var realStart = $("#realStart").val();
            var location = $("#location").val();
            var alt_location = $("#alt_location").val();
            var description = $("#description").val();
            var needs = $("#needs").val();
            var funds = $("#funds").val();
            var organization = $("#organization").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var ems = $("#ems").val();

            var dataString = 'event_name='+ event_name + '&start='+ start + '&email='+ email + '&end='+ end + '&realEnd='+ realEnd + '&realStart='+ realStart + '&location='+ location + '&alt_location='+ alt_location + '&description='+ description + '&needs='+ needs + '&funds='+ funds + '&organization='+ organization + '&name='+ name+ '&ems='+ ems;
            if(event_name==''||start==''||end==''||location==''||description==''||name==''||email==''||organization==''||ems=='')
            {
                alert("Event name, start time, end time, location, description, organization, EMS registration number and contact information are required.");
            }
            else
            {


                $('input:submit').attr("disabled", true);
//AJAX code to submit form.
                window.testVar = $.ajax({
                    type: "POST",
                    url: "processRegistration.php",
                    data: dataString,
                    datatype: 'json',
                    cache: false})
                    .success( function(result){

                        alert("Thank you for submitting your event. We will be in touch with you shortly.");

                        $('input:submit').attr("disabled", false);

                    });
            }
            return false;
        });



</script>



</body>
</html>