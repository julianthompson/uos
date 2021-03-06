<?php
$render->title = ucfirst($render->entityconfig->title);
$render->wrapperelement = 'html';

addoutputunique('elementdata/'.$render->instanceid, $render->elementdata);

//print_r($uos->output);die();

// jQuery CDN
//addoutputunique('resources/script/', "http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
//addoutputunique('resources/script/', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js");

// jQuery Local
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "jquery/1.9.1/jquery.min.js");
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "jqueryui/1.10.2/jquery-ui.min.js");

// jQuery Hotkeys 
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "jquery.hotkeys/default.jquery.hotkeys.js");

// Growl
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "jquery.growl/javascripts/jquery.growl.js");
addoutputunique('resources/style/',  UOS_LIBRARIES_URL . "jquery.growl/stylesheets/jquery.growl.css");

// For Three.js
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "mrdoob-three.js/build/three.min.js");
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "mrdoob-three.js/examples/js/libs/tween.min.js");
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "mrdoob-three.js/examples/js/controls/TrackballControls.js");
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "mrdoob-three.js/examples/js/renderers/CSS3DRenderer.js");


// http://vitalets.github.io/x-editable/
//addoutputunique('resources/style/', "//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css");
//addoutputunique('resources/script/', "//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js");

//addoutputunique('resources/script/', $render->rendererurl . "_resources/libraries/bootstrap-switch-3.0/dist/js/bootstrap-switch.min.js");



// Font Awesome CDN
addoutputunique('resources/style/', "//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css");
//addoutputunique('resources/style/', "http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css");
// Font Awesome Local
//addoutputunique('resources/style/', UOS_LIBRARIES_URL . "font-awesome/css/font-awesome.css");

// Bootstrap
// <-- Latest compiled and minified CSS -->
//addoutputunique('resources/style/',"//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css");
//addoutputunique('resources/style/',"//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css");
addoutputunique('resources/style/',"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css");
//addoutputunique('resources/script/',"//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js");
addoutputunique('resources/script/',"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js");


addoutputunique('resources/style/', UOS_LIBRARIES_URL . "bootstrap3-dialog-master/dist/css/bootstrap-dialog.min.css");
addoutputunique('resources/script/', UOS_LIBRARIES_URL . "bootstrap3-dialog-master/dist/js/bootstrap-dialog.min.js");
//addoutputunique('resources/script/',"//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css");
//addoutputunique('resources/style/',"//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js");



// Font Awesome Local
addoutputunique('resources/style/', UOS_LIBRARIES_URL . "font-awesome/css/font-awesome.css");


// Core UOS
//addoutputunique('resources/script/', $render->activerendererurl."resources/script/classextend.js");
addoutputunique('resources/script/', $render->rendererurl."elements/_resources/script/jquery.uos.js");
addoutputunique('resources/style/', $render->rendererurl."elements/_resources/style/style.uos.css");
addoutputunique('resources/style/', $render->rendererurl."elements/_resources/style/style.uos-icons.css");

//throw new Exception('Division by zero.');
addoutputunique('resources/script/', $render->rendererurl."elements/_resources/script/jquery.uos.three.js");
addoutputunique('resources/script/', $render->rendererurl."elements/_resources/libraries/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js");
//addoutputunique('resources/script/', $render->rendererurl."elements/entity/node/node_device/_resources/script/jquery.node_device.js");
//addoutputunique('resources/script/', "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");

addoutputunique('resources/style/', "http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two");
