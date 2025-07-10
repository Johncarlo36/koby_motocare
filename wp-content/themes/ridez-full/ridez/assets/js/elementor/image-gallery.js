(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ridez-image-gallery.default', ($scope) => {
            let $iso = $scope.find('.isotope-grid');
            let $list = $scope.find('.column-item');
            $list.each((index, element) => {
                $(element).hoverdir({
                    speed: 1,
                });
            });

            if ($iso) {
                let currentIsotope = $iso.isotope({filter: '*'});
                $scope.find('.elementor-galerry__filters li').on('click', function () {
                    $(this).parents('ul.elementor-galerry__filters').find('li.elementor-galerry__filter').removeClass('elementor-active');
                    $(this).addClass('elementor-active');
                    let selector = $(this).attr('data-filter');
                    currentIsotope.isotope({filter: selector});
                });
            }
        });
    });

})(jQuery);
