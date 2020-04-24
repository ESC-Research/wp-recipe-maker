import animateScrollTo from 'animated-scroll-to';

jQuery(document).ready(function($) {
    jQuery(document).on('click', '.wprm-jump-smooth-scroll', function(e) {
        e.preventDefault();

        const link = jQuery(this);
        const target = link.attr('href');

        // Get smooth scroll speed.
        let speed = parseInt( link.data( 'smooth-scroll' ) );
        if ( speed < 0 ) {
            speed = 500;
        }

        animateScrollTo( document.querySelector(target), {
            verticalOffset: -100,
            speed,
        } );
    });
});