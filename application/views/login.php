<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type"text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
</head>
<body>
	<div class="container">
		<br /><br /><br />
		<form method="post" action="<?php echo base_url(); ?>user/loginvalidation">
			<table class="login-table">
				<tr>
					<td class="login-text" >Email: </td>
					<td>
						<input type="text" name="email" class="form-control" style="width: 500px;" value="<?php echo set_value('email'); ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span class="text-danger"><?php echo form_error('email'); ?></span>
					</td>
				</tr>
				<tr>
					<td class="login-text">Lozinka: </td>
					<td>
						<input type="password" name="password" class="form-control">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span class="text-danger"><?php echo form_error('password'); ?></span>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td style="float: right; margin-top: 15px;">
						<input type="submit" name="submit" value="Pristupi" class="button">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
<style>

</style>
