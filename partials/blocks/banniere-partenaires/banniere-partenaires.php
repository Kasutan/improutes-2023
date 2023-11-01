<?php 
/**
* Template pour le bloc banniere-partenaires
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
$image_id=esc_attr( get_field('image') );
$logos=array();
$logos[]=esc_attr( get_field('logo_1') );
$logos[]=esc_attr( get_field('logo_2') );

printf('<section class="acf banniere-partenaires %s">', $className);

	echo '<div class="image">';
		echo wp_get_attachment_image( $image_id, 'banniere');
	echo '</div>';

	if($titre) printf('<h2>%s</h2>',$titre);

	echo '<div class="logos">';
		foreach ($logos as $logo) {
			echo wp_get_attachment_image( $logo, 'medium');
		}
	echo '</div>';

echo '</section>';
	