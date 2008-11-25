<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	/*
	 * TODO coisas ainda a fazer:
	 * - Adicionar links para ordenar por mais visitados, mais baratos, etc
	 * - No <h2> do menu lateral, adicionar uma cor de fundo que seja contrastante, mas não feia
	 *
	 */
	global $url_loja, $tool_id, $nome_loja, $categories, $busca;

	//$tool_id = "5431013";
	$tool_id = "5431013"; //id do 3gamers
	//$url_loja = "http://loja.diasdebeleza.com.br/";
	$url_loja = "http://loja.3gamers.com.br/";
	$nome_loja = "3Gamers";

	$user_id = 'pspawn';
	$senha_xml = 'UFNQQVdOUFNQQVdO';

	$buscaPadrao = array("xbox_360", "wii", "playstation 3", "cabo hdmi");

	include("engine.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<meta name="keywords" content="<?= fromUrl($busca) ?>, videogame, nintendo, sony, microsoft" />
	<meta name="language" content="pt-br" />
	<meta name="description" content="Loja 3Gamers. Vendemos videogames de última geração e acessórios. Resultado da busca por: <?= fromUrl($busca) ?>." />
	<title><?= the_title() ?></title>
	<link type="text/css" rel="stylesheet" href="/loja.css" charset="utf8" />
	<script type="text/javascript">
	function beforeSubmit() {
		formularioBusca = document.formBusca;
		formularioBusca.method = 'POST';
		formularioBusca.busca.value = formularioBusca.busca.value.replace(/ /g,"_");
		formularioBusca.action= '/'+formularioBusca.busca.value+'/ven';
	}
	</script>
</head>

<body>

	<div id="conteiner">
		<div id="banner"><img src="http://www.3gamers.com.br/wp-content/themes/tomodachi/images/logoGrafite.png"/></div>

		<div id="central">
			<div id="recomendados">
				<!-- Inserir código com links recomendados -->
			</div>

			<form action="<?= $url_loja; ?>index.php" name="formBusca" onSubmit="beforeSubmit()">
				<p>
					<label for="busca">O que você procura?</label> <input type="text" tabindex="1" name="busca" id="busca" alt="Busca" accesskey="b" value="<?= fromUrl($busca); ?>"/>
					<input type="submit" id="submit" value="Buscar" tabindex="2" accesskey="e" />
				</p>
			</form>

			<h1><?= the_header(); ?></h1>

			<?= lista_produtos($itens); ?>

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
var pageTracker = _gat._getTracker("UA-4992275-2");
pageTracker._trackPageview();
</script>