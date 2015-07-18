<?php

/* :: Bashify ::
 *
 * FILENAME:    add.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Page where users can add quotes.
 */

require("etc/index.php");
require("lib/index.php");

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error)
{
	die("Could not connect to MySQL database. Please make sure etc/db.php is configured correctly. ~ " . $db->connect_error);
}

$pagetitle = "Add quote";

include("html/header.php");

if (strlen($_POST[quote]) > 0 and $_POST[captcha] == $_POST[captcha1] + ($_POST[captcha2] * $_POST[captcha3]))
{
	date_default_timezone_set("EST");
	
	$newquote = nl2br(htmlspecialchars($_POST[quote])); // Formats quote so it's HTML-friendly
	$newdate  = date("m.d.y h:i A e");                  // Formats date so it's human-readable
	$newip    = $_SERVER[REMOTE_ADDR];                  // IP of the user who's posting the quote
	
	$stmt1 = $db->prepare("INSERT INTO quotes (quote, date, rating, approved, ip) VALUES (?, ?, 0, 0, ?)");
	$stmt1->bind_param("sss", $newquote, $newdate, $newip);
	$stmt1->execute();
	
	$stmt2 = $db->prepare("SELECT id FROM quotes WHERE date = ?");
	$stmt2->bind_param("s", $newdate);
	$stmt2->execute();
	
	$query = $stmt2->get_result();
	$newid = $query->fetch_assoc();
	$id    = $newid[id];
	
	$stmt1->close();
	$stmt2->close();
	
	include("html/success.php");
}
else
{
	if (strlen($_POST[quote]) > 0 and isset($_POST[captcha]))
	{
		$message = "You provided an incorrect answer to the anti-spam question. Please try again.";
	} 
	else if (strlen($_POST[quote]) > 0 xor isset($_POST[captcha]))
	{
		$message = "Please fill out all of the fields.";
	}
	else
	{
		$message = NULL;
	}
	
	$captcha1 = mt_rand(5, 15);
	$captcha2 = mt_rand(5, 15);
	$captcha3 = mt_rand(5, 15);
	
	include("html/add.php");
}

include("html/footer.php");

?>