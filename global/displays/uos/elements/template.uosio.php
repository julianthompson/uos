<?php 
$display = isset($uos->request->parameters['display'])?$uos->request->parameters['display']:'html';
$content = rendernew($entity,array('displaystring'=>$display));
$elementdata = isset($uos->output['elementdata'])?$uos->output['elementdata']:array();
print json_encode( (object) array(
	'content'=>$content,
	'elementdata'=>$elementdata,
	'elementcount'=>count($elementdata),
	'resources'=>$uos->output['resources']
));
?>