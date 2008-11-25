<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	/*
	 * TODO coisas ainda a fazer:
	 * - Adicionar links para ordenar por mais visitados, mais baratos, etc
	 * - No <h2> do menu lateral, adicionar uma cor de fundo que seja contrastante, mas não feia
	 *
	 */
	global $url_loja, $tool_id, $nome_loja, $categories, $busca;

	//Adicione aqui a sua ID da ferramenta no Mercado Sócios
	$tool_id = "5432563"; 
	
	//Modifique a linha abaixo para indicar a página inicial da sua loja
	//não esqueça de colocar a / (barra) no final do endereço
	$url_loja = "http://loja.tomatecru.net/";
	
	//Modifique a linha abaixo para indicar o nome da sua loja.
	$nome_loja = "Loja Tomate Cru";

	//Modifique a linha abaixo para indicar seu nome de usuário no Mercado Livre
	$user_id = 'pspawn';
	
	//Modifique a linha abaixo para indicar sua senha XML do mercado livre
	//A loja funciona mesmo se você não tiver uma senha xml, mas sem ela não é possível obter
	//mais de 10 produtos a cada busca.
	$senha_xml = 'XXXXXXXXXXXXXXXXX';
	//A senha XML pode ser obtida no fórum do Mercado Sócios, ou enviando uma mensagem diretamente
	//para os responsáveis.

	//Uma descrição da loja, que será usada para informar aos buscadores do que a sua página se trata.
	//Use algumas palavras-chave no meio do texto.
	$descricao_loja = "Loja Tomate Cru. De tudo um pouco, mas o preço é louco.";
	
	//Se o usuário acessar a página inicial da loja sem ter buscado por nada, então um dos elementos 
	//da buscaPadrao será usado aleatoriamente. O array pode conter qualquer quantidade de elementos, 
	//desde que tenha pelo menos 1 elemento para buscar.
	$buscaPadrao = array("smartphone", "mp3", "mp4", "iphone");

	
	//NÃO EDITE NADA A PARTIR DESSA LINHA, A MENOS QUE SAIBA O QUE ESTÁ FAZENDO
	include("engine.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<meta name="keywords" content="<?= fromUrl($busca) ?>" />
	<meta name="language" content="pt-br" />
	<meta name="description" content="<?= $descricao_loja ?> Resultado da busca por: <?= fromUrl($busca) ?>." />
	<title><?= the_title() ?></title>
	<link type="text/css" rel="stylesheet" href="/loja.css" charset="utf8" />
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
var pageTracker = _gat._getTracker("UA-4992275-1");
pageTracker._trackPageview();
</script>