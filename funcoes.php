<?php
function busca() {
  global $busca;
  return $busca;
}

function keywords($extra_keywords = null) {
  $the_keywords = fromUrl($busca);
  
  if (is_array($extra_keywords)) {
    foreach ($extra_keywords as $keyword) {
      $the_keywords .= ",$keyword";
    }
  } else {
    $the_keywords .= ",$extra_keywords";
  }
  
  return $the_keywords;
}

function tag_keywords($extra_keywords = null) {
  return '<meta name="keywords" content="' . keywords($extra_keywords) . '"/>' . "\n";
}

function titulo() {
	global $loja;
	$titulo = sanitize(fromUrl(busca())) . " - " . $loja['nome'];
	return $titulo;
}

function tag_titulo() {
  return "<title>" . titulo() . "</title>" . "\n";
}

function descricao() {
  global $loja, $busca;
  return $loja['descricao'] . ". Resultado da busca por: " . $busca['busca'];
}

function tag_descricao() {
  return '<meta name="description" content="' . descricao() .'" />' . "\n";
}

function includes() {
  $head = '<link type="text/css" rel="stylesheet" href="/loja.css" charset="utf8" />' . "\n";
  $head .= '<script type="text/javascript" src="./mega-loja.js"></script>' . "\n";
  return $head;
}

function tag_language() {
  return '<meta name="language" content="pt-br" />' . "\n";
}

function tag_content_type() {
  return '<meta http-equiv="Content-type" content="text/html;charset=utf-8" />' . "\n";
}

function head() {
  return tag_content_type() . tag_keywords() .	tag_language() . tag_descricao() . tag_titulo() .	includes();
}

function texto($texto = null) {
	if ($texto == null) {
    switch(busca()) {
  	  default:
  	    $texto = 'default.txt';
  	    break;
  	}
  }
	
  return file_get_contents("$texto.txt");
}

function busca_aleatoria() {
  global $options;
  return $options['busca_padrao'][array_rand($options['busca_padrao'])];
}

/** Funções para o form de busca **/
function form_url() {
  global $loja;
  return $loja['url'];
}

function form_busca($label = "O que você procura?") {
  global $busca;
  return '<form action="'.form_url().'index.php" name="formBusca">
		<p>
			<label for="busca">$label</label>
			<input type="text" tabindex="1" name="busca" id="busca" alt="Busca" accesskey="b" value="'.$busca['busca'].'"/>
			<input type="submit" id="submit" value="Buscar" tabindex="2" accesskey="e" />
		</p>
	</form>';
}

//Gera uma tabela, com os produtos encontrados na busca
function lista_produtos($itens) {
	global $loja, $busca;

	$retorno = '<table id="listagemProdutos"><tr>';
	$contador = 0;
	
	foreach($itens as $item) {
		if($contador > 0 && $contador % 4 == 0) {
		  $retorno .= "</tr><tr>"; 
	  }
		$contador++;
		
		$title = $item->title;
		$link = $item->link;
		$image_url = sanitize($item->image_url);
		$price = $item->currency . $item->price;
		$link = str_ireplace("tool=XXX","tool=".$loja['tool_id'], $link);
		$link = sanitize($link);

		$retorno .= "<td>
			<a href=\"$link\">
				<img src=\"$image_url\" alt=\"".sanitize($title)." - ".busca()."\" width=\"90\"
					height=\"90\" /> <br />
				<span class=\"tituloProduto\">".sanitize($title)."</span> <br />
				<span class=\"preco\">$price</span>
			</a>
		</td>";
	}
	$retorno .= "</tr></table>";
	
	return $retorno;
}