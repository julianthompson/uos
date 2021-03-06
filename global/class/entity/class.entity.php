<?php
//abstract 
//#title: Category
//#title-plural: Categories
//#description: Universe entity
//print_r($uos->config->types);die();
$uos->config->types['entity']->title = 'Entity';
$uos->config->types['entity']->titleplural = 'Entities';
$uos->config->types['entity']->description = 'A simple object';


class entity {
	
	public	 	$attributes = array();
	public		$properties = array();
	
	//public	$__log = array();
	public		$displaystring = '';
	public		$parent = null;
	public		$children = array();
	public		$actions = null;
	public 		$scope = null;
	public 		$indexproperty = null;
	public		$uniqueproperties = null;
	public 		$stored = FALSE;
	public		$onchange = null; //callback or name
	
	function __construct($initializer=null) {

		$this->callactionup('build');
		// call build object here - create fields
		$this->initialize($initializer);
  }
  
  function initialize($initializer = null) {
  	if ($initializer) {
			$initializer = format_initializer($initializer);
			//print_r($initializer);
			//populate fields 
			
			//$this->properties['type'] = new field();
			//$this->properties['type']->value = get_class($this);
			
			foreach($initializer as $fieldname=>$fieldvalue) {
				//$field_initializer = array(
					//'parent' => $this,
					//'value' => $fieldvalue,
					//'key' => $fieldname
				//);
				try {
			    if ($this->propertyexists($fieldname)) {
			      //$this->trace('__setpropertyvalue ('.$propertyname.') : '.$value);
			      $this->properties[$fieldname]->setvalue($fieldvalue);
			    } else {
			    	/*
			    	$this->addproperty($fieldname,'field',array(
			    		'value' => $fieldvalue
			    	));
			    	*/
			    }
				} catch (Exception $e) {
					trace('exception!');
				}
				//$this->properties[$fieldname]->value = $fieldvalue;
			}
		}
  }
  
  function propertyexists($propertyname) {
     return isset($this->properties[$propertyname]);
  }
  
  public function __set($propertyname,$value) {
    return $this->__setpropertyvalue($propertyname, $value);
  }
  
  protected function __getproperty($propertyname) {
    return ($this->propertyexists($propertyname))?$this->properties[$propertyname]:false;
  }
  

  protected function __setpropertyvalue($propertyname,$value) {
    if ($this->propertyexists($propertyname)) {
      //$this->trace('__setpropertyvalue ('.$propertyname.') : '.$value);
      return $this->properties[$propertyname]->setvalue($value);
    }
    //$this->{'$'.$propertyname} = $value; 
    //if ($propertyname=='maxlength') { print_r($this); die(); }
    //throw new Exception('Unknown property type : '.$propertyname);
    return false;
  }


  public function __get($propertyname) {
    return $this->__getproperty($propertyname); 
  }
  
  function trace($message,$tags='') {
    /*
  	$this->__log[] = (object) array(
  		'message' => $message,
  		'tags' => explode(',',$tags)
  	);
  	*/
  	//print_r($message);
  }
/*
  
  final protected function addaction($methodname) {
    $parentclasses = $this->getparentclasses();
    //$this->trace($parentclasses);
    $args=func_get_args();
    array_shift($args);
    $output = array();
    //trace('----------','jmt');
    //trace(get_class($this),'jmt');
    //trace($parentclasses,'jmt');
    foreach($parentclasses as $scope) {
      $scopefunction = $scope.'_'.$methodname;
      //trace('looking for : '.$scopefunction,'jmt');
      //$this->trace('looking for : '.$scopefunction);
      if (method_exists($scope,$scopefunction)) {
        //$this->trace('calling : '.$scopefunction);
        $output[$scope] = call_user_func_array(array($this,$scopefunction),$args);
        //$output[$scope] = $this->$scopefunction($args);
      }
    }
    //trace(array_keys($this->__properties),'jmt');
    //$this->trace($this);
    return $output;
  }

  public function actiontopath($action) {
    trace('actiontopath','dev');
    //trace('class'.get_class($this),'dev');
    $paths = ($this->classpath('.actions'));
    trace($paths,'dev');
    foreach ($paths as $path) {
      $actionfiles = file_list($path, 'action\.'.$action.'\.php');
      if (!empty($actionfiles)) return $path.$actionfiles[0];
    }
    return NULL;
    //return getfirstfile($paths);
  }  
  
*/  
  
  final public function classpathtree($pathsuffix) {
  	$paths = array();
  	$classes = entity_class_tree($this,TRUE);
  	foreach($classes as $class) {
  		$paths[$class] = classtopath($class) . 'actions.' . $class . '/';
  	}
  	return $paths;
  }
  

  
  public function getactions() {
  
  	global $uos;

		$entityclass = get_class($this);
		/*
		//trace('looking for actions for : '.$entityclass,'jmt');
		if (is_null($this->actions)) {		
			//trace('finding actions for : '.$entityclass,'jmt');
			if (!isset($uos->config->types[$entityclass])) {
					$uos->config->types[$entityclass] = new StdClass();  
			}
			
			if (!isset($uos->config->types[$entityclass]->actions)) {
			
				$actions = Array();
				$classes = entity_class_tree($this,TRUE);
				//trace($classes);
				foreach($classes as $class) {
					$path = classtopath($class) . '_actions/';
					//trace('found action : '.$path,'jmt');
					$actionfiles = file_list($path, 'action\..*\.php');
					foreach ($actionfiles as $actionfile) {
						$actionname = substr($actionfile,7,-4);
						$actions[$actionname][$class] = $path.$actionfile;
					}
				}
				//$uos->config->types[$entityclass]->actions = $actions;
			}
			//$this->actions = &$uos->config->types[$entityclass]->actions;
		}
	  */
    return $uos->config->types[$entityclass]->actions;
  }
  
  
  
  
  public function getproperties() {
    return $this->properties;  
  }
  
  
  protected function addproperty($propertyname,$fieldtypename,$parameters=array()) {

    if (!$this->propertyexists($propertyname)) {

      //trace('addproperty : '. $propertyname . '(' . $fieldtypename . ') - ' . $this->scope);
      try {
        $field = new $fieldtypename($parameters);
        //if (is_subclass_of($field,'field')) {
          $field->parent = $this;
          $field->scope = $this->scope;
          //$this->trace('Locked : '.$this->islocked());
          //$field->setlock($this->islocked());
          $field->key = $propertyname;
          //$field->visible = FALSE;
          //trace($field);
          //trace('addproperty');
          $this->properties[$propertyname] = $field;
          //return $field;
        //}      
      } catch(Exception $e) {
        trace('Cannot addproperty '.$fieldtypename . print_r($e,TRUE));
      }
    } 
    return FALSE;
  }
  
  public function setindexproperty($propertyname) {
    if ($this->propertyexists($propertyname)) {  	
    	return $this->indexproperty = $this->properties[$propertyname];
    }
    return false;
  }
  
  public function setuniqueproperty($propertynames) {
    $filteredproperties = array_filter($propertynames, array($this,'propertyexists'));	
    if (count($propertynames) == count($filteredproperties)) {
    	return $this->uniqueproperties = $filteredproperties;
    }
    return false;
  }
  
  
  public function callactionup($action,$parameters=NULL) {
  	global $uos, $universe;
    $classes = entity_class_tree($this,TRUE);
    //print_r($classes);die();
  	$result = NULL;
  	$found = FALSE;
   	//print_r($classes);
    foreach($classes as $class) {
    	//print_r($class);
    	if (isset($uos->config->types[$class]) && isset($uos->config->types[$class]->actions[$action])) {
    		$this->scope = $class;
    		$actionfile  = $uos->config->types[$class]->actions[$action]->path;
    		//print_r($actionfile);
    		//print($actionfile);
    		if (file_exists($actionfile)) {
		      try {
		        //$result = @include $__actionfile;
		        @include $actionfile;
		      } catch (Exception $e) {
		      	trace('Caught exception : ' . print_r($e,TRUE) ,'action');
		      	addoutput('content',"Failed action :".$actionfile . ":". print_r($e,TRUE));
		      	//die('failed includes');
		        //$result = 'error';//$e;
		      }
		      //break;
		      $found = TRUE;
	      }
    	} 
    }  
    //die();
    if ($found) return $result;
    return UOS_ERROR_NOT_FOUND;
  }
  
  public function callaction($action,$parameters=NULL) {
  	global $uos, $universe;
  	$result = NULL;
		//if (get_class($this)=='node_person') $uos->config->logging = TRUE;
    $actions = $this->getactions();
    
    $classes = entity_class_tree($this);
    
    foreach($classes as $class) {
    	addoutput('content/',debuginfo($uos->config->types[$class]));
    	if (isset($uos->config->types[$class]->actions[$action])) {
    		$actionfile  = $uos->config->types[$class]->actions[$action]->path;
    		if (file_exists($actionfile)) {
		      try {
		        
    				//$result = @include $__actionfile;
		        @include $actionfile;
		      } catch (Exception $e) {
		      	trace('Caught exception : ' . print_r($e,TRUE) ,'action');
		      	addoutput('content/',"Failed action :".$actionfile . ":". print_r($e,TRUE));
		      	//die('failed includes');
		        //$result = 'error';//$e;
		      }
		      return $result;
	      }
    	}
    }
    
    return UOS_ERROR_NOT_FOUND;
  }
    	
  /*  
    //print_r($this->actions[$action]);
    //print_r(gettype($this));
		//trace(get_class($this),'jmt');
		//trace($action,'callaction');
		//trace(empty($this->actions)?'EMPTYACTONS':'','jmt');
    if (isset($actions[$action])) {
      //$response->found = TRUE;
      $localVariables = compact(array_keys(get_defined_vars()));
      //trace("this->fireevent(".$action.','.print_r($parameters,TRUE). "," . UNIVERSE_EVENT_POST . ")");
      //$this->fireevent(UNIVERSE_EVENT_POST,$action,$parameters);
      //extract($parameters);
      //return;//
      

    	$_response = new StdClass();
    	$_response->actionfiles = array();
    	$classtree = entity_class_tree($this,TRUE);
    	
    	//trace($classtree);
    	//trace($this->actions[$action]);
    	//die();
    	
      //ob_start();    	
    	foreach($this->actions[$action] as $classname => $actionfile) {
    		$this->scope = $classname;   	
      	$_response->actionfiles[] = $actionfile; 
      	//trace($actionfile);
      	//if (get_class($this)=='field') { print_r($this->actions);print_r($classtree);print_r($actionfile); }
      	//trace('callaction  : '.$actionfile.' ('.$this->scope.')');  
      	if (file_exists($actionfile)) {
		      try {
		        //$result = @include $__actionfile;
		        @include $actionfile;
		      } catch (Exception $e) {
		      	trace('Caught exception : ' . print_r($e,TRUE) ,'action');
		      	addoutput('content',"Failed action :".$actionfile . ":". print_r($e,TRUE));
		      	//die('failed includes');
		        //$result = 'error';//$e;
		      }
		      //break;
	      }
      }
      //if (get_class($this)=='field') { die; }

      //addoutput('output',$result);
      //addoutput('dump/',  ob_get_contents() );      
      //$response->output = ob_get_contents();
      //trace($harry);
      //ob_end_clean();
      //trace('processed action file');      
      //$parameters['actionresult'] = $result;
      $localVariables = compact(array_keys(get_defined_vars()));
      //$this->fireevent($action,$parameters,UNIVERSE_EVENT_POST);

    } else {
      //$response->error = TRUE;
      return UOS_ERROR_NOT_FOUND;
    }
	//$uos->config->logging = FALSE;
    
    return $result;
  }
  
  */
  
  public function trigger($action,$parameters=NULL) {
		return $this->callaction($action,$parameters);
	}

 
  protected function removeproperty($propertyname) {
    if ($this->propertyexists($propertyname)) {
    	unset($this->properties[$propertyname]);
    }  	
  }

  public function filterproperties($propertylist) {
  	$propertylist = is_array($propertylist)?$propertylist:func_get_args();
  	foreach($this->__properties as $key=>$property) {
  	  if (!in_array($key,$propertylist)) {
  	    $this->removeproperty($key);
  	  }
  	}
  }
  
	function getindexproperty() {
		return $this->indexproperty;
	}



	function ___getdata($modified=FALSE) {
		$tables = array();
		$properties = $this->getproperties();
		$indexfield = $this->getindexproperty();
		
		foreach($properties as $key=>$property) {
			if (is_uos_field($property) && $property->isstored()) {
				if ($modified && !$property->modified) continue;
				if ($indexfield->key!==$property->key) {
								//print_r($key.':'.$property->scope."\n");
					$tables[($property->scope)][$key] = $property->getdbfieldvalue();
				}
			}
		}
		$indexscope = $indexfield->scope;
		
		//$indexelements = array($indexscope.'_id'=> &$this->properties[$indexfield->key]->value);
		
		$indexelements = array($indexscope.'_id'=> &$properties[$indexfield->key]->value);		
		foreach($tables as $scope=>$property) {
			if ($scope!==$indexscope) {
				$tables[$scope] = array_merge($indexelements, $tables[$scope]);
			}
		}
		return $tables;
	}
  
  
  public function __gettabledefinition() {
    $tables = array();
    $properties = $this->getproperties();
    foreach($properties as $key=>$property) {
      //if (!isset($tables[($property->scope)]) && ($property->parentclass!=='node')) {
      //  $tables[($property->scope)]['node_id'] = $this->__properties['id']->getdbfieldcreate('node'); 
      //}
      $data = new StdClass();
      $data->value = $property->value;
      $data->index = $property->indexfield;
      $data->dbfieldtype = $property->getdbfieldtype();
      $tables[($property->scope)][$key] = $data;//$property->getdbfieldcreate();//getdbtype();
    }
    return ($tables);
  }
  
  
	function ___gettabledefinition() {
		$tables = array();
		$indexfield = $this->getindexproperty();		
		$properties = $this->getproperties();
		//print_r($indexfield);die();
		foreach($properties as $key=>$property) {
			if (is_uos_field($property)) {
				//print_r($property);
				$auto = ($indexfield->key==$key) ? ' NOT NULL AUTO_INCREMENT':'';
				$tables[($property->scope)][$key] = $property->getdbfieldtype() . $auto;
			}
		}
		$indexscope = $indexfield->scope;
		$indexelements = array($indexscope.'_id'=> $indexfield->getdbfieldtype());
		
		foreach($tables as $scope=>$property) {
			if ($scope!==$indexscope) {
				$tables[$scope] = array_merge($indexelements, $tables[$scope]);
			}
		}
		return $tables;
	}
	
	function relocatefiles() {
	}
	
	function afterupdate() {
	
	}
	
	public function fetchchildren() {
		global $universe;
		if ($this->id->isvalueset()) {
			$children = $universe->db_select_children((string) $this->id);
			foreach($children as $child) {
				$this->children[] = $child;
			}	
			return $this->children;
		}
	}
	
	public function getchild($childid) {
		$this->fetchchildren();
		return $this->children[$childid];
	}
  
  public function __toString() {
    return (string) $this->type . '(' . (string) $this->guid . ')';
  }

  function classpath($suffix='') {
  	return classtopath(get_class($this)) . $suffix;
	}
  
  function cachepath($suffix='') {
  	global $uos;
		return UOS_GLOBAL_CACHE . $uos->request->universename . '/' . $this->type . '/' . $this->guid . '/' . $suffix;
	}
	
  function datapath($suffix='') {
  	global $uos;
		return UOS_GLOBAL_DATA . $uos->request->universename . '/' . $this->type . '/' . $this->guid . '/' . $suffix;
	}
	
  function dataurl($suffix='') {
  	global $uos;
		return '/data/' . $uos->request->universename . '/' . $this->type . '/' . $this->guid . '/' . $suffix;
	}
	
	function isvalid() {
		foreach($this->properties as $key=>$field) {
			if (!$field->isvalid()) return FALSE;
		}
		return TRUE;
	}
	
	function invalidproperties() {
		$invalidproperties = array();
		foreach($this->properties as $key=>$field) {
			if (!$field->isvalid()) $invalidproperties[$key]=$field;
		}
		return $invalidproperties;
	}
	
	public function mimeoutputtypes() {
  
  	global $uos;
  	$mimetypes = array();
		$mimetypepath = $this->classpath('_mimetypes/');
		//if (is_dir($mimetypepath)) {
		//	return $mimetypepath;	
		//}
		if ($mimefiles = find_files($mimetypepath, 'mime\..*\.php')) {
			foreach ($mimefiles as $filepath) {
				if (preg_match('/mime\.(.*)\.php/', basename($filepath), $matches) > 0) {
					$mimekey = str_replace('_','/',$matches[1]);
					$mimetypes[$mimekey] = $filepath; 
				}
			}
		}
		//return rglob($mimetypepath);
		return $mimetypes;
	}
	
	
	function getasmime($mimetype, $force=FALSE) {

		$output = null;

		$cachefile = $this->cachepath($mimetype.'/0.output');
		
		$cachedir = dirname($cachefile);
		
		if (!file_exists($cachefile)) {
		
			if (!file_exists($cachedir)) {
				mkdir($cachedir,0777,TRUE);
			}

			$mimetypes = $this->mimeoutputtypes();
			
			//return print_r($mimetypes);
			
			if (isset($mimetypes[$mimetype])) {
				//file_put_contents($cachefile,$output);
				//return($mimetypes[$mimetype]);
				//$ob_file_callback = function($buffer) use ($cachefile) { fwrite($cachefile, $buffer); }; ob_start($ob_file_callback);
				//call $output_callback every 1MB of output buffered.
				ob_start();
				//ob_start($ob_file_callback, 1048576);
        include $mimetypes[$mimetype];
        //echo 'Including '.$mimetypes[$mimetype];
      	$output = ob_get_contents();
      	ob_clean();
      	//$output .= 
      	//$output = $cachefile;
      	file_put_contents($cachefile,$output);
			} else {
				$output = 'no mime found';
			}
		} else {
			$output = file_get_contents($cachefile);
		}
		return $output;
	}
	
	
	// move to magic function in php 5.6
	function debuginfo() {
		$outstring = $this->type->value . ($this->isvalid()?' [valid]':' [invalid]') . ($this->ismodified()?'[modified]':'');
		$outstring .= ' {<br/>';
		$outstring .= ' &nbsp; &nbsp;<em>Properties</em> : {<br/>';		
		foreach($this->properties as $key=>$field) {
			$outstring .= '&nbsp; &nbsp;&nbsp; &nbsp;' . ($field->stored?'<strong>':'');
			$outstring .= '   '. $key . ' : ';
			$outstring .= '\'' . $field->value . '\' ('.gettype($field->value).')';
			if ($field->modified) $outstring .= '[modified]';
			if ($field->isvalueset()) $outstring .= ' [set]';
			$outstring .= ($field->isvalid())?'[valid]':'[invalid]';
			$outstring .= ($field->usereditable)?'[usereditable]':'';
			$outstring .= ($field->required)?'[required]':'';
			$outstring .= ($field->isstored()?'</strong>':'');
			$outstring .= '<br/>';
		}
		$outstring .= '&nbsp; &nbsp;}<br/>';
		$outstring .= ' &nbsp; &nbsp;<em>Actions</em> : {<br/>';
		//$this->getactions();
		$actions = $this->getactions();
		foreach($actions as $key=>$field) {		 
			$outstring .= '&nbsp; &nbsp;&nbsp; &nbsp;<strong>'.$key.'</strong> : '.print_r($field,TRUE).'<br/>';
		}
		$outstring .= '&nbsp; &nbsp;}<br/>';
		return $outstring;
	}
	
	function ismodified() {
		foreach($this->properties as $key=>$field) {
			if ($field->ismodified()) return TRUE;
		}		
		return FALSE;
	}
	
	function event_propertymodified($property) {
	}
	
	public function __clone() {
		foreach($this->properties as $key=>$property) {
			$this->properties[$key] = clone $this->properties[$key];
		}
		$this->title->value = $this->title->value . ' (Cloned)';
	}
	
	public function addparent($entity) {
		$this->parent = $entity;
		$this->parent->addchild($this);
	}
	
	public function addchild($entity,$index=NULL) {
		$entity->parent = $this;
		if (is_null($index)) {
			$this->children[]=$entity;
		} else {
			$this->children[$index]=$entity;
		} 
	}
  
}		
