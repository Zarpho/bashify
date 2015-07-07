<?php

/* :: Bashify ::
 * 
 * FILENAME:    lib/quote.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains the Quote class.
 */

class Quote
{
	public $id;       // The ID # of the quote
	public $quote;    // The quote
	public $date;     // The date the quote was posted
	public $rating;   // The rating of the quote
	public $approved; // Whether or not the quote is approved
	
	/* Constructor method */
	function __construct($quotedata)
	{
		$this->id       = $quotedata[id];
		$this->quote    = $quotedata[quote];
		$this->date     = $quotedata[date];
		$this->rating   = $quotedata[rating];
		$this->approved = $quotedata[approved];
	}
}

?>