define(['zepto', 'ajax', 'page.params'], function ($, ajax, params) {


    function _store(opts) {
        ajax({
            type: 'POST',
            url: '/api/sign/user-sign',
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    }

    return {
        store: _store
    };
});