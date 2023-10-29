<?php 
/**
* Template pour le bloc colonnes-opaque
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';



$texte=wp_kses_post( get_field('texte') );

$image_id=esc_attr( get_field('image') );
$couleur=esc_attr( get_field('couleur') );

printf('<section class="acf colonnes-opaque %s has-%s-background-color">', $className,$couleur);
	
	if($texte) printf('<div class="col-texte has-blanc-color">%s</div>',$texte);
		
	echo '<div class="col-image">';
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'medium');
		echo '</div>';
		
	echo '</div>';


echo '</section>';
	