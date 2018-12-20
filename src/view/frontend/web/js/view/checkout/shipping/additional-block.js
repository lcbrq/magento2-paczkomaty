define([
    'ko',
    'jquery',
    'uiComponent',
    'uiRegistry',
    'mage/translate'
], function (ko, $, Component, uiRegistry, $t) {
    'use strict';

    var Paczkomat = function (code, name) {
        this.paczkomatCode = code;
        this.paczkomatName = name;
    };

    return Component.extend({

        paczkomatyPoints: ko.observableArray([]),
        selectedPaczkomat: ko.observable(),

        defaults: {
            template: 'Flexishore_Paczkomaty/checkout/shipping/additional-block'
        },
        
        afterRender: function() {
            alert('o');
            this._super();
        },

        getPoints: function () {
            var city, self = this;
            var cityDomID = uiRegistry.get('checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.city').uid;
            $('#' + cityDomID).focusout(function () {
                city = $(this).val();
                self.paczkomatyPoints([]);
                if(city) {
                    $.getJSON('/paczkomaty?city=' + city, function (data) {
                        var points = data.items;
                        $.each(points, function (id, point) {
                            self.paczkomatyPoints.push(new Paczkomat(point.name, point.city + ' ' + point.street));
                        });
                    });
                }
            });
            
            return this.paczkomatyPoints;
        }

    });



});