define([
    'jquery',
    'ko',
    'uiComponent'], function ($, ko, Component) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Training_DI/delivery_date'
        },
        initialize: function () {
            this._super();

            return this;
        },
    });});
