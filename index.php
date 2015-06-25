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

$query       = mysqli_query($mysqli, "SELECT * FROM quotes WHERE approved = 1 ORDER BY id ASC LIMIT 50");
$quotesarray = mysqli_fetch_all($query, MYSQL_ASSOC);

include("html/header.php");

foreach ($quotesarray as $quotearray)
{
	$quote = new Quote($quotearray);
	
	include("html/quote.php");
}

include("html/footer.php");

?>