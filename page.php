<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content-page' );

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // End of the loop.

get_footer();

$title = get_field( 'text' );
$text_area = get_field( 'short_description' );
$image = get_field( 'image' );
$editor = get_field( 'description' );
$boolean = get_field( 'boolean' );
$featured_posts = get_field('post');
$taxonomy = get_field('taxonomy');

if ( ! empty( $title ) ): ?>
    <p><strong>Title: </strong> <span><?= $title ?></span></p>
<?php endif; ?>

<?php
if ( ! empty( $text_area ) ): ?>
    <p><strong>Text area: </strong> <span><?= $text_area ?></span></p>
<?php endif; ?>

<?php
if ( ! empty( $editor ) ): ?>
    <p><strong>Editor: </strong> <span><?= $editor ?></span></p>
<?php endif; ?>

<?php
if( ! empty( $image ) ):

    // Image variables.
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    // Thumbnail size attributes.
    $size = 'thumbnail';
    $thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
    $height = $image['sizes'][ $size . '-height' ];

    // Begin caption wrap.
    if( $caption ): ?>
        <div class="wp-caption">
    <?php endif; ?>
	<p><strong>Image:</strong></p>
    <a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>">
        <img src="<?php echo esc_url($thumb); ?>" width="<?= $width ?>" height="<?= $height ?>" alt="<?php echo esc_attr($alt); ?>" />
    </a>

<?php endif; ?>

<?php
if ( ! empty( $boolean ) ): ?>
    <?php if ($boolean == 1) {?>
		<p><strong>Enable Description</strong></p>
		<p><?= $editor ?></p>
		<h2><?php echo esc_html( $taxonomy->name ); ?></h2>
    	<p><?php echo esc_html( $taxonomy->description ); ?></p>
	<?php } ?>
<?php endif; ?>