<?php 
/**
* Template pour le bloc comite
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';



if(have_rows('membres')) :

	printf('<table class="acf comite %s"><tbody>', $className);

		while (have_rows('membres')) : the_row();
			$nom=wp_kses_post(get_sub_field('nom'));
			$pays=wp_kses_post(get_sub_field('pays'));
			$refs=wp_kses_post(get_sub_field('refs'));

			if($nom) :

				echo '<tr>';
				
					printf('<td class="nom"><strong>%s</strong>',$nom);
					if($pays) printf('<br><strong>(%s)</strong>',$pays);
					echo '</td>';

					echo '<td class="refs">';
						if($refs) echo $refs;
					echo '</td>';

				echo '</tr>';

			endif;

		endwhile;

	echo '</tbody></table>';

endif;