<div>

	<?php if (!empty($mensaje)) print_r($mensaje); ?>

	<div>Al hacer click limpiarás la base de datos y la prepararás para el año siguiente</div>
	
	<button id='resetear'> RESETEAR </button>

	ESCONDER CON CSS
	<form action='/taquillas/manager/resetear' method='post'>
	<button id='confirmar_reseteo' type='submit' name='confirmar_reseteo'> CONFIRMAR </button>
</div>