<?php
	global $url_loja, $tool_id, $categories, $busca;
	global $loja, $options;

	#Adicione aqui a sua ID da ferramenta no Mercado S�cios
	$loja['tool_id'] = "5432563";
  
	//Modifique a linha abaixo para indicar a p�gina inicial da sua loja
	//n�o esque�a de colocar a / (barra) no final do endere�o
	$loja['url'] = "http://loja.tomatecru.net/";
	
	//Modifique a linha abaixo para indicar o nome da sua loja.
	$loja['nome'] = "Loja Tomate Cru";
	
	//Modifique a linha abaixo para indicar seu nome de usu�rio no Mercado Livre
	$user_id = 'pspawn';
	
	//Modifique a linha abaixo para indicar sua senha XML do mercado livre
	//A loja funciona mesmo se voc� n�o tiver uma senha xml, mas sem ela n�o � poss�vel obter
	//mais de 10 produtos a cada busca.
	$loja['senha_xml'] = 'UFNQQVdOUFNQQVdO';
	//A senha XML pode ser obtida no f�rum do Mercado S�cios, ou enviando uma mensagem diretamente
	//para os respons�veis.

	//Uma descri��o da loja, que ser� usada para informar aos buscadores do que a sua p�gina se trata.
	//Use algumas palavras-chave no meio do texto.
	$loja['descricao'] = "Loja Tomate Cru. De tudo um pouco, mas o pre�o � louco.";
	
	//Se o usu�rio acessar a p�gina inicial da loja sem ter buscado por nada, ent�o um dos elementos
	//da buscaPadrao ser� usado aleatoriamente. 
	//O array pode conter qualquer quantidade de elementos, desde que tenha pelo menos 1 elemento para buscar.
	$options['busca_padrao'] = array("smartphone", "mp3", "mp4", "iphone");
	
	//Quantos resultados voc� quer exibir para cada busca?
	//Note que s� � poss�vel obter mais de 10 resultados se voc� possuir uma senha xml (veja acima)
	$options['num_resultados'] = 25;