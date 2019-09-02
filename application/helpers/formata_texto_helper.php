<?php 
function formatar_texto($texto){
	/*
	- limpa acentos e transforma em letra normal
	- limpa cedilha e transforma em c normal, o mesmo com o ñ
	- transforma espaços em hifen (-)
	- tira caracteres invalidos
	by Micox - elmicox.blogspot.com - www.ievolutionweb.com
	*/
	//desconvertendo do padrão entitie (tipo á para á)
	$texto = trim(html_entity_decode($texto));
	//tirando os acentos
	$texto= preg_replace('![áàãâä]+!u','a',$texto);
	$texto= preg_replace('![éèêë]+!u','e',$texto);
	$texto= preg_replace('![íìîï]+!u','i',$texto);
	$texto= preg_replace('![óòõôö]+!u','o',$texto);
	$texto= preg_replace('![úùûü]+!u','u',$texto);
	//parte que tira o cedilha e o ñ
	$texto= preg_replace('![ç]+!u','c',$texto);
	$texto= preg_replace('![ñ]+!u','n',$texto);
	//tirando outros caracteres invalidos
	$texto= preg_replace('[^a-z0-9\-]','-',$texto);
	//tirando espaços
	$texto = str_replace(' ','-',$texto);
	//trocando duplo espaço (hifen) por 1 hifen só
	$texto = str_replace('--','-',$texto);

	return strtolower($texto);
}

?>