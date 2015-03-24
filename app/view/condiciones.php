<div>

	<div id='condis'>
	blabla
	</div>

	<div id='botón'>
		
	<?php if($_SESSION['user'].rol<50){ ?>
		<a href='/taquillas/usario'> Acepto </a>
	<?php } else { ?>
		<a href='/taquillas/admin'> Acepto </a>
	<?php } ?>

	</div>
</div>