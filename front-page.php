<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4ed
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<section class="list-cours">
				<?php
				/* Start the Loop */
				$precedent = "XXXXXXX";
				while ( have_posts() ) :
					the_post();
					// 582-1J1 Animation et interactivité en jeu (75h)
					convertir_tableau($tPropriété); /// à chaque fois que le précédent est différent du cours présent, créer une nouvelle section
					if ($precedent != $tPropriété['typeCours']): ?>
					  	<?php if ($precedent != "XXXXXXX"): /// Quand $precedent n'est pas comme en premier (XXXXXX), alors restart la boucle pour les autres blocs (specifique, web,jeu, etc) ?>
							</section>
						<?php endif;?>
						<?php if (in_array($precedent, ['Web','Jeu','Spécifique'])): /// Pour afficher les radios boutons quand le précédent est Web ou Jeu ou Spécifique?>	
							<section class="ctrl-carrousel">
								<?php echo $ctrl_radio; /// Boutons Radio
								$ctrl_radio = ''; /// On initialise les Boutons Radios à une chaîne de caractere vide pour qu'il y en ai pas en trop
								?> 
							</section>
						<?php endif;?>
						<h2><?php echo $tPropriété['typeCours'] /// -- Quand c'est Web, Jeu ou Spécifique ajoute le carrousel, sinon ('?'), ajoute la classe bloc (permet d'avoir plus de contrôle sur le css)?></h2>
						<section <?php echo (in_array($tPropriété['typeCours'], ['Web','Jeu','Spécifique']) ? 'class="carrousel-2"' : 'class="bloc"');  ?>>
					<?php endif;?>	
					<?php 
					if (in_array($tPropriété['typeCours'], ['Web','Jeu','Spécifique'])): /// Si typeCours est Web ou Jeu alors mets le carrousel
						get_template_part( 'template-parts/content', 'carrousel' ); /// Charge le fichier nommé 'content-carrousel' avec comme préfixe 'content' et suffixe 'carrousel' dans le dossier template-parts dans wp-content
						$ctrl_radio .= '<input type="radio" name="rad-'. $tPropriété['typeCours'] .'">'; /// On met .$tPropriété['typeCours']. pour dissocier les boutons entre Jeu et Web et Spécifique
					 else:
						get_template_part( 'template-parts/content', 'bloc' );
					endif; 
					$precedent = $tPropriété['typeCours'];
				endwhile; ?>
			</section>
		<?php endif; ?>
	

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();

function convertir_tableau(&$tPropriété){ /// Tableau associatif
	$titre_grand = get_the_title();  
	$tPropriété['session'] = substr($titre_grand, 4,1); /// 4 : position du numéro. 1 : nombre de caractères
	$tPropriété['nbHeure'] = substr($titre_grand,-4,3 ); /// On cherche le nombre d'heures
	$tPropriété['titre'] = substr($titre_grand,8, -6); /// On cherche le nom du cours et seulement ça, sans le sigle et nb d'heures
	$tPropriété['sigle'] = substr($titre_grand,0, 7);
	$tPropriété['typeCours'] = get_field('type_de_cours'); 
}
