<<?php print $render->wrapperelement;?> <?php print DISPLAY_attributestostring($render->attributes);?>>
<div class="uos-header">
	<div class="field-icon">
		<span class="fa-stack fa-lg">
		  <!--<i class="fa fa-square-o fa-stack-2x"></i>-->
		  <i class="fa fa-<?php print $render->typeinfo->icon;?> fa-stack-1x"></i>
		</span>
	</div>
	<i class="fa fa-stack-2x children-count"><?php print $render->childcount;?></i>
	<div class="field-group field-group-info">
		<h2 class="field field-title"><?php print $entity->title->value;?></h2>
		<span class="field field-type"><?php print $render->typeinfo->title;?> (<?php print $entity->guid->value;?>)</span> 
	</div>
</div>
<?php print $content;?>
</<?php print $render->wrapperelement;?>>