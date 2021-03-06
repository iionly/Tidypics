<?php
/**
 * Album view
 *
 * @uses $vars['entity'] TidypicsAlbum
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

$full_view = elgg_extract('full_view', $vars, false);

if ($full_view) {
	echo elgg_view('object/album/full', $vars);
} else {
	if (elgg_in_context('widgets') || elgg_in_context('front') || elgg_in_context('groups')) {
		echo elgg_view('object/album/list', $vars);
	} else {
		echo elgg_view('object/album/gallery', $vars);
	}
}

return true;
