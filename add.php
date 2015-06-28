<?php

/* :: Bashify ::
 *
 * FILENAME:    add.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Page where users can add quotes.
 */

require("etc/index.php");
require("lib/index.php");

$db     = new Database($hostname, $username, $password, $database);
$mysqli = $db->connect();

if (!$mysqli)
{
	die("Could not connect to MySQL database. Please make sure etc/db.php is configured correctly. ~ " . mysqli_error());
}

mysqli_select_db($mysqli, $database);

$pagetitle = "Add quote";

include("html/header.php");

if (strlen($_POST[quote]) > 0 and $_POST[captcha] == $_POST[captcha1] + ($_POST[captcha2] * $_POST[captcha3]))
{
	date_default_timezone_set("EST");
	
	$query = mysqli_query($mysqli, "INSERT INTO quotes (quote, date, upvotes, downvotes, approved, ip) VALUES ('" . htmlspecialchars($_POST[quote]) . "', '" . date("m.d.y h:i A e") . "', 0, 0, 0, '" . $_SERVER[REMOTE_ADDR] . "')");
	
	echo "Success!";
	
	//include("html/success.php");
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