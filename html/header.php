<?php

/* :: Bashify ::
 * 
 * FILENAME:    html/header.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains HTML data for the header of each page.
 */

/* This file references the $pagetitle variable when it is included.
 */

?>

<!DOCTYPE html>
<html>
	<head>
		<title>QDB - <?=$pagetitle?></title>
		<link rel="Stylesheet" type="text/css" href="stylesheet.css" />
	</head>
	<body>
		<table id="main">
			<tbody>
				<tr class="header">
					<td>QDB</td>
					<td class="right"><?=$pagetitle?></td>
				</tr>
				<tr>
					<td class="centered" colspan="2"><a href="index.php">Home</a> / <a href="view.php">View all</a> / <a href="add.php">Add quote</a></td>
				</tr>
				<tr>
					<td colspan="2">