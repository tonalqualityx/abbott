<?php
//Install script
// phpinfo();
require_once('head.php');
if($dbfail) {
	$message = "<p>Your database connection has failed. If you haven't already edited config.php you'll need to enter your database information. If you have, then there may be an error.</p>
		<p>Failed to connect to MySQL: ( $mysqli->connect_errno ) $mysqli->connect_error</p>
		<p>If you'd like to hire a developer to help, visit our website <a href='https://becomeindelible.com'>becomeindelible.com</a>";
}
else {
	$message = "Setup has conneceted to the database";
}
$submitted = false;
$go = false;
$setup = false;
if(TableExists($table_prefix . 'users', $mysqli)) {
	$setup = true;
	header( "Location: $base/" ) ;
}
if(isset($_POST['setitup']) && !$setup) {
	$submitted = true;
	$user = htmlspecialchars($_POST['user']);
	$email = htmlspecialchars($_POST['email']);
	$pass = htmlspecialchars($_POST['password']);
	$confirm = htmlspecialchars($_POST['confpass']);
	if($pass === $confirm) {
		$go = true;
		$pass = password_hash($pass, PASSWORD_DEFAULT);//Encrypt the password
		include('setup-sql.php');
	}
	else {
		$go = false;
	}
}

include('header.php'); ?>
<?php if($setup) { ?>
	<div class="row">
		<div class="small-12 column">
			<h3>Setup Complete</h3>
		</div>
		<div class="small-12 column">
			<p>Setup has already been run. Please stop calling here.</p>
			<p>Try starting <a href="/">here</a>. And seriously. Don't come back here anymore.</p>
		</div>
	</div>
<?php } 
else { ?>
	<div class="row">
		<div class="small-12 column">
			<h1>System Setup</h1>
			<p><?php echo $message; ?></p>
		</div>
	</div>
	<div class="row">
		<?php if(!$submitted || ($submitted && !$go)){//If the form hasn't been submitted, or it was submitted but the passwords don't match, show the form! ?>
			<div class="small-12 column">
				<h3>Create Admin User</h3>
			</div>
			<form action="setup.php" method="POST" data-abide>
				<div class="row">
					<div class="small-12 medium-4 column end">
						<label>
							Username:
							<input type="text" name="user" <?php if(isset($user)) {echo "value='$user' ";} ?> placeholder="imauser" required />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 column end">
						<label>
							Email:
							<input type="email" name="email" <?php if(isset($email)) {echo "value='$email' ";} ?> placeholder="you@email.com" required />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 column end">
						<label>
							Password:
							<input type="password" name="password" id="password" placeholder="yeti4preZ" required/>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 column end">
						<label>Re-enter Password
					        <input type="password" placeholder="yeti4preZ" name="confpass" id="confpass" data-equalto="password">
					        <span class="form-error">
					          Hey, passwords are supposed to match!
					        </span>
					    </label>
					</div>
				</div>
				<div class="row">
					<input type="submit" name="setitup">
				</div
			</form>
		<?php }
		if($go) {
			if(!$errors) {
				echo "<div class='small-12 column'><p>Everything appears to have gone swimmingly.</p></div>";
			}
			else {
				echo "<div class='small-12 column'><p>$errors</p></div>";
			}
		} ?>
	</div>
<?php } ?>