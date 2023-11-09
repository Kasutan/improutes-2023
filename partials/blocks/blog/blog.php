<?php 
/**
* Template pour le bloc Blog
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre=wp_kses_post( get_field('titre') );

$articles=new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => '4',
	'orderby' => 'date',
	'order' => 'DESC'
));



printf('<section class="acf blog %s">', $className);
	if(!$articles->have_posts(  )) {
		echo '<p>Aucune actualité</p>';
		return;
	}

	printf('<h2 class="titre-section">%s</h2>',$titre);

	echo '<div class="loop">';
	while ( $articles->have_posts() ) {
		$articles->the_post();
		get_template_part('partials/archive','ul',array('tag'=>'div'));

	}
	echo '</div>';
	wp_reset_postdata();


	$actus=get_option( 'page_for_posts' );
	if($actus) {
		
		$label="Voir toutes nos actualités";
		$filtre="toutes";
		if(KPLL && pll_current_language()=='en') {
			$label="Read all news";
			$filtre="all";
		}

		printf('<a href="%s?filtre_cat=%s" class="bouton">%s</a>',get_the_permalink( $actus),$filtre,$label);
	}

echo '</section>';
	