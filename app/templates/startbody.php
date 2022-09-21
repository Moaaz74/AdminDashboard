<main>
<h1 class="title">
	<?php if($GLOBALS['home'] !== 'notFoundController' && $GLOBALS['action'] !== 'notFoundAction') :?>
	<a href="/">Dashboard</a> 
	<?php if($GLOBALS['home'] !== 'index'): ?>
	<a href="<?php echo '/' . $GLOBALS['home'] ?>"><?= ' / ' . ucfirst($GLOBALS['home']) ?></a>
	<?php endif ?>
	<?php if($GLOBALS['action'] !== 'default'): ?>
	<a href="/<?= $GLOBALS['home']?>/<?= $GLOBALS['action']?> "><?= ' / ' . ucfirst($GLOBALS['action']) ?></a>
	<?php endif ?>
	<?php endif ?>
</h1>
					
