<?php
/**
 * The template for displaying About Us pages
 * 
 * 
 *
 * @package Snack_Lab
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();
		?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header><!-- .entry-header -->
		<?php
		?>
		<div class="content-wrapper">
			<?php
				$intro = get_field('intro_about_us');
				if($intro){
					echo '<p>'.$intro.'</p>';
				}?>
			<?php

			//Meeting the team!			
			$title_1 = get_field('title_1');
			if($title_1){
				?>
				<div class="our-teams">
					<?php
					echo '<h2>'.$title_1.'</h2>';
					// need to pull images somehow
					$team_members = get_field('team_members');
					if( $team_members ) {
						?>
						<div class ="img-wrapper">
							<?php
							foreach( $team_members as $img ) {
								echo'<img src="' . esc_url($img) . '" alt="Developer">';
							}?>
						</div>
					<?php } ?>
				</div>
			 <?php } ?>

			 <?php
				$title_2 = get_field('title_2');
				if($title_2){ ?>
					<div id="our-baking">
						<?echo '<h2>'.$title_2.'</h2>';
							$paragraph_about = get_field('paragraph_about');
							if($title_2){
								echo '<p>'.$paragraph_about.'</p>';
							}?>
					</div>
				<?php } 
			endwhile; // End of the loop.
			?>
		</div>
</main><!-- #main -->
<?php

get_footer();
