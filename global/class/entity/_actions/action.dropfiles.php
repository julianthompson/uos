<?php

addoutput('content/', 'ARSE');
return;

//$tagentityids = $universe->guid_to_id(array($uos->request->parameters['target']));
//$this->children[] = print_r($uos->request->filesd,TRUE);

//foreach($uos->request->files as $file) {

//	$this->children[] = fetchentity('5645342341');//'XXXXX'.print_r($file,TRUE);	
//	$this->children[] = (string) get_class($file);	
//}
//$this->children = $uos->request->files;

//trace($tagentityids,'ANALW');
/*
$guid = 'unset';

foreach($uos->request->files as $file) {

	if ($file->size->value==0) {
		$message = new node_message();
		$message->title = 'File has no size : '.$file->title->value;
		$message->body = sprintf('size : %s<br/>checksum : %s<br/>Upload limit : %s',$file->size->value, $file->checksum->value, ini_get('post_max_size'));
		addoutput('content/',$message);
		break;
	} 	


	$searchobj = array(
 		'where' => array(
			0 => array(
				'table' => 'node_file',
				'field' => 'checksum',
				'operator' => '=',
				'value' => $file->checksum->value
			),
			1 => array(
				'table' => 'node_file',
				'field' => 'size',
				'operator' => '=',
				'value' => $file->size->value
			),
 		)
 	);
 	
 	$matchingfiles = $universe->db_search($searchobj);
	//print_r($matchingfiles);die();
	if (count($matchingfiles)>0) {
		$message = new node_message();
		$message->title = 'Content already in universe'.$this->title;
		$message->body = sprintf('(%s) matches %s<br/>size : %s<br/>checksum : %s<br/>Upload limit : %s',$file->title->value, $matchingfiles[0]->guid->value, $file->size->value, $file->checksum->value,ini_get('post_max_size'));
		addoutput('content/',$message); 	
		//addoutput('notifications/', 'Content already in universe ('.$file->title->value.').'); 	
		$universe->tagcontent($this,array($matchingfiles[0]->id->value));  
 	} else {
	  $guid = $universe->add($file);
		$sql = $universe->tagcontent($this, array($file->id->value));
	  $file->addproperty('sql','field_text', array('value'=>$sql));
		addoutput('content/', $file); 			
 	}

}


//$testthis = fetchentity(5645342341);

//$this->title->value = "test".count($uos->request->files);


//addoutput('content', $foutput);

//addoutput('contento', 'dropfiles'.$guid.'--');
//addoutput('universe', $uos->universe);