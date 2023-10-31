<?php 
/**
* Template pour le bloc expo-opaque
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

$image_1=esc_attr( get_field('image_1') );
$image_2=esc_attr( get_field('image_2') );
$image_3=esc_attr( get_field('image_3') );

$couleur=esc_attr( get_field('couleur') );

printf('<section class="acf expo-opaque %s">', $className);
	printf('<div class="fond has-%s-background-color"></div>',$couleur);

	if($titre) printf('<h2 class="has-blanc-color">%s</h2>',$titre);
		
	echo '<div class="images">';
		if($image_1) echo wp_get_attachment_image( $image_1, 'medium');
		if($image_2) echo wp_get_attachment_image( $image_2, 'medium');
		if($image_3) echo wp_get_attachment_image( $image_3, 'medium');
		
	echo '</div>';

	if($texte) printf('<div class="texte">%s</div>',$texte);



echo '</section>';
	