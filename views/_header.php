<div class="collapse navbar-collapse" id="navbarCollapse">
	<ul class="navbar-nav ml-auto">
    <?php foreach ($menu as $itemMenu):?>
    	<li class="nav-item <?php echo $template==$itemMenu->getItemLink()?'active':''?>">
        	<a class="nav-link" href="<?php echo $itemMenu->getItemLink();?>">
        		<?php echo $itemMenu->getItemText();?>
        	</a>
		</li>
    <?php endforeach;?>
	</ul>
</div>
