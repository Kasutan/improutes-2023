<?php 
/**
* Template pour le bloc fond-colore
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
$image_desktop=esc_attr( get_field('image_desktop') );
$image_mobile=esc_attr( get_field('image_mobile') );
$className.=' '.esc_attr( get_field('version') );

printf('<section class="acf fond-colore %s">', $className);
	
		if($texte) printf('<div class="texte">%s</div>',$texte);

		
		echo '<div class="image desktop">';
			echo wp_get_attachment_image( $image_desktop, 'banniere');
		echo '</div>';

		echo '<div class="image mobile">';
			echo wp_get_attachment_image( $image_mobile, 'medium_large');
		echo '</div>';


echo '</section>';