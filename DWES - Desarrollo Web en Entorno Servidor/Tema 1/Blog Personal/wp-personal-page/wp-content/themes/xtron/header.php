<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtron
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
	  <?php wp_head(); ?>
	  
    </head>

  <body <?php body_class(); ?>>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'xtron' ); ?></a>
		<div id="main">

            <div class="container">
                <div class="row">
					<div class="menu-icon pull-right">		
                      <a href="javascript:void(0)" onclick="openNav()"><i class="ti-menu"></i> </a>
                    </div>
				
                    <div class="col-md-4 col-xs-12">
                       	<div class="site-branding">
			              <?php
			                the_custom_logo();
			                 if ( is_front_page() && is_home() ) :
				             ?>
				           <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				           <?php
			                else :
				             ?>
				           <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				            <?php
			                endif;
			                $xtron_description = get_bloginfo( 'description', 'display' );
			                if ( $xtron_description || is_customize_preview() ) :
				            ?>
				           <p class="site-description"><?php echo esc_html($xtron_description); /* WPCS: xss ok. */ ?></p>
			                             <?php endif; ?>
		                 </div><!-- .site-branding -->
                    </div>
           
                </div>
            </div>

		 
 <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  							<?php
		                            wp_nav_menu( array(
			                        'theme_location'    => 'primary',
			                        'depth'             => 2,
			                        'container'         => 'div',
			                        'menu_class' => 'nav sidebar-nav',
			                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
			                        'walker'            => new WP_Bootstrap_Navwalker(),
		                             ) );
		                         ?>
</div>  


			<?php if ( get_header_image() ) : ?>
				<?php
					/**
					 * Filter the default xtron custom header sizes attribute.
					 *
					 * @since xtron 
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
					$custom_header_sizes = apply_filters( 'xtron_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
				?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>

 
