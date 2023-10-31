<?php 
/**
* Template pour le bloc telecharger
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';



if(have_rows('docs')) :

	printf('<ul class="acf telecharger %s">', $className);

		while (have_rows('docs')) : the_row();
			$titre=wp_kses_post(get_sub_field('titre'));
			$desc=wp_kses_post(get_sub_field('description'));
			$file = get_sub_field('file');

			if($file) :

				echo '<li>';
				
				if($titre) printf('<span><strong>%s</strong></span>',$titre);
				if($file) printf('<span>%s</span>',$file['filename']);
				if($desc) printf('<span>%s</span>',$desc);
				if($file) printf('<a href="%s" class="bouton pdf" target="_blank" rel="noopener noreferrer">Télécharger</a>',$file['url']);


				echo '</li>';

			endif;

		endwhile;

	echo '</ul>';

endif;