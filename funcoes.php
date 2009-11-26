<?php
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
  return '<meta name="keywords" content="' . keywords($extra_keywords) . '"/>';
}

function titulo() {
	global $loja, $busca;
	$titulo = sanitize(fromUrl($busca)) . " - " . $loja['nome'];
	return $titulo;
}

function tag_titulo() {
  return "<title>" . titulo() . "</title>";
}

