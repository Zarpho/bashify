<?php

/* :: Bashify ::
 * 
 * FILENAME:    html/quote.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains HTML data for the Quote class.
 */

/* This file references all of the class-level variables from the Quote class. See lib/quote.php
 * for documentation on these variables.
 */

?>

						<br />
						<p class="monospace">#<?=$quote->id?> - <?=$quote->date?> <span class="upvotes"><?=$quote->upvotes?></span> + / - <span class="downvotes"><?=$quote->downvotes?></span></p>
						<p class="monospace"><?=$quote->quote;?></p>