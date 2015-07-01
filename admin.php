<?php

/* :: Bashify ::
 *
 * FILENAME:    admin.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Provides an administration control panel for approving quotes, deleting quotes,
 *              and monitoring/blocking IP addresses.
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

$pagetitle = "Admin";

include("html/header.php");

if (isset($_GET[approve]))
{
	$id    = $_GET[approve];
	$query = mysqli_query($mysqli, "UPDATE quotes SET approved = 1 WHERE id = " . $id);
	
	echo("#" . $id . " has been approved.");
}
if (isset($_GET[delete]))
{
	$id    = $_GET[delete];
	$query = mysqli_query($mysqli, "DELETE FROM quotes WHERE id = " . $id);
	
	echo("#" . $id . " has been deleted.");
}
else
{
	$query       = mysqli_query($mysqli, "SELECT * FROM quotes WHERE approved = 0");
	$quotesarray = mysqli_fetch_all($query, MYSQL_ASSOC);
	
	foreach ($quotesarray as $quotearray)
	{
		$quote = new Quote($quotearray);
		$ip    = $quotearray[ip];
		
		include("html/admin.php");
		include("html/quote.php");
	}
}

include("html/footer.php");