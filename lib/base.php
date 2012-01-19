<?php
	include_once('config.php');
	$frase = $_GET['frase'];
	$ordenacao = $_GET['ordenacao'];
	$categoria = $_GET['categoria'];
	$preco = $_GET['preco'];
	list($preco_min, $preco_max) = explode(':', $preco);
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		loja = new Loja('<?= $user_id ?>', '<?= $senha_xml ?>', '<?= $tool_id ?>');
		loja.buscar('<?= $frase ?>');
	});
</script>
