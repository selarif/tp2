<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4ed
 */

?>

<article class="flip-card">
    <div class="flip-card-inner">
        <div class="flip-cart-front">
            <?php the_post_thumbnail( 'thumbnail' ); ?>
        </div>

        <div class="flip-card-back"> <!-- Sera affiche en arriere. pcq les deux (front et back) sont en absolutes -->
            <h6><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h6>
        </div>
    </div>
</article>