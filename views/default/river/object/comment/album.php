<?php
/**
 * Post comment on album river view
 */

elgg_require_js('tidypics/tidypics');

$item = $vars['item'];

$comment = $item->getObjectEntity();
$subject = $item->getSubjectEntity();
$target = $item->getTargetEntity();

$subject_link = elgg_view('output/url', [
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
]);

$target_link = elgg_view('output/url', [
	'href' => $target->getURL(),
	'text' => $target->getDisplayName(),
	'class' => 'elgg-river-target',
	'is_trusted' => true,
]);

$attachments = '';
$river_comments_thumbnails = elgg_get_plugin_setting('river_comments_thumbnails', 'tidypics');
if ($river_comments_thumbnails == "show") {
	$album = $target;
	$image = $album->getCoverImage();
	if ($image) {
		$preview_size = elgg_get_plugin_setting('river_thumbnails_size', 'tidypics');
		if(!$preview_size) {
			$preview_size = 'tiny';
		}
		$attachments = elgg_format_element('ul', ['class' => 'tidypics-river-list'], 
			elgg_format_element('li', ['class' => 'tidypics-photo-item'], elgg_view_entity_icon($image, $preview_size, [
				'href' => $image->getIconURL('master'),
				'img_class' => 'tidypics-photo',
				'link_class' => 'tidypics-lightbox',
			]))
		);
	}
}

$summary = elgg_echo('river:comment:object:album', [$subject_link, $target_link]);

echo elgg_view('river/elements/layout', [
	'item' => $vars['item'],
	'attachments' => $attachments,
	'message' => elgg_get_excerpt($comment->description),
	'summary' => $summary,
]);
