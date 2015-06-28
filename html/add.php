<?php

/* :: Bashify ::
 * 
 * FILENAME:    html/add.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains HTML data for adding quotes.
 */

/* This file references the $captcha1, $captcha2, $captcha3, and $message variables when it is
 * included.
 */

?>

						<br />
						<p class="title">Add Quote</p>
						<p><?=$message?></p>
						<form method="post" action="add.php">
							<table id="form">
								<tbody>
									<tr>
										<td>Quote:</td>
										<td><textarea name="quote" cols="60" rows="10"></textarea></td>
									</tr>
									<tr>
										<td>What is <?=$captcha1?> + <?=$captcha2?> * <?=$captcha3?>?</td>
										<td><input type="text" name="captcha" /></td>
									</tr>
									<tr>
										<td class="centered"><input type="submit" value="Add quote" /></td>
									</tr>
								</tbody>
							</table>
							<input type="hidden" name="captcha1" value="<?=$captcha1?>" />
							<input type="hidden" name="captcha2" value="<?=$captcha2?>" />
							<input type="hidden" name="captcha3" value="<?=$captcha3?>" />
						</form>