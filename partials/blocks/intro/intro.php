<?php 
/**
* Template pour le bloc intro
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre=wp_kses_post( get_field('titre') );
$texte=wp_kses_post( get_field('texte') );

printf('<section class="acf intro %s">', $className);

	printf('<h2>%s</h2>',$titre);
	printf('<div class="texte-wrap"><div class="decor"></div><div class="texte">%s</div></div>',$texte);


echo '</section>';
	