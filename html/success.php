<?php

/* :: Bashify ::
 *
 * FILENAME:    html/success.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Containss HTML data for when a quote is successfully added.
 */

/* This file references the $id variable from add.php. This variable represents the ID of the
 * quote that was successfully added.
 */

?>

						<br />
						<p class="title">Success!</p>
						<br />
						<p>Quote <a href="view.php?id=<?=$id?>">#<?=$id?></a> has been successfully added to the database and is awaiting approval.</p>