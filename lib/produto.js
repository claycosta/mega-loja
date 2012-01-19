var Produto = function(itemXml) {
	itemXml = $(itemXml);
	
  //Pega as informações de produto do xml e coloca em propriedades da classe
	this.titulo = itemXml.find('title').text();
	this.subtitulo = itemXml.find('subtitle').text();
	this.link = itemXml.find('link').text().replace('tool=XXX', 'tool='+loja.tool_id);
	this.imagem = itemXml.find('image_url').text().replace(/jm\/img\?s=/, 's_').replace('&v=b', '').replace('&f=', '_v_O_f_');
	this.preco = itemXml.find('price').text();
	this.precoFormatado = "R$ " + this.preco;
	this.lances = itemXml.find('bids').text();
	this.visitas = itemXml.find('hits').text();
	this.dataTermino = new Date(itemXml.find('auct_end').text());
	this.temFoto = (itemXml.find('photo').text() == 'Y') ? true : false;

  //O template do html com o produto
	this.TEMPLATE = "<div class=\"produto\"><a href=\"{{link}}\"><img src={{imagem}} alt={{titulo}}><p>{{titulo}}</p><span>{{precoFormatado}}</span></a></div>";

  this.toHtml = function() {
    return Mustache.to_html(this.TEMPLATE, this);
  };
};