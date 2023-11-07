<?php 
/**
* Template pour le bloc livre
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


//Options de présentation
$couleur=esc_attr( get_field('couleur') );
$className.=esc_attr( get_field('inverser') ) ? ' inverser' : '';

//Contenu col texte
$texte=wp_kses_post( get_field('texte') );
$titre=wp_kses_post( get_field('titre') );

//Document à télécharger
$file = get_field('file');


//Contenu col image
$annee=wp_kses_post( get_field('annee') );
$image_id=esc_attr( get_field('image') );




printf('<section class="acf livre %s">', $className);
	echo '<div class="col-image">';
		if($annee) {
			printf('<span class="annee has-%s-background-color">%s</span>',$couleur,$annee);
		}
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'medium_large');
		echo '</div>';
	echo '</div>';

	printf('<div class="col-texte has-%s-background-color">',$couleur);
		if($titre) printf('<h2>%s</h2>',$titre);
		if($texte) printf('<div class="texte">%s</div>',$texte);
		
		if(function_exists('kasutan_affiche_bloc_telecharger') && $file) {
			echo '<div class="fichier">';
				kasutan_affiche_bloc_telecharger(false,$file);
			echo '</div>';
		}
	echo '</div>';
echo '</section>';
	