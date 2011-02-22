<?php
/**
* YOOslider Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="<?php echo $style ?>">
	<div id="<?php echo $slider_id ?>" class="yoo-slider <?php echo $style ?>" style="<?php echo $css_module_height ?>">

		<ul class="list">
		<?php for ($i=0; $i < $items; $i++) : ?>
		
			<?php
			$listitem = $list[$i];
			$item_class = "item item" . ($i + 1);
			if ($i == 0) $item_class .= " first";
			if ($i == $items - 1) $item_class .= " last";
			?>
			
			<li class="slide <?php echo $item_class ?>" style="<?php echo $css_item_height ?>">
				<div style="<?php echo $css_item_height_expanded ?>">
					<?php modYOOsliderHelper::renderItem($listitem, $params, $access); ?>
				</div>
			</li>
			
		<?php endfor; ?>
		</ul>
	
	</div>
</div>