<div id='control-container'>
	<div id='prev'></div>
	<div id='next'></div>
	<div id='slider-container'>
		<div id='slider'>
			<div class='slide'>
				<?php echo $this->Html->image('home-slide.jpg');?>
				<div class='slide-text'>
					<?php echo $this->Html->link('CLICK TO GET STARTED', array('controller' => 'Users', 'action' => 'register'), array('class' => 'button green-grad bold'));?>
					<p>Click to Get Started with RentSquare Now and Other Text to Fill the Bar</p>
				</div>
			</div>
			<div class='slide'>
				<?php echo $this->Html->image('home-slide.jpg');?>
				<div class='slide-text'>
					<a class='button green-grad'>CLICK TO GET STARTED</a>
					<p>Click to Get Started with RentSquare Now and Other Text to Fill the Bar</p>
				</div>
			</div>
			<div class='slide'>
				<?php echo $this->Html->image('home-slide.jpg');?>
				<div class='slide-text'>
					<a class='button green-grad'>CLICK TO GET STARTED</a>
					<p>Click to Get Started with RentSquare Now and Other Text to Fill the Bar</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div>
	<?php 
		echo $this->Html->Link("<h2>Tools for Property Managers</h2>" . $this->Html->image('pie.png') . "<p>Collect rent online, view rent rolls, create reports, process work orders, communicate with tenants, and more...</p>", array('controller' => 'Pages', 'action' => 'propmngr'), array('class' => 'home-box', 'escape' => false)); 

		echo $this->Html->Link("<h2>Tools for Residents</h2>" . $this->Html->image('phone.png') . "<p>Pay rent online, submit maintenance requests, communicate with property manager, and more...</p>", array('controller' => 'Pages', 'action' => 'residents'), array('class' => 'home-box', 'escape' => false));

		echo $this->Html->Link("<h2>Watch the Video</h2>" . $this->Html->image('imac.png') . "<p>Landlord? Tenant? Watch how RentSquare can help you bridge the gap.</p>", array('controller' => '', 'action' => ''), array('class' => 'home-box last', 'escape' => false));
	?>
	<div class='clear'></div>
</div>
