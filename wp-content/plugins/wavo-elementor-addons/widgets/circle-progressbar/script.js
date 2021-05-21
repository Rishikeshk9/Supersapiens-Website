(function(window, document, $) {

    "use strict";

    function wavoCircleProgresbar($scope,$) {
        const myCircle = $scope.find('.circle--progressbar');
        const myType = myCircle.data('type');
        if ( myType === 'counter' ) {
            myCircle.circleProgress({ startAngle: -Math.PI/2 }).on('circle-animation-progress', function(event, progress, stepValue) {
                $(this).find('strong').html(Math.round(100 * stepValue) + '<i>%</i>');
            });
        } else if ( myType === 'counter2' ) {
            myCircle.circleProgress({ startAngle: -Math.PI/2 }).on('circle-animation-progress', function(event, progress, stepValue) {
                $(this).find('strong').text(stepValue.toFixed(2).substr(1));
            });
        } else {
            myCircle.circleProgress({ startAngle: -Math.PI/2 });
        }
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wavo-circle-progresbar.default', wavoCircleProgresbar);
    });

})(window, document, jQuery);
