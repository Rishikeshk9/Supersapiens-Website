(function(window, document, $) {

    "use strict";

    function wavoOdometer($scope,$) {
        $scope.find('.nt-btn-6').on('mouseenter', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
        })
        .on('mouseout', function(e) {
            var parentOffset = $(this).offset(),
            relX = e.pageX - parentOffset.left,
            relY = e.pageY - parentOffset.top;
            $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
        });
        //$('[href=#]').click(function(){return false});
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wavo-button2.default', wavoOdometer);
    });

})(window, document, jQuery);
