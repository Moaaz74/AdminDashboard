<main>
<p class="path" >
	Dashboard 
	<?php if(isset($this->_data['Controller'])):?>
		<?= ' >> ' . $this->_data['Controller'] ?> 
	<?php endif; ?>
	<?php if(isset($this->_data['Action'])):?>
		<?= ' >> ' . $this->_data['Action'] ?>
	<?php endif; ?>

</p>
					
