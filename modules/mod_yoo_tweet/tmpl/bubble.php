<?php
/**
* @package   YOOtweet Module
* @file      bubble.php
* @version   1.5.5 March 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$count = count($feed->items);

// set bubble width
switch ($count) {

	case 1:
		$width = 'width100';
		break;
		
	case 2:
		$width = 'width50';
		break;
		
	case 3:
		$width = 'width33';
		break;
		
	case 4:
		$width = 'width25';
		break;
		
	case 5:
		$width = 'width20';
		break;

	default:
		$width = '';
}

?>
<div class="<?php echo $style ?>">
	<div class="yoo-tweet">
	
		<?php if ($count) : ?>
		
			<ul>
				<?php
				$i = 0;
				foreach ($feed->items as $key => $item) :
					$link      = $item->get_link(0, 'alternate');
					$image     = $item->get_link(0, 'image');
					$published = $item->get_date('Y-m-d H:i:s');
					$author    = modYOOtweetHelper::getAuthor($feed, $item);
					$text      = modYOOtweetHelper::getText($feed, $item);
					$i++;
				?>
				<li class="<?php echo $width; ?> <?php if ($i == 1) echo 'first'; ?>">
				
					<div class="bubble-t1">
						<div class="bubble-t2">
							<div class="bubble-t3">
							</div>
						</div>
					</div>
				
					<div class="bubble-1">
						<div class="bubble-2">
							<div class="bubble-3"><?php echo $text; ?></div>
						</div>
					</div>
					
					<div class="bubble-b1">
						<div class="bubble-b2">
							<div class="bubble-b3">
							</div>
						</div>
					</div>
				
					<div class="meta">
					
						<?php if ($show_image) : ?>
						<a class="image" href="<?php echo $author->link; ?>">
							<img src="<?php echo $image; ?>" width="<?php echo $image_size; ?>" height="<?php echo $image_size; ?>" alt="<?php echo $author->name; ?>"/>
						</a>
						<?php endif; ?>
	
						<?php if ($show_author) : ?>
							<div class="author"><a href="<?php echo $author->link; ?>"><?php echo $author->name; ?></a></div>
						<?php endif; ?>
							
						<?php if ($show_date) : ?>
							<div class="date"><?php echo modYOOtweetHelper::getRelativeTime($published); ?></div>
						<?php endif; ?>
				
					</div>
				
				</li>
				<?php endforeach; ?>
				
			</ul>
		
		<?php else : ?>
			<?php echo JText::_('No tweets found'); ?>
		<?php endif; ?>
		
	</div>
</div>
