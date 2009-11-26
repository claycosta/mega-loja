<?php
	global $url_loja, $tool_id, $categories, $busca;
	global $loja, $options;

	#Adicione aqui a sua ID da ferramenta no Mercado Sуcios
	$loja['tool_id'] = "5432563";
  
	//Modifique a linha abaixo para indicar a pбgina inicial da sua loja
	//nгo esqueзa de colocar a / (barra) no final do endereзo
	$loja['url'] = "http://loja.tomatecru.net/";
	
	//Modifique a linha abaixo para indicar o nome da sua loja.
	$loja['nome'] = "Loja Tomate Cru";
	
	//Modifique a linha abaixo para indicar seu nome de usuбrio no Mercado Livre
	$user_id = 'pspawn';
	
	//Modifique a linha abaixo para indicar sua senha XML do mercado livre
	//A loja funciona mesmo se vocк nгo tiver uma senha xml, mas sem ela nгo й possнvel obter
	//mais de 10 produtos a cada busca.
	$loja['senha_xml'] = 'UFNQQVdOUFNQQVdO';
	//A senha XML pode ser obtida no fуrum do Mercado Sуcios, ou enviando uma mensagem diretamente
	//para os responsбveis.

	//Uma descriзгo da loja, que serб usada para informar aos buscadores do que a sua pбgina se trata.
	//Use algumas palavras-chave no meio do texto.
	$loja['descricao'] = "Loja Tomate Cru. De tudo um pouco, mas o preзo й louco.";
	
	//Se o usuбrio acessar a pбgina inicial da loja sem ter buscado por nada, entгo um dos elementos
	//da buscaPadrao serб usado aleatoriamente. 
	//O array pode conter qualquer quantidade de elementos, desde que tenha pelo menos 1 elemento para buscar.
	$options['busca_padrao'] = array("smartphone", "mp3", "mp4", "iphone");
	
	//Quantos resultados vocк quer exibir para cada busca?
	//Note que sу й possнvel obter mais de 10 resultados se vocк possuir uma senha xml (veja acima)
	$options['num_resultados'] = 25;