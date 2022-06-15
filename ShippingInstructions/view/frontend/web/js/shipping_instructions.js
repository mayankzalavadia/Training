define([
    'jquery',
    'ko',
    'uiComponent'], function ($, ko, Component) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Training_ShippingInstructions/shipping_instructions'
        },
        initialize: function () {
            this._super();

            return this;
        },
    });});
