<?php

/* :: Bashify ::
 * 
 * FILENAME:    index.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: The index page, which displays the 50 most recent quotes.
 */

require("etc/index.php");
require("lib/index.php");

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error)
{
	die("Could not connect to MySQL database. Please make sure etc/db.php is configured correctly. ~ " . $db->connect_error);
}

$pagetitle = "Home";

include("html/header.php");

$query       = $db->query("SELECT * FROM quotes WHERE approved = 1 ORDER BY id DESC LIMIT 50");
$quotesarray = $query->fetch_all(MYSQL_ASSOC);

foreach ($quotesarray as $quotearray)
{
	$quote = new Quote($quotearray);
	
	include("html/quote.php");
}

include("html/footer.php");

?>