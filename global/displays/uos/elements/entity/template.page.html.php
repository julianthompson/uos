<div id="universetoolbar">
	<ul id="universe-status">
		<li class="field-icon-container" id="universe-status-icon">
			<div class="field-icon">
				<span class="fa-stack">
				<i class="fa fa-stack-2x uos-entity-icon" id="universe-selected-count" class="universe-selected-count">0</i>
				<!--<i class="fa fa-asterisk fa-stack-1x"></i>-->
				</span>
			</div>
		</li>
		<li id="universe-details">
			<h1><?php print $render->title;?></h1>
			<div class="field field-tags"><ul><li><i class="fa fa-circle"></i> Work</li><li><i class="fa fa-circle"></i> Policy Connect</li></ul></div>
		</li>
	</ul>
	<ul id="universe-actions">
	</ul>
</div>

<div id="container">
<?php //print render($entity,'html');?>
</div>

<div id="dialog">

</div>

<div id="input">
	<h2><i class="fa fa-sign-in"></i> Request</h2>
	<?php //print render($uos->request);?>
	<h2><i class="fa fa-sign-in"></i> Log</h2>
	<div id="inputmessages">
	<?php //print render($uos->output['log']); ?>
	</div>
	<h2><i class="fa fa-sign-in"></i> Universe Config ($uos->config)</h2>
	<div id="uosobject">
	<?php //print render($uos->config);?>
	</div>
</div>	