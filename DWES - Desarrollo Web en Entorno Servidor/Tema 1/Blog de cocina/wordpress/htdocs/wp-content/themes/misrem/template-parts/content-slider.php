<?php

echo '<div class="slider__slide" style="background: url( ' . esc_url( get_the_post_thumbnail_url() ) . ') no-repeat center;">';
echo '<div class="container">';
echo '<h2 class="slider__title">' . wp_trim_words( get_the_title(), 10 ) . '</h2>';
echo '<div class="slider__text">';
echo '<p>' . wp_trim_words( get_the_excerpt(), 30 ) . '</p>';
echo '</div>';
echo '<a class="btn" href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() . '">' . __( 'read more', 'misrem' ) . '<span class="btn__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>' . '</a>';
echo '</div>';
echo '</div>';
