define(['zepto', 'page.params', 'validate',
    'ui.popup', 'app/service/exhibition/sign/signService'
], function ($, params, mvalidate, Popup, service) {
    'use strict';


    var $loadingPop;

    $loadingPop = new Popup({
        width: 128,
        height: 128,
        contentBg: 'transparent',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#loadingTpl').html()
    });

    //完成签到
    $('#form').mvalidate({
        type: 2,
        onKeyup: true,
        sendForm: false,
        firstInvalidFocus: true,
        valid: function (event, options) {
            //点击提交按钮时, 表单通过验证触发函数
            $loadingPop.showPop();
            service.store(
                {
                    data: $('#form').serialize(),
                    sucFn: function (data, status, xhr) {
                        $loadingPop.closePop();
                        window.location.href = '/exhibition/sign/sign-success?user_id=' + data.id;
                    },
                    errFn: function (data, xhr, errorType, error) {
                        $loadingPop.closePop();
                        window.location.href = '/exhibition/sign/sign-fail';
                    }
                }
            );
            event.preventDefault();
        },
        invalid: function (event, status, options) {
            //点击提交按钮时,表单未通过验证触发函数
        },
        eachField: function (event, status, options) {
            //点击提交按钮时,表单每个输入域触发这个函数 this 执向当前表单输入域，是jquery对象
        },
        eachValidField: function (val) {
        },
        eachInvalidField: function (event, status, options) {
        },
        descriptions: {
            name: {
                required: '请输入姓名',
                valid: ''
            }
        }
    });

    //权限信息数据处理
    function showError(data) {
        var info = '';
        var messages = [];
        var i = 0;
        for (var key in data) {
            messages.push(++i + "、" + data[key][0]);
        }
        info = messages.join('</br>');
        return info;
    }
});
