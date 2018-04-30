<?php var_dump($_SESSION); ?>
<?php if((int)$_SESSION['attempts'] < 3) { ?>
	<h2>Login</h2>
	<form action="<?php echo $host;?>/scripts/users.php" method="post">
		<?php
			if (strpos($_SESSION["msg"], '#loginemail#') !== false) {
	    		echo '<p>Email is empty</p>';
			}
			$_SESSION['msg'] = str_replace('#loginemail#', '', $_SESSION['msg']);
		?>
		<input type="email" name="email" placeholder="email here." ><br>
			<?php
				if (strpos($_SESSION["msg"], '#loginpassword#') !== false) {
	    			echo '<p>Password is empty</p>';
				}
				$_SESSION['msg'] = str_replace('#loginpassword#', '', $_SESSION['msg']);
		 	?>
		<input type="password" name="password" placeholder="password here." ><br>
		<input type="hidden" name="user_module" value="login">
		<input type="submit" name="submit">
	</form>
<?php } ?>