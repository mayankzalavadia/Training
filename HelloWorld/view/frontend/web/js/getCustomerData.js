define(
    [
        'uiComponent',
        'ko',
        'jquery',
        'Magento_Customer/js/customer-data',
        'mage/translate'
    ],
    function (Component, ko,jquery, customerData, $t) {
        'use strict';
        return Component.extend({
            customerDetails: customerData, /*return  boolean true/false */
            initialize: function() {
                this._super();
            },
            getCustomer: function () {
                const details = this.customerDetails.get('customer')();
                return details?.fullname;
            }
        });
    });
