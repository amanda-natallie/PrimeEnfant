<?php function dataPadraoBrasileiro($data){
	$data = explode("-", $data);
	return $data[2]."/".$data[1]."/".$data[0];
}

function dataPadraoBanco($data){
	$data = explode("/", $data);
	return $data[2]."-".$data[1]."-".$data[0];
}

function dataContarDias($data, $dias){
    return date('Y-m-d', strtotime($data . '+'.$dias.' days'));
}

function DataAnoMesDia($data){
 
    $date = implode("/",array_reverse(explode("/",$data)));
    $date = date('Y/m/d', strtotime($date));
    return $date;
}
