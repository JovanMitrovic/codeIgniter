<!DOCTYPE html>
<html>
<head>
	<title>Add Article</title>
	<link rel="stylesheet" type"text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css';?>">
	<link rel="stylesheet" type"text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
	<script type="text/javascript" src="<?php echo base_url() . '/tinymce/asset/tinymce/js/tinymce/tinymce.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . '/tinymce/asset/tinymce/js/tinymce/init-tinymce.js' ?>"></script>
</head>
<body>
	<div class="container" style="margin-top: 50px;">
		<form method="post" name="add_article" enctype="multipart/form-data" action="<?php echo base_url() . 'index.php/article/addfinish';?>">
			<div class="row" style="width: 1700px;">
				<div class="col-md-6">
					<div class="form-group">
						<label>Naslov: </label>
						<input type="text" name="title" value="<?php echo set_value('title');?>" class="form-control">
						<?php echo form_error('title');?>
					</div>
					<div class="form-group">
						<label>Tekst: </label>
						<textarea id="description" type="text" name="description" value="<?php echo set_value('description');?>" class="form-control"></textarea>
						<?php echo form_error('description');?>
					</div>
					<div class="row">
						<div class="col-6">
							<div>
								<label>Dodaj sliku: </label>
								<input type="file" name="file_upload[]" multiple="" />
							</div>
						</div>
						<div class="col-6">
							<div style="float:right">
								<a style="text-decoration: none;" href="<?php echo base_url() . 'index.php/article/index'?>">
									<div class="button">Otkaži</div>
								</a>
								<button class="button">
									Dodaj Članak
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
