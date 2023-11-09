<?php
add_action('tha_header_top','kasutan_header_top');
function kasutan_header_top() {
	echo '<div class="topbar">';

	$aria="Formulaire de recherche dans l\'en-tête";
	$label="Saisissez vos mots-clés";
	$submit="Déclencher la recherche";
	$placeholder="Rechercher";
	$action="/";

	if(KPLL && pll_current_language()=='en') {
		$aria="Search form in header";
		$label="Type your search keywords";
		$submit="Trigger search";
		$placeholder="Search";
		$action='/en/';
	}

	printf('<form role="search" method="get" class="search-form search-topbar" action="%s" aria-label="%s">
			<label>
				<span class="screen-reader-text">%s</span>
				<input class="search-field" 
				placeholder="%s" value="" name="s" type="search"></label>
			<input class="search-submit" value="%s" type="submit">
		</form>',
		$action,
		$aria,
		$label,
		$placeholder,
		$submit
	);
	

	if(KPLL) {
		echo '<ul class="selecteur">';
		pll_the_languages(array(
			'show_flags'=> 1,
			'hide_current'=>1
		));
		echo '</ul>';
	}
	
	echo '</div>';
}