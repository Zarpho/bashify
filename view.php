<?php

/* :: Bashify ::
 * 
 * FILENAME:    view.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Displays all quotes, or displays a single quote when ID is specified in the URL.
 */

require("etc/index.php");
require("lib/index.php");

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error)
{
	die("Could not connect to MySQL database. Please make sure etc/db.php is configured correctly. ~ " . $db->connect_error);
}

if (isset($_GET[id]))
{
	$id = $_GET[id];
	
	if (is_numeric($id) and $id > 0)
	{
		$stmt = $db->prepare("SELECT * FROM quotes WHERE id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		
		$query       = $stmt->get_result();
		$quotesarray = $query->fetch_assoc();
		
		$stmt->close();
		
		$id = "#" . $id;
	}
	else
	{
		$invalid = TRUE;
		$id      = "\"" . $id . "\"";
	}
}
else
{
	$query       = $db->query("SELECT * FROM quotes WHERE approved = 1 ORDER BY id DESC");
	$quotesarray = $query->fetch_all(MYSQL_ASSOC);
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
else if ($invalid == TRUE)
{
	echo "\n";
	echo "						<p>" . $id . " is an invalid quote ID.</p>";
}
else if ($quotesarray[id] == NULL)
{
	echo "\n";
	echo "						<p>" . $id . " does not exist.</p>";
}
else if ($quotesarray[approved] == 0)
{
	echo "\n";
	echo "						<p>" . $id . " has not yet been approved.</p>";
}
else
{
	$quote = new Quote($quotesarray);
	
	include("html/quote.php");
}

include("html/footer.php");

?>