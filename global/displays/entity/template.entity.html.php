<?php $type = get_type_data(get_class($entity)); ?>
<div class="<?php print implode(' ',$classes);?>" id="<?php print $instanceid;?>" draggable="true" data-downloadurl="<?php print $entity->downloadurl->value;?>" data-type="<?php print get_class($entity);?>" data-guid="<?php print $entity->guid->value;?>" data-display="default" data-displays="default,teaser,edit" title="<?php print $entity->title->value;?>" data-actions="add,displayup,displaydown,edit,remove,save,cancel" data-accept="*" data-childcount="<?php print count($entity->children);?>">
	<div class="header">
		<div class="field-icon">
			<span class="fa-stack fa-lg">
			  <!--<i class="fa fa-square-o fa-stack-2x"></i>-->
			  <i class="fa fa-<?php print $type->icon;?> fa-stack-1x"></i>
			</span>
		</div>
		<i class="fa fa-stack-2x children-count"><?php print count($entity->children);?></i>
		<div class="field-group field-group-info">
			<h2 class="field field-title"><?php print $entity->title->value;?></h2>
			<span class="field field-type"><?php print $type->title;?> (<?php print $entity->guid->value;?>)</span> 
		</div>
	</div>
	<?php print render($entity->properties); ?>
	<?php print render($entity->children); ?>
	<?php //print render($entity->getactions()); ?>
	<div class="clearboth"></div>	
</div>