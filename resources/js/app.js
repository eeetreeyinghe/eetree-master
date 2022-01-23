
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import ElementUI from 'element-ui';

window.Notification = ElementUI.Notification;

require('./bootstrap');

window.Vue = require('vue');
Vue.use(ElementUI);
import enums from '@/js/utils/enums'

// 先注释掉
(function($){
    $(document).ready(function(){
        $('.clk-tab-doc').on('click',function() {
            if (!/explore\/doc/.test(location.href)) {
                $('#navSearch').attr('action', '/explore/doc');
                $('#navSearch').submit();
            }
        });
        $('.clk-tab-project').on('click',function() {
            if (!/explore\/project/.test(location.href)) {
                $('#navSearch').attr('action', '/explore/project');
                $('#navSearch').submit();
            }
        });
        $('.toggle-fav').on('click',function() {
            if ($('.no-login').length > 0) {
                location.href = '/login';
                return;
            }
            if ($(this)[0].tagName === 'I') {
                var self = $(this);
            } else {
                var self = $(this).find('i').eq(0);
            }
            if (self.hasClass('fa-star')) {
                axios({
                    method: 'delete',
                    url: '/favorites/' + self.data('id'),
                }).then(function (res) {
                    self.removeClass('fa-star').addClass('fa-star-o');
                });
            } else {
                axios({
                    method: 'post',
                    url: '/favorites',
                    data: {fav_id: self.data('fav_id')}
                }).then(function (res) {
                    self.data('id', res.data.id)
                    self.removeClass('fa-star-o').addClass('fa-star');
                });
            }
        });
        $('.toggle-like').on('click',function() {
            if ($('.no-login').length > 0) {
                location.href = '/login';
                return;
            }
            if ($(this)[0].tagName === 'I') {
                var self = $(this);
            } else {
                var self = $(this).find('i').eq(0);
            }
            if (self.hasClass('fa-thumbs-up')) {
                axios({
                    method: 'delete',
                    url: '/likes/' + self.data('id'),
                }).then(function (res) {
                    self.removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                });
            } else {
                axios({
                    method: 'post',
                    url: '/likes',
                    data: {like_id: self.data('like_id')}
                }).then(function (res) {
                    self.data('id', res.data.id)
                    self.removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                });
            }
        });
        $('.toggle-fav-prj').on('click',function() {
            if ($('.no-login').length > 0) {
                location.href = '/login';
                return;
            }
            if ($(this)[0].tagName === 'I') {
                var self = $(this);
            } else {
                var self = $(this).find('i').eq(0);
            }
            if (self.hasClass('el-icon-star-on')) {
                axios({
                    method: 'delete',
                    url: '/favorites/' + self.data('id'),
                }).then(function (res) {
                    self.removeClass('el-icon-star-on').addClass('el-icon-star-off');
                });
            } else {
                axios({
                    method: 'post',
                    url: '/favorites',
                    data: {fav_id: self.data('fav_id'), type: enums.types.project}
                }).then(function (res) {
                    self.data('id', res.data.id)
                    self.removeClass('el-icon-star-off').addClass('el-icon-star-on');
                });
            }
        });

        window.Modal = function() {
            var reg = new RegExp("\\[([^\\[\\]]*?)\\]", 'igm');
            var alr = $("#xyModal").eq(0);
            var ahtml = alr.html();
    
            var _tip = function(options, sec) {
                alr.html(ahtml); // 复原  
                alr.find('.ok').hide();
                alr.find('.cancel').hide();
                alr.find('.modal-content').width(500);
                _dialog(options, sec);
        
                return {
                    on: function(callback) {}
                };
            };
    
            var _alert = function(options) {
                alr.html(ahtml); // 复原  
                alr.find('.ok').removeClass('btn-success').addClass('btn-primary');
                alr.find('.cancel').hide();
                _dialog(options);
        
                return {
                    on: function(callback) {
                        if (callback && callback instanceof Function) {
                            alr.find('.ok').click(function() {
                                callback(true)
                            });
                        }
                    }
                };
            };
        
            var _confirm = function(options) {
                alr.html(ahtml); // 复原  
                alr.find('.ok').removeClass('btn-primary').addClass('btn-success');
                alr.find('.cancel').show();
                _dialog(options);
        
                return {
                    on: function(callback) {
                        if (callback && callback instanceof Function) {
                            alr.find('.ok').click(function(e) {
                                callback(e)
                            });
                            alr.find('.cancel').click(function() {
                                return;
                            });
                        }
                    }
                };
            };
        
            var _dialog = function(options) {
                var ops = {
                    msg: "提示内容",
                    title: "操作提示",
                    btnok: "确定",
                    btncl: "取消"
                };
        
                $.extend(ops, options);
    
                var html = alr.html().replace(reg, function(node, key) {
                    return {
                        Title: ops.title,
                        Message: ops.msg,
                        BtnOk: ops.btnok,
                        BtnCancel: ops.btncl
                    } [key];
                });
    
                alr.html(html);
                alr.modal({
                    width: 250,
                    backdrop: 'static'
                });
            }
        
            return {
                tip: _tip,
                alert: _alert,
                confirm: _confirm,
                close: function() {
                    alr.modal('hide')
                }
            }
        
        } ();
    });
    

    $.fn.sms = function(options) {
        var self = this;
        var btnOriginContent, timeId;
        var opts = $.extend(true, {}, $.fn.sms.defaults, options);
        self.on('click', function (e) {
            if (valid()) {
                btnOriginContent = self.html() || self.val() || '';
                changeBtn(opts.language.sending, true);
                send();
            }
        });

        function valid() {
            var requestData = getRequestData();
            if (!/^1[0-9]{10}$/.test(requestData.mobile)) {
                Notification({
                    title: 'Error',
                    message: '手机号格式错误',
                    type: 'error'
                })
                return false;
            }
            if (opts.captcha === 1 && requestData.captcha === '') {
                Notification({
                    title: 'Error',
                    message: '请填写图片校验码',
                    type: 'error'
                })
                return false;
            }
            return true;
        }

        function send() {
            var url = getUrl();
            var requestData = getRequestData();

            axios({
                method: 'post',
                url: url,
                data: requestData,
            }).then(function (res) {
                timer(opts.interval);
            }).catch(function (error) {
                changeBtn(btnOriginContent, false);
            });
        }

        function getUrl() {
            return opts.requestUrl ||
              '/sms/' + (opts.voice ? 'voice' : 'code')
        }

        function getRequestData() {
            var requestData = { _token: opts.token || '' };
            var data = $.isPlainObject(opts.requestData) ? opts.requestData : {};
            $.each(data, function (key) {
                if (typeof data[key] === 'function') {
                    requestData[key] = data[key].call(requestData);
                } else {
                    requestData[key] = data[key];
                }
            });

            return requestData;
        }

        function timer(seconds) {
            var btnText = opts.language.resendable;
            btnText = typeof btnText === 'string' ? btnText : '';
            if (seconds < 0) {
                clearTimeout(timeId);
                changeBtn(btnOriginContent, false);
            } else {
                timeId = setTimeout(function() {
                    clearTimeout(timeId);
                    changeBtn(btnText.replace('{{seconds}}', (seconds--) + ''), true);
                    timer(seconds);
                }, 1000);
            }
        }

        function changeBtn(content, disabled) {
            self.html(content);
            self.val(content);
            self.prop('disabled', !!disabled);
        }
    };

    $.fn.sms.defaults = {
        token       : null,
        interval    : 60,
        voice       : false,
        requestUrl  : null,
        requestData : null,
        language    : {
            sending    : '短信发送中...',
            failed     : '请求失败，请重试',
            resendable : '{{seconds}} 秒后再次发送'
        }
    };
})(window.jQuery);

