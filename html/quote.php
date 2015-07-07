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

/* $color - determines based on rating what the color of the rating should be. */
if ($quote->rating > 0)
{
	$color = "green";
}
else if ($quote->rating == 0)
{
	$color = "grey";
}
else
{
	$color = "red";
}

?>

						<p class="monospace"><a href="view.php?id=<?=$quote->id?>">#<?=$quote->id?></a> ~ <?=$quote->date?> ~ +(<span class="<?=$color?>"><?=$quote->rating?></span>)-</p>
						<p class="monospace"><?=$quote->quote;?></p>
						<br />