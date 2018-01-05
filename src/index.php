<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PROJETO RH</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<pre>
<?php
	require_once 'constantes_pts.php';
	require_once 'requisitos.php';	
	require_once 'pegar_curriculo.php';
	require_once 'preparar_curriculo.php';
	require_once 'check_match.php';

	$curriculo = pegar_curriculo();
	preparar_curriculo($curriculo);

	// ===== TESTES ===================== TESTES ============================= TESTES =======
	
	

	$combinacoes = check_match($requisitos, $curriculo);

	print_r($combinacoes);
?>
</pre>
</body>
</html>