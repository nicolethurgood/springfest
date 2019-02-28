<?php
/*
 *
 * SpringFest 2015 event registration processing API.
 * @author Henry Saniuk, Jr.
 *
 **/

ini_set('display_errors', 1);
require_once('../core2.php');

$name         = null;
$email        = null;
$organization = null;
$event_name   = null;
$location     = null;
$alt_location = null;
$start        = null;
$end          = null;
$funds        = null;
$needs        = null;
$description  = null;
$ems          = null;
$result = array();

if (!empty($_POST['name'])) {
    $name         = ucwords(strtolower($_POST['name']));
    $email        = sanitize($_POST['email']);
    $organization = sanitize($_POST['organization']);
    $event_name   = sanitize($_POST['event_name']);
    $location     = sanitize($_POST['location']);
    $description  = sanitize($_POST['description']);
    $needs        = sanitize($_POST['needs']);
    $alt_location = sanitize($_POST['alt_location']);
    $start        = strtotime($_POST['start']);
    $end          = strtotime($_POST['end']);
    $funds        = sanitize($_POST['funds']);
    $ems          = sanitize($_POST['ems']);
    $realStart    = sanitize($_POST['start']);
    $realEnd      = sanitize($_POST['end']);

    if ($start == "") {
        $start = sanitize($_POST['start']);
    }

    if ($end == "") {
        $end = sanitize($_POST['end']);
    }

    // Create connection
    $conn = new mysqli(getConfigValue("dbHost_w_cab"), "w-cab", getConfigValue("dbPass_w_cab"), "w_cab");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO sf_events_new (approved, event_name, start, end, location, alt_location, description, needs, funds, organization, contact_name, contact_email, ems) VALUES ('0', '$event_name', '$start', '$end', '$location', '$alt_location', '$description', '$needs', '$funds', '$organization', '$name', '$email', '$ems')";

    if ($conn->query($sql) === TRUE) {

        $subject = "2018 CAB SpringFest Event Registration Confirmation";

        $message = <<<TEXT
<p>Dear {$name},</p>

<p>Thank you for registering your event for SpringFest! Below is a list of the details you gave us:</p>

<p>
	<strong>Event Name:</strong> {$event_name}<br />
	<strong>Start Time:</strong> {$realStart}<br />
	<strong>End Time:</strong> {$realEnd}<br />
    <strong>Contact Name:</strong> {$name}<br />
    <strong>Contact Email:</strong> {$email}<br />
    <strong>Location:</strong> {$location}<br />
    <strong>Alternate Location:</strong> {$alt_location}<br />
    <strong>Description:</strong> {$description}<br />
    <strong>EMS Registration Number:</strong> {$ems}<br />
    <strong>Needs:</strong> {$needs}<br />
</p>

<p>We will be getting back to you shortly about the status of your event.</p>

<p>If you have any questions please email <a href="mailto:cab@rit.edu">cab@rit.edu</a> or call us at (585) 475-2509.</p>

<p>
	Thanks,<br />
	CAB Staff
</p>
TEXT;

        $headers = implode("\r\n", array(
            'From: RIT College Activities Board <cab@rit.edu>',
            'Reply-To: RIT College Activities Board <cab@rit.edu>',
            'Content-type: text/html; charset=iso-8859-1'
        ));

        mail($email, $subject, $message, $headers);

        $result['success'] = true;
        $result['message'] = "You have successfully submitted your event. We will be in contact with you shortly.";
    }
    else {

        $result['success'] = false;
        $result['message'] = "Error: " . $sql . "<br>" . $conn->error;

    }

    $conn->close();
    $json = json_encode($result, JSON_UNESCAPED_SLASHES);
    echo $json;

}