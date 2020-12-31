<!DOCTYPE html>
<html>
<head>
	<title>View Articles</title>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			crossorigin="anonymous"></script>
	<link rel="stylesheet" type"text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css';?>">
	<link rel="stylesheet" type"text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container" style="padding-top: 50px;">

	<?php if ($isUserLogged)
	{
	?>
		<div class="row">
			<div class="col-6">
				<h2 style="color:#FF7F00">Dobrodošao <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>, </h2>
			</div>
			<div class="col-6">
				<a href="<?php echo base_url() . 'index.php/article/add'; ?>" style="float:right">
					<div class="button">Dodaj novi članak</div>
				</a>
			</div>
		</div>
	<?php
		}
	?>
	<div id="article-list">

	</div>
</div>
<script>

	ajaxArticleList(pageURL = false);

	$(document).on('click', ".pagination li a", function(event)
	{
		var pageURL = $(this).attr('href');
		ajaxArticleList(pageURL);

		event.preventDefault();
	});

	function ajaxArticleList(pageURL = false)
	{
		var baseURL = "<?php echo site_url('article/indexajax') ?>";

		if (pageURL == false)
		{
			pageURL = baseURL;
		}

		$.ajax({
			type: "POST",
			url: pageURL,
			data: "",
			success: function (response)
			{
				$("#article-list").html(response);
			}
		});
	}
</script>
</body>
</html>
