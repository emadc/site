		<section id="bottom" class="text-center">
			<h2><?php echo $bottom->getTitle();?></h2>
			<p><?php echo $bottom->getText();?></p>
			<?php if (!empty($bottom->getImage())) echo "<a href='".HOST.$bottom->getLink()."'><img alt='Bas de page' src='".UPOLOAD_URL.$bottom->getImage()."'></a>";?>
		</section>			
	</body>
</html>