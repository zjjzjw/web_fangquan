$(function () {
    var Popup = require('../../../component/popup');
    var temp = require('../../../component/temp');
    var service = require('../../../service/developer/loupanService');
    var Area = require('../../../component/area');
    var Search = require('./../../../component/search');
    $successPop = new Popup({
        width: 200,
        height: 150,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#successTpl').html()
    });
    $loadingPop = new Popup({
        width: 128,
        height: 128,
        contentBg: 'transparent',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#loadingTpl').html()
    });

    $promptPop = new Popup({
        width: 400,
        height: 225,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#promptTpl').html()
    });

    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function ($form) {
            moreValidate();
            return false;
        }
    });

    function moreValidate() {
        if (parseInt($.params.id) == 0) {
            var opt = {data: {}};
            service.store({
                data: $('#form').serialize(),
                params: $.params,
                beforeSend: function () {
                    $loadingPop.showPop(opt);
                },
                sucFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $successPop.showPop(opt);
                    setTimeout(skipUpdate, 2000);

                    function skipUpdate() {
                        $successPop.closePop();
                        window.location.href = '/developer/loupan/index';
                    }
                },
                errFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $('.text').html(showError(data));
                    $promptPop.showPop(opt);
                }
            });
        } else {
            var opt = {data: {}};
            service.update({
                data: $('#form').serialize(),
                params: $.params,
                beforeSend: function () {
                    $loadingPop.showPop(opt);
                },
                sucFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $successPop.showPop(opt);
                    setTimeout(skipUpdate, 2000);

                    function skipUpdate() {
                        $successPop.closePop();
                        window.location.href = '/developer/loupan/index';
                    }
                },
                errFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $('.text').html(showError(data));
                    $promptPop.showPop(opt);
                }
            });
        }
    }

    //开发商增加
    $(document).on("click", ".add-developer", function () {
        var $information_brand = $.params.information_brand;
        var tpl = temp('developerTpl',{});
        $('.developer-group').append(tpl);
    });

    //开发商删除
    $(document).on("click", ".close-developer", function () {
        $(this).parent().remove();
    });

    //地址
    var area = new Area({'idNames': ['province_id', 'city_id'], 'data': $.params.areas});
    area.selectedId($.params.province_id, $.params.city_id);

    //下拉功能
    var autoComplete = new Search({
        keyword: '#keyword',
        resources: service.getDeveloperByKeyword
    });

    autoComplete.on('search_box_selected', function (data, event) {
        renderInfo.call(this, data, event);
    });
    autoComplete.on('search_box_focus', function (data, event) {
        renderInfo.call(this, data, event);
    });

    function renderInfo(data, event) {
        var item = data.item;
    }

    $(document).on("click", ".developer", function () {
        var that = this;

        var autoComplete = new Search({
            keyword: '.developer',
            resources: service.getDeveloperByKeyword
        });

        autoComplete.on('search_box_selected', function (data, event) {
            renderInfo.call(this, data, event);
        });

        autoComplete.on('search_box_focus', function (data, event) {
            renderInfo.call(this, data, event);
        });

        function renderInfo(data, event) {
            var item = data.item;
            $(that).parent().find('#developer_id').val(item.id);
        }
    });


    $(document).on('click', '#pop_close', function () {
        $promptPop.closePop();
    });

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