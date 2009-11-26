<?php
	global $url_loja, $tool_id, $categories, $busca;
	global $loja;

	#Adicione aqui a sua ID da ferramenta no Mercado Sócios
	$tool_id = "5432563";
  
	//Modifique a linha abaixo para indicar a página inicial da sua loja
	//não esqueça de colocar a / (barra) no final do endereço
	$loja['url'] = "http://loja.tomatecru.net/";
	
	//Modifique a linha abaixo para indicar o nome da sua loja.
	$loja['nome'] = "Loja Tomate Cru";
	
	//Modifique a linha abaixo para indicar seu nome de usuário no Mercado Livre
	$user_id = 'pspawn';
	
	//Modifique a linha abaixo para indicar sua senha XML do mercado livre
	//A loja funciona mesmo se você não tiver uma senha xml, mas sem ela não é possível obter
	//mais de 10 produtos a cada busca.
	$senha_xml = 'UFNQQVdOUFNQQVdO';
	//A senha XML pode ser obtida no fórum do Mercado Sócios, ou enviando uma mensagem diretamente
	//para os responsáveis.

	//Uma descrição da loja, que será usada para informar aos buscadores do que a sua página se trata.
	//Use algumas palavras-chave no meio do texto.
	$loja['descricao'] = "Loja Tomate Cru. De tudo um pouco, mas o preço é louco.";
	
	//Se o usuário acessar a página inicial da loja sem ter buscado por nada, então um dos elementos
	//da buscaPadrao será usado aleatoriamente. 
	//O array pode conter qualquer quantidade de elementos, desde que tenha pelo menos 1 elemento para buscar.
	$buscaPadrao = array("smartphone", "mp3", "mp4", "iphone");