<section id="welcame" class="col-12">
	<div class="text-center align-middle">
		<h1><?php echo $welcame->getTitle();?></h1>
		<p><?php echo $welcame->getText();?></p>
		<?php if (!empty($welcame->getImage())) echo "<a href='".HOST.$welcame->getLink()."'><img alt='welcame' src='".UPOLOAD_URL.$welcame->getImage()."'></a>";?>
	</div>
</section>
<section id="services" class="col-12">
	<div class="row">
		<?php foreach ($services AS $service):?>
			<div class="text-center col-xl-4 col-md-6 col-12">
				<img alt="<?php echo $service->getTitle();?>" src="<?php echo UPOLOAD_URL.'services/'.$service->getImage();?>" />
				<h3><?php echo $service->getTitle();?></h3>
				<p><?php echo $service->getText();?></p>
			</div>
		<?php endforeach;?>
	</div>
</section>