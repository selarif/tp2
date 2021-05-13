<?php
/**
 * Template part pour afficher les blocs de front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4ed
 */
 
 global $tPropriété;
?>

<article class="slide__conteneur">
	<div class="slide">
	<?php the_post_thumbnail( 'thumbnail' ); // --Pour extraire l'image ?>
		<div class="slide__info">
			<p><?php echo $tPropriété['sigle'] . " - " . $tPropriété['nbHeure'] . " - " . $tPropriété['typeCours']; ?></p>
			<a href="<?php echo get_permalink(); // --Pour récupérer le lien ?>"><?php echo $tPropriété['titre']; ?></a>
			<p>Session : <?php echo $tPropriété['session']; ?></p>
		</div>
	</div>
</article>


