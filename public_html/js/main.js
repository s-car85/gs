var mobile = {

    body: jQuery('body'),

    init: function () {
        this.module();
    },

    module: function () {
        this.mobileNavigation();
    },
    mobileNavigation: function () {

        // Close all submenus
        function closeMenus() {
            jQuery('nav li.has-children').each(function () {
                jQuery(this).find('.children').removeClass('visible');
            });
        }

        // Launch
        jQuery('.navigation .icon-menu, .open-mobile-nav').on('click', function () {
            jQuery('.navigation nav').addClass('visible');
            jQuery('html').addClass('mobile-menu-visible');
        });

        // Close
        jQuery('.navigation nav .close-menu').on('click', function () {
            jQuery('.navigation nav').removeClass('visible');
            closeMenus();
            jQuery('html').removeClass('mobile-menu-visible');
        });


        // Nav script
        jQuery('nav li.has-children').on('click', function () {

            var parent = jQuery(this);

            // Tablet
            if (jQuery(window).width() > 768) {

                closeMenus();

                jQuery(this).find('.children').addClass('visible');
            } else if (jQuery(window).width() < 768) {

                // Mobile
                var ulParent = jQuery(this).parent();

                // Hide all ul children excent children of parent clicked
                jQuery('nav li.has-children').not(parent).each(function () {
                    jQuery(this).find('.children').css('visibility', 'hidden');
                });

                jQuery('nav .go-back-icon').show().on('click', function () {
                    ulParent.animate({
                        left: '0'
                    }, 500);

                    // Hide back icon
                    jQuery(this).hide();

                    // Show all ul children
                    setTimeout(function () {
                        jQuery('nav li.has-children').each(function () {
                            jQuery(this).find('.children').css('visibility', 'visible');
                        });
                    }, 500);
                });

                ulParent.animate({
                    left: '-100%'
                }, 500);
            }

            // Position Fix
            jQuery(window).on('resize', function () {
                if (jQuery(window).width() > 768) {
                    jQuery('nav ul').first().css('left', '20%');
                } else if (jQuery(window).width() < 768) {
                    jQuery('nav ul').first().css('left', '0');
                }
            });
        });

    },
};

jQuery(document).ready(function () {
    mobile.init();
});