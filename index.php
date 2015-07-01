<?php

/* :: Bashify ::
 * 
 * FILENAME:    index.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: The index page, which displays the 50 most recent quotes.
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

$pagetitle = "Home";

include("html/header.php");

$query       = mysqli_query($mysqli, "SELECT * FROM quotes WHERE approved = 1 ORDER BY id DESC LIMIT 50");
$quotesarray = mysqli_fetch_all($query, MYSQL_ASSOC);

foreach ($quotesarray as $quotearray)
{
	$quote = new Quote($quotearray);
	
	include("html/quote.php");
}

include("html/footer.php");

?>