(function(window, document, $) {

    "use strict";

    function wavoOdometer() {
        var wow = new WOW({
            boxClass: 'odometer',
            animateClass: 'wavo-odometer',
            offset: 100,
            callback: function ( el ){
                var myOdometers = $(el),
                    myID = myOdometers.attr('id'),
                    myData = myOdometers.data('wavo-odometer'),
                    myTheme = myData.theme,
                    myNumber = myData.number,
                    myNumber2 = myData.number2,
                    myTimeout = myData.timeout,
                    myFormat = myData.format,
                    myOdometer = document.getElementById(myID),
                    od = new Odometer({
                      el: myOdometer,
                      value: myNumber,
                      format: myFormat,
                      theme: myTheme,
                    });

                od.update(myNumber2);
            }
        });
        wow.init();
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wavo-odometer.default', wavoOdometer);
    });

})(window, document, jQuery);
