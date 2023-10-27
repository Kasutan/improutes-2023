<?php 
/**
* Template pour le bloc colonnes-decor
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

printf('<section class="acf colonnes-decor %s">', $className);
	
	echo '<div class="col-texte">';
		if($texte) printf('<div class="texte">%s</div>',$texte);
	echo '</div>';

	echo '<div class="col-image">';
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'large');
		echo '</div>';
	echo '</div>';

echo '</section>';
