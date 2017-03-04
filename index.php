<?php //The home page
require('header.php'); ?>
<script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(last, addy){
 
                      var title=last;
                     $.ajax({
                        type:"post",
                        url:"search.php",
                        data:{last: last, addy: addy},
                        success:function(data){
                            $("#result").html(data);
                            // $("#last").val("");
                         }
                      });  
                 }
 
                  $("#button").click(function(event){
                  	 event.preventDefault();
                  	 var last = $('#last').val();
                  	 var addy = $('#addy').val();
                  	 search(last, addy);
                  });
 
                  $('#last, #addy').keyup(function(e) {
                  	var last = $('#last').val();
                  	var addy = $('#addy').val();
                  	if(last != '' || addy != '') {
	                    search(last, addy);
	                }
                  });
            });
        </script>
<div class="row">
	<div class="small-12  column">
		<h3>Search Accounts</h3>
		<div class="row">
			<form method="POST">
				<div class="small-12 medium-6 large-4 column">
					<label>
						Last Name:
						<input type="text" placeholder="Scooterbella" name="last" id="last" tabindex="1"/>
          </label>
        </div>
        <div class="small-12 medium-6 large-4 column end">
          <label>
            Street Address:
            <input type="text" placeholder="123 Not Your House Lane" name="addy" id="addy" tabindex="2" />
          </label>
        </div>
        <div class="small-12 column">
						<input type="submit" class="button" value="search" id="button" tabindex="3"/>
						<a class="button" data-open="newCustomer" tabindex="4">Add New</a>
        </div>

			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="small-12 column" id="result">

	</div>
</div>

<?php 
include('modals.php');
require('footer.php'); ?>