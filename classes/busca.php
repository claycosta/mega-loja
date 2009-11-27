<?php
class Busca {
  public $itens = null;
  public $categorias = null;
  public $url_busca = null;
  public $busca = array();
  
  public function __construct(&$loja) {
    $this->loja = $loja;
    $this->busca = $this;
    
    $this->busca['busca'] = $this->from_url($_GET['busca']);
    $this->busca['ordenar'] = $_GET['ordenar'];
    $this->busca['categoria'] = $_GET['categoria'];
    $this->busca['preco'] = $_GET['preco'];
  }
  
  //Gera a url de busca no Mercado Livre
  public function gera_url() {
    $url_busca = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&user=" . $this->loja->user_id;
    $url_busca .= "&pwd=" . $this->loja->senha_xml;
    $url_busca .= "&as_qshow=20&charset=UTF-8";
    
    if ($this->busca['busca'] != "" && $this->busca['busca'] !== 0)
      $url_busca .= "&as_word=" . to_url($this->busca['busca']);
    
    if ($this->busca['categoria'] && $this->busca['categoria'] !== 0)
      $url_busca .= "&as_categ_id=" . $this->busca['categoria'];
    
    if ($this->busca['ordenar'] && $this->busca['ordenar'] !== 0)
      $url_busca .= "&as_order_id=" . ordenar($this->busca['ordenar']);
    
    if ($this->busca['preco']) {
      list($preco_min, $preco_max) = explode(":", $this->busca['preco']);
      if (!empty($preco_min) && $preco_min !== 0)
        $url_busca .= "&as_price_min=" . $preco_min;
      if ($preco_max != "" && $preco_min !== 0)
        $url_busca .= "&as_price_max=" . $preco_max;
    }
    
    $this->url_busca = $url_busca;
    return $this;
  }
  
  //Acessa o mercado livre e busca os produtos e suas categorias
  public function busca_produtos() {
    //Se você não chamou gera_url() antes, ele chama pra você
    if ($this->url_busca == null)) {
      $this->gera_url();
    }
    
    $handler = fopen($url_busca, 'r');
    $resultado_busca = stream_get_contents($handler);
    fclose($handler);
    
    $xml = simplexml_load_string($resultado_busca);
    $itens = $xml->listing->items->children();
    $categorias = $xml->listing->result_categories->children();
    
    $this->itens = $itens;
    $this->categorias = $categorias;
    
    return $this;
  }
  
  protected function from_url($string) {
    $string = str_replace("+", " ", $string);
    $string = str_replace("_", " ", $string);
    $string = str_replace("%20", " ", $string);
    return $string;
  }
  
  protected function to_url($string) {
    $string = str_replace("%20", "+", $string);
    $string = str_replace(" ", "+", $string);
    $string = str_replace("_", "+", $string);
    return $string;
  }
  
  protected function ordenacao($string) {
    switch($string) {
      case "des":  //É o padrão do mercado livre, ordena pelos produtos com destaque
        return "";
  
      case "ven":  //Ordena pelos mais VENdidos
        return "MAS_OFERTADOS";
  
      case "vis":  //Ordena pelos mais VISitados
        return "HIT_PAGE";
  
  /*
        case "bus":  //Ordena pelos mais BUScados
        return "";
  */
  
      case "bar":  //Ordena pelos mais BARatos
        return "BARATOS";
  
      case "alfa": //Ordena por ordem ALFAbética
        return "ITEM_TITLE";
  
      case "car":  //Ordena pelos mais CARos
        return "CAROS";
  
      case "tempo": //Ordena pelo tempo restante do anúncio
        return "AUCTION_STOP";
    }
}