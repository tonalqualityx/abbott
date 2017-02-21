<?php //The home page
require('header.php'); ?>
<div class="row">
	<div class="small-12 medium-8 column">
		<h3>Search Accounts</h3>
		<div class="row">
			<form method="POST" action="/">
				<div class="small-4 column">
					<label>
						Last Name:
						<input type="text" placeholder="Scooterbella" name="last" />
						<input type="submit" class="button" value="search" />
						<a class="button" data-open="newCustomer">Add New</a>
					</label>
				</div>
				<div class="small-4 column end">
					<label>
						Street Address:
						<input type="text" placeholder="123 Not Your House Lane" name="addy"/>
					</label>
				</div>

			</form>
		</div>
	</div>
</div>

<?php 
include('modals.php');
require('footer.php'); ?>