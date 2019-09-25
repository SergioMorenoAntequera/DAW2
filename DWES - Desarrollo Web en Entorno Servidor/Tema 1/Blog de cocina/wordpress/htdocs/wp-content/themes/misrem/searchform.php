<?php $unique_id = uniqid( 'search-form-' ); ?>

<form role="search" method="get" class="search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'misrem' ); ?></span>
	</label>
	<input type="text" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'misrem' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search__submit" title="<?php esc_attr__( 'search', 'misrem' ) ?>"><i class="fa fa-search" aria-hidden="true"></i><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'misrem' ); ?></span></button>
	<button class="search__close" title="<?php esc_attr__( 'close search form', 'misrem' ) ?>">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</form>
