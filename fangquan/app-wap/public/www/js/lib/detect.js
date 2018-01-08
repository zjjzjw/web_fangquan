define(['zepto', 'zepto', 'zepto.sp'], function($, plugins, sp) {
    "use strict";

    $.env = $.env || {};
    (function(env, window) {

        // --------------------------------------------
        // Detect connection type.
        // --------------------------------------------
        /**
         * Detect connection type.
         * Values of `connection.type` list as following:
         *  - bluetooth
         *  - cellular: EDGE, 3G, 4G, etc.
         *      2: wifi : 0?
         *      3: 2G
         *      3: 3G
         *  - ethernet
         *  - none
         *  - wifi
         *  - other
         *  - unknown
         *
         * @returns {*}
         */
        function detectNetworkType() {
            var navigator = window.navigator,
                connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection || {},
                userAgent = navigator.userAgent,
                netType = connection.type,
                userAgentSegments;

            if (undefined === netType) {
                // to parse useragent in wechat.
                userAgentSegments = userAgent.match(/NetType\/(\S*)/);
                if (userAgentSegments) {
                    netType = userAgentSegments[1];
                }
            }

            switch (netType) {
                case 2:
                case 'WIFI':
                    netType = 'WIFI';
                    break;
                case '2G':
                    netType = '2G';
                    break;
                case '3G+':
                    netType = '3G+';
                    break;
                default:
                    netType = 'unknown';
                    break;
            }

            $.env.netType = netType;
        }
        detectNetworkType();

        function detectSystemType() {
            var navigator = window.navigator,
                userAgent = navigator.userAgent,
                deviceType,
                sandbox;

            if (userAgent.match(/MicroMessenger/i)) {
                sandbox = 'wechat';
            } else {
                sandbox = 'app';
            }

            if (userAgent.indexOf('Android') > -1 || userAgent.indexOf('Linux') > -1) {
                deviceType = 'android';
            } else {
                deviceType = 'iphone';
            }
            $.env.deviceType = deviceType;
            $.env.sandbox = sandbox;
        }
        detectSystemType();

        // --------------------------------------------
        // Detect network status: online or offline.
        // --------------------------------------------
        function detectNetworkStatus() {
            function updateOnlineStatus(event) {
                var online = window.navigator.onLine; // boolean

                // re-detect network type.
                detectNetworkType();

                // type: online or offline.
                sp.publish('detect.network', {
                    online: online,
                    status: event.type,
                    event: event
                });
            }

            window.addEventListener('online', updateOnlineStatus);
            window.addEventListener('offline', updateOnlineStatus);

        }
        detectNetworkStatus();

        /* jshint ignore:start */
        $.env.isIE = (function() {
            if (!+[1, ]) {
                return true;
            } else {
                return false;
            }
        })();
        /* jshint ignore:end */

    })($.env, window);

});