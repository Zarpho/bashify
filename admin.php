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

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error)
{
	die("Could not connect to MySQL database. Please make sure etc/db.php is configured correctly. ~ " . $db->connect_error);
}

/*if (isset($_SESSION[userid]))
{
	$query       = $db->query("SELECT * FROM users WHERE user = '" . $_SESSION[userid] . "'");
	$currentuser = new User($query->fetch_assoc());
}*/

if (isset($_GET[approve]) or isset($_GET[delete]))
{
	header("Refresh: 5; url=admin.php");
	
	$id = isset($_GET[approve]) ? $_GET[approve] : $_GET[delete];
	
	$stmt = $db->prepare("SELECT * FROM quotes WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	
	$query = $stmt->get_result();
	$quote = new Quote($query->fetch_assoc());
	
	$stmt->close();
}

$pagetitle = "Admin";

include("html/header.php");

if (isset($_GET[approve]))
{
	$quote->approve();
	
	echo("#" . $quote->id . " has been approved.");
}
else if (isset($_GET[delete]))
{
	$quote->delete();
	
	echo("#" . $quote->id . " has been deleted.");
}
else
{
	$query       = $db->query("SELECT * FROM quotes WHERE approved = 0");
	$quotesarray = $query->fetch_all(MYSQL_ASSOC);
	
	if ($quotesarray == NULL)
	{
		echo "No results to show";
	}
	else
	{
		foreach ($quotesarray as $quotearray)
		{
			$quote = new Quote($quotearray);
			$ip    = $quotearray[ip];
			
			include("html/admin.php");
			include("html/quote.php");
		}
	}
}

include("html/footer.php");