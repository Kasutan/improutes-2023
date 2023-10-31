<?php
/**
 * ACF Customizations
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

class BE_ACF_Customizations {

	public function __construct() {

		// Only allow fields to be edited on development
		if ( ! defined( 'WP_LOCAL_DEV' ) || ! WP_LOCAL_DEV ) {
			//add_filter( 'acf/settings/show_admin', '__return_false' );
		}

		// Save and sync fields.
		add_filter( 'acf/settings/save_json', array( $this, 'get_local_json_path' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'add_local_json_path' ) );
		add_action( 'admin_init', array( $this, 'sync_fields_with_json' ) );

		// Register options page
		add_action( 'init', array( $this, 'register_options_page' ) );

		// Register Blocks
		add_filter( 'block_categories_all', array($this,'kasutan_block_categories'), 10, 2 );
		add_action('acf/init', array( $this, 'register_blocks' ) );

	}

	/**
	 * Define where the local JSON is saved.
	 *
	 * @return string
	 */
	public function get_local_json_path() {
		return get_template_directory() . '/acf-json';
	}

	/**
	 * Add our path for the local JSON.
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public function add_local_json_path( $paths ) {
		$paths[] = get_template_directory() . '/acf-json';

		return $paths;
	}

	/**
	 * Automatically sync any JSON field configuration.
	 */
	public function sync_fields_with_json() {
		if ( defined( 'DOING_AJAX' ) || defined( 'DOING_CRON' ) )
			return;

		if ( ! function_exists( 'acf_get_field_groups' ) )
			return;

		$version = get_option( 'ea_acf_json_version' );

		if ( defined( 'KASUTAN_STARTER_VERSION' ) && version_compare( KASUTAN_STARTER_VERSION, $version ) ) {
			update_option( 'ea_acf_json_version', KASUTAN_STARTER_VERSION );
			$groups = acf_get_field_groups();

			if ( empty( $groups ) )
				return;

			$sync = array();
			foreach ( $groups as $group ) {
				$local    = acf_maybe_get( $group, 'local', false );
				$modified = acf_maybe_get( $group, 'modified', 0 );
				$private  = acf_maybe_get( $group, 'private', false );

				if ( $local !== 'json' || $private ) {
					// ignore DB / PHP / private field groups
					continue;
				}

				if ( ! $group['ID'] ) {
					$sync[ $group['key'] ] = $group;
				} elseif ( $modified && $modified > get_post_modified_time( 'U', true, $group['ID'], true ) ) {
					$sync[ $group['key'] ] = $group;
				}
			}

			if ( empty( $sync ) )
				return;

			foreach ( $sync as $key => $v ) {
				if ( acf_have_local_fields( $key ) ) {
					$sync[ $key ]['fields'] = acf_get_local_fields( $key );
				}
				acf_import_field_group( $sync[ $key ] );
			}
		}
	}

	/**
	 * Register Options Page
	 *
	 */
	function register_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(array(
				'page_title' 	=> 'Réglages du site Impressionisms Routes',
				'menu_title'	=> 'Réglages du site Impressionisms Routes',
				'menu_slug' 	=> 'site-settings',
				'capability'	=> 'edit_posts',
				'position' 		=> '2.5',
				'icon_url' 		=> 'dashicons-art',
				'redirect'		=> false,
				'update_button' => 'Mettre à jour',
				'updated_message' => 'Réglages du site mis à jour',
				'capability' => 'manage_options',

			));
		}
	}

	/**
	* Enregistre une catégorie de blocs liée au thème
	*
	*/
	function kasutan_block_categories( $categories, $post ) {
		return array_merge(
			array(
				array(
					'slug' => 'improutes',
					'title' => 'Impressionisms Routes',
					'icon'  => 'art',
				),
			),
			$categories
		);
	}

	function helper_register_block_type($slug,$titre,$description,$icon='art',$js=false,$keywords=[], $multiple=true ){
		$keywords_from_slug=explode('-',$slug);
		$keywords=array_merge($keywords,$keywords_from_slug, array('Impressionism','Route'));
		$args=[
			'name'            => $slug,
			'title'           => $titre,
			'description'     => $description,
			'render_template' => 'partials/blocks/'.$slug.'/'.$slug.'.php',
			'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/'.$slug.'/'.$slug.'.css',
			'category'        => 'improutes',
			'icon'            => $icon, 
			'mode'			=> "edit",
			'supports' => array( 
				'mode' => false,
				'align'=>false,
				'multiple'=>$multiple,
				'anchor' => true,
			),
			'keywords'        => $keywords
		];
		if($js) {
			$args['enqueue_script']=get_stylesheet_directory_uri() . '/js/min/'.$slug.'/'.$slug.'.js';
		}
		acf_register_block_type( $args);
	}
	

	/**
	 * Register Blocks
	 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
	 *
	 * Categories: common, formatting, layout, widgets, embed
	 * Dashicons: https://developer.wordpress.org/resource/dashicons/
	 * ACF Settings: https://www.advancedcustomfields.com/resources/acf_register_block/
	 */
	function register_blocks() {

		if( ! function_exists('acf_register_block_type') )
			return;


		/*********Bloc banniere ***************/
		$this->helper_register_block_type( 
			'banniere',
			'Bloc image bannière',
			'Section avec une image de fond et un texte sur fond coloré semi-opaque la page d\'accueil.',
			'art', 
			false,
			array( 'banniere', 'accueil')
		);

		/*********Bloc colonnes-decor ***************/
		$this->helper_register_block_type( 
			'colonnes-decor',
			'Bloc 2 colonnes avec image encadrée',
			'Section avec une colonne de texte et une colonne contenant une image encadrée.',
			'art', 
			false,
			array( 'colonne', 'image','decor','cadre','encadrée')
		);

		/*********Bloc fond-colore ***************/
		$this->helper_register_block_type( 
			'fond-colore',
			'Bloc texte sur fond coloré transparent avec image de fond',
			'Section pleine largeur avec une zone de texte sur fond coloré transparent et une image pleine largeur en fond (deux versions).',
			'art', 
			false,
			array( 'fond', 'colore', 'coloré','image')
		);


		/*********Bloc colonnes-opaque ***************/
		$this->helper_register_block_type( 
			'colonnes-opaque',
			'Bloc 2 colonnes sur fond coloré opaque',
			'Section pleine largeur sur fond coloré opaque avec texte dans une colonne et image dans une deuxième colonne (pour le bloc itinéraires de la page Impressionisms Routes).',
			'art', 
			false,
			array( 'colonne', 'opaque', 'itineraire','itinéraires')
		);

		/*********Bloc telecharger ***************/
		$this->helper_register_block_type( 
			'telecharger',
			'Bloc documents à télécharger',
			'Bloc sur fond orange avec documents PDF à télécharger.',
			'art', 
			false,
			array('telecharger', 'pdf', 'télécharger')
		);

		/*********Bloc comité scientifique ***************/
		$this->helper_register_block_type( 
			'comite',
			'Bloc comité scientifique',
			'Bloc avec liste des membres du comité et leurs références sur 2 colonnes.',
			'art', 
			false,
			array('comite', 'comité', 'scientifique','membre')
		);

		/*********Bloc partenaires ***************/
		$this->helper_register_block_type( 
			'partenaires',
			'Bloc partenaires',
			'Section avec un titre, un logo et une colonne de texte. Le logo est placé à droite en desktop, mais sous le titre en mobile.',
			'art', 
			false,
			array( 'colonne', 'logo','partenaire')
		);

		/*********Bloc expo-opaque ***************/
		$this->helper_register_block_type( 
			'expo-opaque',
			'Bloc exposition sur fond coloré opaque',
			'Section pleine largeur avec titre et texte dans une colonne sur fond coloré opaque et 3 images qui chevauchent la zone colorée (pour le bloc itinéraire de la page Exposition).',
			'art', 
			false,
			array( 'colonne', 'opaque', 'expo','exposition')
		);

		/*********Bloc livre ***************/
		$this->helper_register_block_type( 
			'livre',
			'Bloc livre',
			'Section pleine largeur sur fond coloré opaque avec année et image dans une colonne, et titre, texte de présentation et fichier à télécharger dans une autre colonne (pour page Librairie).',
			'art', 
			false,
			array( 'colonne', 'opaque', 'livre','librairie')
		);

		/*********Bloc carrousel-banniere ***************/
		$this->helper_register_block_type( 
			'carrousel-banniere',
			'Bloc bannière accueil avec carrousel',
			'Section pleine largeur avec carrousel (image banniere cliquable + 2 textes sur fond coloré pour chaque slide)',
			'art', 
			true, //besoin de JS pour le carrousel
			array('accueil', 'banniere','carrousel')
		);

		/*********Bloc blog ***************/
		$this->helper_register_block_type( 
			'blog',
			'Bloc blog',
			'Section avec titre principal et les trois derniers articles publiés sur le blog. Carrousel sur petits écrans.',
			'art', 
			true, //JS pour carrousel mobile
			array('blog', 'article', 'accueil')
		);


		/*********Bloc carrousel de logos ***************/
		$this->helper_register_block_type( 
			'carrousel',
			'Bloc carrousel de logos des marques',
			'Section avec titre et carrousel de logos des marques',
			'art', 
			true, //besoin de JS pour le carrousel
			array('logo', 'marque','carrousel')
		);
		
	}
}
new BE_ACF_Customizations();
