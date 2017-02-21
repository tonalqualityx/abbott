<!-- New Customer Modal -->
<div class="reveal " id="newCustomer" data-reveal>
  <h1>New Customer</h1>
  	<form method="POST" action="customer.php">
		<ul class="tabs" data-tabs id="example-tabs">
			<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Billing Info</a></li>
			<li class="tabs-title"><a href="#panel2">Service Location</a></li>

		</ul>
		<div class="tabs-content clearfix" data-tabs-content="example-tabs">
			<div class="tabs-panel is-active" id="panel1">
				<div class="row">
					<div class="small-12 medium-6 column">
						<label>First Name:
							<input type="text" name="first" placeholder="Bubba">
						</label>
					</div>
					<div class="small-12 medium-6 column">
						<label>Last Name:
							<input type="text" name="last" placeholder="McFarvenholder">
						</label>
					</div>
					<div class="small-12 column">
						<label>Billing Street Address Line 1:
							<input type="text" placeholder="12 Cloverfield Lane" name="bill_addy1">
						</label>
					</div>
					<div class="small-12 column">
						<label>Billing Street Address Line 2:
							<input type="text" placeholder="12 Cloverfield Lane" name="bill_addy2">
						</label>
					</div>
					<div class="small-12 medium-6 column">
						<label>Billing City:
							<input type="text" name="bill_city" placeholder="Gotham">
						</label>
					</div>
					<div class="small-12 medium-3 column">
						<label>Billing State:
							<input type="text" name="bill_state" placeholder="NH">
						</label>
					</div>	
					<div class="small-12 medium-3 column">
						<label>Billing Zip
:							<input type="text" name="bill_zip" placeholder="03603">
						</label>
					</div>		
					<div class="small-12 medium-6 column">
						<label>Phone Number:
							<input type="text" name="phone" placeholder="603-867-5309">
						</label>
					</div>
					<div class="small-12 medium-6 column">
						<label>Phone Type:
							<select name="phone_type">
								<option value="home">Home</option>
								<option value="mobile">Mobile</option>
								<option value="work">Work</option>
							</select>
						</label>
					</div>			
				</div>
			</div>
			<div class="tabs-panel" id="panel2">
			    <!-- LOCATIONS -->
			    <div class="small-12 column">
			    	<label>
					    <input type="checkbox" checked="checked" name="bill-service" class="revealer-box" data-target="service-address">
					    Use Billing Address as Service Address
					</label>
				</div>
				<div id="service-address" class="hide">
					<div class="small-12 column">
						<label>Service Street Address Line 1:
							<input type="text" placeholder="12 Cloverfield Lane" name="service_addy1">
						</label>
					</div>
					<div class="small-12 column">
						<label>Service Street Address Line 2:
							<input type="text" placeholder="12 Cloverfield Lane" name="service_addy2">
						</label>
					</div>
					<div class="small-12 medium-6 column">
						<label>Service City:
							<input type="text" name="service_city" placeholder="Gotham">
						</label>
					</div>
					<div class="small-12 medium-3 column">
						<label>Service State:
							<input type="text" name="service_state" placeholder="NH">
						</label>
					</div>	
					<div class="small-12 medium-3 column">
						<label>Service Zip
:							<input type="text" name="service_zip" placeholder="03603">
						</label>
					</div>				
				</div><!-- Hidden Section -->
				<div class="small-12 medium-6 large-4 column end">
					<label>Tank Size (in Gallons)
						<input type="number" name="tank_size">
					</label>
				</div>
				<div class="small-12 medium-4 column submit-padding">
					<input type="submit" value="Save It!" class="button">
				</div>
			</div>
		</div>
	</form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>