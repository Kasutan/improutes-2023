<?php
/**
 * Archive partial - search results
 *
**/

//TODO réutiliser partials/archive.php

$post_type=get_post_type();
if($post_type==='product') {
	$label_suite="Voir le produit";
} else {
	$label_suite="Lire la suite";
}
printf('<li class="post-summary %s">',$post_type);

	if(function_exists('kasutan_vignette_image')) {
		kasutan_vignette_image();
	}

	echo '<div class="post-summary__content">';
		//ea_entry_category('archive');
		if($post_type==='post') {
			printf('<p class="entry-date">%s</p>',get_the_date('d/m/Y'));
		}
		
		ea_post_summary_title();
		the_excerpt();
		if($post_type==='product') {
			global $product;
			printf('<p class="price">%s</p>', $product->get_price_html());
		} 
		printf('<a href="%s" class="suite">%s<span class="screen-reader-text">de %s</span><span class="chevrons-suite">>>></span></a>',get_the_permalink(),$label_suite,get_the_title());
	echo '</div>';

echo '</li>';
