<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require_once("main.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
	<?= head() ?>
	<script type="text/javascript">
	function beforeSubmit() {
		formularioBusca = document.formBusca;
		formularioBusca.method = 'POST';
		formularioBusca.busca.value = formularioBusca.busca.value.replace(/ /g,"_");
		formularioBusca.action= '/'+formularioBusca.busca.value+'/vis';
	}
	</script>
</head>

<body>
	<div id="conteiner">
		<div id="banner"><img src="http://loja.tomatecru.net/img/bannerlogo.png"/></div>

		<div id="central">
			<div id="recomendados">
				<!-- Inserir código com links recomendados -->
			</div>

			<?= form_busca() ?>

			<h1><?= busca() ?></h1>

			<?= lista_produtos($resultado['itens']); ?>

			<p id="categorias"><?= lista_categorias($categories) ?></p>

		</div>
	</div>

</body>
</html>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4992275-1");
pageTracker._trackPageview();
</script>

