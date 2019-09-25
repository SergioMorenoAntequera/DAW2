<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class( misrem_check_additional_classes() ); ?> 
	style="background: url( '<?php echo get_header_image(); ?>' ) top/cover no-repeat #fff; <?php if ( ! is_home() ) { echo esc_attr( 'background-attachment: fixed;' ); } ?>">
	<header class="header">
		<div class="header__container">
			<div class="header__page">        
				<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					if ( has_custom_logo() ) {
						the_custom_logo();
					}
				} ?>
				<div class="header__text">
						<?php if ( is_front_page() ) : ?>
					<h1 class="header__title 
						<?php if ( ! has_custom_logo() ) { echo 'header__title--no-logo'; } ?>">
						<a href="
							<?php echo esc_url( home_url( '/' ) ); ?>
							" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
						<?php else : ?>
								<p class="header__title <?php if ( ! has_custom_logo() ) { echo esc_attr( 'header__title--no-logo' ); } ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
						<?php
						$description = get_bloginfo( 'description', 'display' );

						if ( $description || is_customize_preview() ) :
						?>
							<p class="header__subtitle"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
				</div>
			</div>
			<nav class="navigation">
				<?php
					wp_nav_menu( array(
						'menu_class' => 'navigation__menu',
						'menu_id' => 0,
						'container' => false,
						'theme_location' => 'primary',
						'fallback_cb' => false,
					) );
				?>
			</nav>
			<div class="header__search">
				<div class="search__form-container"><?php get_search_form();?></div>
				<div class="search__form-buttom">
					<button class="search__show-input">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</div>
			</div>
				<div class="burger">
					<div class="burger__roler"></div>
					<div class="burger__roler"></div>
					<div class="burger__roler"></div>
				</div>
		</div>
	</header>
	<?php
	if ( ! is_home() ) :
	?>
	<section class="current-info">
		<div class="container">
			<?php custom_breadcrumbs(); ?>
		</div>	
	</section>
	<?php endif; ?>
