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

$className.=' '.esc_attr(get_field('fond'));

if(have_rows('docs') && function_exists('kasutan_affiche_bloc_telecharger')) :

	printf('<ul class="acf telecharger %s">', $className);

		while (have_rows('docs')) : the_row();
			$titre=wp_kses_post(get_sub_field('titre'));
			$file = get_sub_field('file');

			if($file) :

				echo '<li>';
				
				kasutan_affiche_bloc_telecharger($titre,$file);


				echo '</li>';

			endif;

		endwhile;

	echo '</ul>';

endif;