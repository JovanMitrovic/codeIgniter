<!DOCTYPE html>
<html>
<head>
	<title>View Article</title>
	<link rel="stylesheet" type"text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css';?>">
	<link rel="stylesheet" type"text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
</head>
<body>
<div class="container" style="margin-top: 50px;">
		<div class="row" style="width: 1800px;">
			<div class="col-md-6">
				<div class="row" style="float: right;">
					<a style="text-decoration: underline; color: #FF7F00;font-size: 20px;" href="<?php echo base_url() . '/article/index' ?>">VRATI SE NA LISTU ČLANAKA</a>
				</div>
				<div class="form-group">
					<h1 style="margin: 10px;">
						<?php echo $article['title'];?>
					</h1>
				</div>
				<div class="form-group">
					<div id="description" style="margin: 10px;">
						<?php echo $article['description'];?>
					</div>
				</div>

				<?php
				if (is_array($articleImages) && (count($articleImages) > 0))
				{
					foreach ($articleImages as $articleImage)
					{
						echo '<div style="float:left; padding: 10px;">';
						echo img(array(
							'src' => 'uploads/' . $articleImage['name'],
							'width' => '410',
							'height' => '400',
						));
						echo '</div>';
					}
				}
				?>

			</div>
		</div>
</div>
</body>
</html>
