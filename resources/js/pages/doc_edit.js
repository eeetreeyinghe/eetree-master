(function ($) {
    var page = function (options) {
        var oldMinderData = options.docDraft.content;

        $('.doc-share').click(function(){
            axios({
                method: 'post',
                url: options.docDraft.setShareUrl,
            }).then(function (res) {
                //TODO 弹框提示
                Modal.alert({
                    title: '分享成功',
                    msg: '<input  id="shareLink" class="copy-cont" value="' + options.docDraft.shareUrl + '" readonly="readonly" /><input class="btn btn-primary" type="button" onclick="copyurl()" value="点击复制">',
                })
            });
        });
        $('.doc-save').click(function(){
            saveDoc('manual');
        })
        
        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('help-block');
                element.parent('div').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parent('div').addClass('has-error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parent('div').removeClass('has-error');
            }
        });
        $('.doc-lock').click(function(){
            if (!options.docDraft.doc_id) {
                $('.doc-publish').trigger('click');
            } else {
                axios({
                    method: 'put',
                    url: options.docDraft.lockUrl,
                }).then(function (res) {
                    toastr.success('操作成功');
                    $('.doc-lock').toggleClass('hide');
                });
            }
        });
        $('.doc-publish').click(function(){
            saveDoc('silence');
            var editHistory = '';
            if (options.docDraft.doc_id > 0) {
                editHistory = '<div class="form-group row">\
                    <label for="docHistory" class="col-sm-2 col-form-label">修订说明</label>\
                    <div class="col-sm-10">\
                        <textarea class="form-control" id="docHistory" name="docHistory" placeholder="请填写您的文档修订说明，10到100个字符" rows="3"></textarea>\
                    </div>\
                </div>';
            }
            var submitMsg = '发布需要管理员审核，审核通过后即会公开文档';
            if (options.docDraft.type == 'cv') {
                submitMsg = '发布需要管理员审核';
            }
            Modal.confirm({
                title: '确认',
                msg: '<form id="publishDoc"><div class="text-muted" style="margin-bottom: 10px;">' + submitMsg + '</div>\
                <div class="form-group row">\
                    <label for="docDescription" class="col-sm-2 col-form-label">描述</label>\
                    <div class="col-sm-10">\
                        <textarea class="form-control" id="docDescription" name="docDescription" placeholder="请填写您的文档描述，10到100个字符" rows="3">' + options.docDraft.desc + '</textarea>\
                    </div>\
                </div>' + editHistory +
                '</form>',
            }).on(function (e) {
                e.stopPropagation();
                var rules = {
                    docDescription: {
                        required: true,
                        minlength: 10,
                        maxlength: 100,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    },
                };
                if (editHistory != '') {
                    rules.docHistory = {
                        required: true,
                        minlength: 10,
                        maxlength: 100,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    }
                }
                var validator = $("#publishDoc").validate({
                    rules: rules
                });
                if (!validator.form()) {
                    return false
                }
                var saveData = {
                    description: $.trim($('#docDescription').val()),
                }
                if (editHistory !=  '') {
                    saveData.edit_history = $.trim($('#docHistory').val())
                }
                axios({
                    method: 'post',
                    url: options.docDraft.publishUrl,
                    data: saveData
                }).then(function (res) {
                    toastr.success('发布成功，待管理员审核');
                    Modal.close();
                });
            });
        });
        
        var docSaving = false
        function saveDoc(type) {
            var newMinderData = minder.exportJson();
            var newMinderDataJson = JSON.stringify(newMinderData);
            if (newMinderDataJson != oldMinderData && !docSaving) {
                // save
                docSaving = true
                $.ajax({
                    async: false,
                    type: 'put',
                    url: options.docDraft.saveUrl,
                    data: {
                        content: newMinderDataJson
                    },
                    success: function (res) {
                        docSaving = false
                        oldMinderData = newMinderDataJson;
                        if (type == 'manual') {
                            toastr.success('保存成功');
                        } else if (type == 'silence') {
                        } else {
                            toastr.success('已保存');
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        docSaving = false
                    }
                });
            } else if (type == 'manual') {
                toastr.info('未改动');
            }
        }
        
        angular.module('editDocApp', ['kityminderEditor'])
        .config(['configProvider', function (configProvider) {
            configProvider.set('imageUpload', options.docDraft.uploadUrl);
        }])
        .controller('MainController', ['$scope', function($scope) {
            $scope.initEditor = function(editor, minder) {
                window.editor = editor;
                window.minder = minder;
        
                if (typeof oldMinderData == 'object') {
                    minder.importJson(oldMinderData);
                    oldMinderData = JSON.stringify(oldMinderData);
                } else {
                    minder.select(minder.getRoot(), true);
                    minder.execCommand('text', options.docDraft.title);
                    saveDoc('silence');
                }
            };
        }]);
        
        setInterval(saveDoc, 10000)
        
        window.onbeforeunload = function() {
            saveDoc();
        }
        window.onunload = function() {
            saveDoc();
        }
    }
    new page(pageOptions)
})(jQuery);