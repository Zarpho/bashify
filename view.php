<?php

/* :: Bashify ::
 * 
 * FILENAME:    view.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Displays all quotes, or displays a single quote when ID is specified in the URL.
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

if (isset($_GET[id]))
{
	$query       = mysqli_query($mysqli, "SELECT * FROM quotes WHERE id = " . $_GET[id]);
	$quotesarray = mysqli_fetch_assoc($query);
	$id          = "#" . $_GET[id];
}
else
{
	$query       = mysqli_query($mysqli, "SELECT * FROM quotes WHERE approved = 1 ORDER BY id ASC");
	$quotesarray = mysqli_fetch_all($query, MYSQL_ASSOC);
	$id          = "all";
}

$pagetitle = "View " . $id;

include("html/header.php");

if ($id == "all")
{
	foreach ($quotesarray as $quotearray)
	{
		$quote = new Quote($quotearray);
		
		include("html/quote.php");
	}
}
else if ($quotesarray[id] == NULL)
{
	echo "						<p>" . $id . " does not exist.</p>";
}
else if ($quotesarray[approved] == 0)
{
	echo "						<p>" . $id . " has not yet been approved.</p>";
}
else
{
	$quote = new Quote($quotesarray);
	
	include("html/quote.php");
}

include("html/footer.php");

?>