<?php 
/**
* Template pour le bloc bannière accueil avec carrousel
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/

if(function_exists('get_field')) : 

	if(array_key_exists('className',$block)) {
		$className=esc_attr($block["className"]);
	} else $className='';



	if(have_rows('slides')) : 
		printf('<section class="carrousel-banniere %s">',$className);
		echo '<div class="owl-carousel">';
		
		while(have_rows('slides')) : the_row();
			$cible=esc_url(get_sub_field('cible'));
			$texte_1=wp_kses_post(get_sub_field('texte_1'));
			$texte_2=wp_kses_post(get_sub_field('texte_2'));
			$couleur_1=wp_kses_post(get_sub_field('couleur_1'));
			$couleur_2=wp_kses_post(get_sub_field('couleur_2'));
			$image_id=esc_attr(get_sub_field('image'));

				if($cible) {
					printf('<a href="%s" class="slide">',$cible);
				} else {
					echo '<div class="slide">';
				}
					
					echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));

					if($texte_1 && $couleur_1) {
						printf('<p class="texte-1 has-%s-background-color">%s</p>',$couleur_1,$texte_1);
					}
					if($texte_2 && $couleur_2) {
						printf('<p class="texte-2 has-%s-background-color">%s</p>',$couleur_2,$texte_2);
					}
				if($cible) {
					echo '</a>';
				} else {
					echo '</div>';
				}
	
		endwhile;
		echo '</div>';
		echo '</section>';
	endif;

endif;