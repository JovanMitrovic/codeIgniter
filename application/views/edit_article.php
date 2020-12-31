<!DOCTYPE html>
<html>
<head>
	<title>Edit Article</title>
	<link rel="stylesheet" type"text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css';?>">
	<link rel="stylesheet" type"text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
	<script type="text/javascript" src="<?php echo base_url() . '/tinymce/asset/tinymce/js/tinymce/tinymce.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . '/tinymce/asset/tinymce/js/tinymce/init-tinymce.js' ?>"></script>
</head>
<body>
<div class="container" style="margin-top: 50px;">
	<form method="post" name="edit_article" enctype="multipart/form-data" action="<?php echo base_url() . 'index.php/article/editfinish/' . $article['id'];?>">
		<div class="row" style="width: 1800px;">
			<div class="col-md-6">
				<div class="form-group">
					<label>Naslov: </label>
					<input type="text" name="title" value="<?php echo set_value('title', $article['title']);?>" class="form-control">
					<?php echo form_error('title');?>
				</div>
				<div class="form-group">
					<label>Tekst: </label>
					<input id="description" type="text" name="description" value="<?php echo set_value('description', $article['description']);?>" class="form-control">
					<?php echo form_error('description');?>
				</div>
				<div class="row">
					<div class="col-8">
						<div class="form-inline" style="height: 40px;">
							<label style="margin-right: 10px;">Dodaj sliku: </label>
							<div style="border: 0.5px ridge #000000; height: 100%;">
								<input style="padding: 8px" type="file" name="file_upload[]" multiple="" />
							</div>
						</div>
					</div>
					<div class="col-4">
						<div style="float: right">
							<div class="form-group" style="padding: 4px 0px;">
								<a style="text-decoration: none;" href="<?php echo base_url() . 'index.php/article/index'?>">
									<div class="button">Otkaži</div>
								</a>
								<button class="button">Edituj Članak</button>
							</div>
						</div>
					</div>
				</div>

					<?php
					if (is_array($articleImages) && (count($articleImages) > 0))
					{
						foreach ($articleImages as $articleImage)
						{
							echo '<div style="float:left">';
							echo '<div class="action-icon">';
							echo img(array(
									'src' => 'uploads/' . $articleImage['name'],
									'width' => '150',
									'height' => '150',
							));
							echo '<div class="form-group">';
							echo '<a href=';
							echo base_url() . 'index.php/image/deleteImage/' . $article['id'] . '?intImageID=' . $articleImage['id'];
							echo '><div style="margin-top:10px;" class="button">Obriši</div></a>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
					}
					?>

			</div>
		</div>
	</form>
</div>
</body>
</html>
