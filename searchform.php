<?php 
$aria="Formulaire de recherche dans l\'en-tête";
$label="Saisissez vos mots-clés";
$submit="Recherche";
$placeholder="Rechercher";
$action="/";

if(KPLL && pll_current_language()=='en') {
	$label="Type your search keywords";
	$submit="Search";
	$placeholder="Search";
	$action='/en/';
}

printf('<form role="search" method="get" class="search-form" action="%s" >
			<label>
				<span class="screen-reader-text">%s</span>
				<input class="search-field" 
				placeholder="%s" value="" name="s" type="search"></label>
			<input class="search-submit orange" value="%s" type="submit">
		</form>',
		$action,
		$label,
		$placeholder,
		$submit
);