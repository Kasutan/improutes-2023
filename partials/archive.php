<?php
/**
 * Archive partial
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

//On récupère une éventuelle info sur le tag html passée en $args de get_template_part
$tag='li';
if(!empty($args) && array_key_exists('tag',$args)) {
	$tag=$args['tag'];
}

printf('<%s class="vignette">',$tag);

	$url=esc_url( get_permalink( ) );

	printf('<a href="%s">',$$url);

		if(function_exists('kasutan_vignette_image')) {
			kasutan_vignette_image();
		}

	

	
		if(function_exists('kasutan_cat_pour_filtre')) {
			kasutan_cat_pour_filtre();
		}

		//TODO améliorer fallbacks ?
		$infos_cat=array('nom'=>'Autres','couleur'=>'rouge');

		if(function_exists('kasutan_get_cat_et_couleur')) {
			$infos_cat=kasutan_get_cat_et_couleur();
		}

		

		printf('<div class="vignette-texte has-%s-background-color">',$infos_cat['couleur']);
			var_dump($infos_cat);	
			//TODO afficher nom catégorie et ajouter une classe pour la couleur -> champ acf dans la catégorie
			//Récupérer aussi la couleur pour la traduction
		
			ea_post_summary_title();

			printf('<p class="entry-date">%s</p>', get_the_date('d F Y'));

			$extrait=wpautop(get_the_excerpt());
			printf('<div class="extrait">%s</div>',$extrait);
		
		echo '</div>';
	
	echo '</a>';


	printf('<a href="%s" class="cat has-%s-background-color">%s</a>',$infos_cat['url'],$infos_cat['couleur'],$infos_cat['nom']);

printf('</%s>',$tag);

