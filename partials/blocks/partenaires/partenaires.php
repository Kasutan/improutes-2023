<?php 
/**
* Template pour le bloc partenaires
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
$titre=wp_kses_post( get_field('titre') );
$image_id=esc_attr( get_field('image') );


printf('<section class="acf partenaires %s">', $className);
	
	if($titre) printf('<h2 class="titre">%s</h2>',$titre);
	if($image_id) {
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'medium');
		echo '</div>';
	}
	if($texte) printf('<div class="texte">%s</div>',$texte);

echo '</section>';
