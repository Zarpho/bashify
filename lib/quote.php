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
	
	/* Voting functions - changes rating of quote */
	function upvote()
	{
		global $db;
	}
	
	function downvote()
	{
		global $db;
	}
	
	/* Admin panel functions */
	function approve()
	{
		global $db;
		
		return $db->query("UPDATE quotes SET approved = 1 WHERE id = " . $this->id) ? true : false;
	}
	
	function delete()
	{
		global $db;
		
		return $db->query("DELETE FROM quotes WHERE id = " . $this->id) ? true : false;
	}
}

?>