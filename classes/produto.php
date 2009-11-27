<?php
class Produto {
  public $nome, $link, $imagem, $preco;
  public $loja;
  
  function __construct($produto_xml, &$loja) {
    $this->loja = $loja;
    $this->nome = sanitize($produto_xml->title);
		$this->link = str_ireplace("tool=XXX","tool=".$this->loja->tool_id, $produto_xml->link);
		$this->link = $loja->sanitize($this->link);
		$this->imagem = $loja->sanitize($produto_xml->image_url);
		$this->prico = $produto_xml->currency . $produto_xml->price;
  }
}