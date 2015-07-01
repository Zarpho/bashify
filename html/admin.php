<?php

/* :: Bashify ::
 *
 * FILENAME:    html/admin.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains HTML data for the administration page.
 */

/* This file references the $quote->id and $ip variable from admin.php. These variable represent
 * the ID of the quote and the IP of the user that posted it, respectively.
 */

?>

						<p><a class="green" href="admin.php?approve=<?=$quote->id?>">Approve</a> - <a class="red" href="admin.php?delete=<?=$quote->id?>">Delete</a> - Posted by <?=$ip?> (<a href="admin.php?block=<?=$ip?>">block</a>)</p>