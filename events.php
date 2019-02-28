<?php

include("core.php");

function get_springfest_events($begin, $end) {
    $events = array();

    $evtQuery = "(SELECT `name`, `begin`, `end`, `location`, NULL AS `sponsor`, `details`, 'image' FROM `eps_events` WHERE division='sf' AND status != 2 AND begin>='". $begin ."' AND begin<='". $end ."') UNION (SELECT `event_name` AS `name`, `start` AS `begin`, `end`,`location`,`organization` AS `sponsor`,`description` AS `details`, 'img' AS 'image' FROM `sf_events_new` WHERE approved = 1 AND start>='". $begin ."' AND start<='". $end ."') ORDER BY `begin` ASC";

    // $evtQuery = "SELECT eps_events.name, NULL AS `sponsor`, eps_events.begin, eps_events.end, eps_events.location, eps_events.details FROM `eps_events` WHERE eps_events.division = 'sf' AND eps_events.begin => $begin AND eps_events.begin <= $end AND eps_events.status > 0 UNION SELECT sf_events_new.event_name as `name`, sf_events_new.organization AS `sponsor`, sf_events_new.start AS `begin`, sf_events_new.end, sf_events_new.location, sf_events_new.description FROM `sf_events_new` WHERE sf_events_new.approved > 0 AND sf_events_new.start >= $begin AND sf_events_new.end <= $end ORDER BY `begin` ASC";

    $evtInfoResult = mysql_query($evtQuery);

    while($evtInfo = mysql_fetch_assoc($evtInfoResult)) :
        $event = new stdClass();
        $event->name = $evtInfo['name'];
        //$event->sponsor = $evtInfo['group'];
        $event->date = date("D, m/d/Y g:i A",$evtInfo['begin']);
        $event->location = $evtInfo['location'];
        $event->details = $evtInfo['details'];
        $event->img = $evtInfo['img'];
        if(is_null($evtInfo['sponsor'])) {
            $event->sponsor = "CAB";
        }
        else {
            $event->sponsor = $evtInfo['sponsor'];
        }
        $event->calendar_link = make_google_calendar_link($event->name, $evtInfo['begin'], $evtInfo['end'], $event->location, $event->details);
        if($event->name != "SpringFest 2016!")
            array_push($events, $event);
    endwhile;
    return $events;
}

function make_google_calendar_link($name, $begin, $end, $location, $details) {
    $name = urlencode($name);
    date_default_timezone_set("GMT");
    $begin = date("Ymd\THis\Z", $begin);
    $end = date("Ymd\THis\Z", $end);
    date_default_timezone_set("America/New_York");
    $location = urlencode($location);
    $details = urlencode($details);
    return "https://www.google.com/calendar/render?action=TEMPLATE&text=$name&dates=$begin/$end&details=$details&location=$location&sf=true&output=xml";
}
?>