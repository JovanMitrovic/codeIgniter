<div class="row">
	<div class="col-md-12" style="padding-top: 60px;">
		<table width="100%">
			<?php if (is_array($articles) && (count($articles) > 0)) { foreach ($articles as $article) {?>
				<tr style="border-bottom: 1px solid #000000;">
					<?php
					if ($isUserLogged)
					{
					?>
						<td width="95%" style="font-size: 25px; height: 60px;">
							<?php echo $article->title?>
						</td>
						<td width="5%">
							<a href="<?php echo base_url() . 'index.php/article/edit/' . $article->id?>" >
								<img src="<?php echo base_url() . 'assets/img/edit-action.png';?>" height="20" >
							</a>
							<a href="<?php echo base_url() . 'index.php/article/delete/' . $article->id?>">
								<img src="<?php echo base_url() . 'assets/img/delete-action.png';?>" height="20" >
							</a>
						</td>
					<?php
					}
					else
					{
					?>
						<td width="90%" style="font-size: 25px; height: 60px;">
							<?php echo $article->title?>
						</td>
						<td width="10%">
							<a style="color: #FF7F00; font-size: 18px; float: right" href="<?php echo base_url() . 'index.php/article/view/' . $article->id?>">Pogledaj Više</a>
						</td>
					<?php
					}
					?>
				</tr>
			<?php } } else { ?>
				<tr>
					<td colspan="5">Nema Članaka</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div class="paging">
	<ul class="pagination">
		<?php
		echo $pagelinks;
		?>
	</ul>
</div>
