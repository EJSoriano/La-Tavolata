<footer>
	</br></br>
	<div>
	<p>Student Project - Not a commercial site<p>
	<p>Contact: kharraz.mehdi@gmail.com | benbkoch@gmail.com | lancemcvicar@gmail.com | erikjsoriano@gmail.com</p>
	<?php echo "<p>Last modified: " . date ("F d Y H:i:s.", getlastmod()) . "</p>"; ?>
	</div>
	</br></br>
	<?php 
		mysqli_close($connection);
	?>
</footer>