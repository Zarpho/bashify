<?php

/* :: Bashify ::
 * 
 * FILENAME:    lib/quote.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains the Quote class.
 */

class Quote
{
	public $id;
	public $quote;
	public $date;
	public $upvotes;
	public $downvotes;
	public $approved;
	
	/* Constructor method */
	function __construct($quotedata)
	{
		$this->id        = $quotedata[id];
		$this->quote     = $quotedata[quote];
		$this->date      = $quotedata[date];
		$this->upvotes   = $quotedata[upvotes];
		$this->downvotes = $quotedata[downvotes];
		$this->approved  = $quotedata[approved];
	}
}

?>