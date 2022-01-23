define(function(require, exports, module) {

    var kity = require('../core/kity');
    var keymap = require('../core/keymap');

    var Module = require('../core/module');
    var Command = require('../core/command');

    Module.register('VideoViewer', function() {

        function createEl(name, classNames, children) {
            var el = document.createElement(name);
            addClass(el, classNames);
            children && children.length && children.forEach(function (child) {
                el.appendChild(child);
            });
            return el;
        }

        function on(el, event, handler) {
            el.addEventListener(event, handler);
        }

        function addClass(el, classNames) {
            classNames && classNames.split(' ').forEach(function (className) {
                el.classList.add(className);
            });
        }

        function removeClass(el, classNames) {
            classNames && classNames.split(' ').forEach(function (className) {
                el.classList.remove(className);
            });
        }

        var VideoViewer = kity.createClass('VideoViewer', {
            constructor: function () {
                var btnClose = createEl('button', 'km-video-viewer-btn km-video-viewer-close');
                var toolbar = this.toolbar = createEl('div', 'km-video-viewer-toolbar', [btnClose]);
                var container = this.iframeContainer = createEl('div', 'km-video-viewer-container');
                var viewer = this.videoViewer = createEl('div', 'km-video-viewer', [toolbar, container]);
                this.hotkeyHandler = this.hotkeyHandler.bind(this)
                on(btnClose, 'click', this.close.bind(this));
                on(viewer, 'contextmenu', this.toggleToolbar.bind(this));
                on(document, 'keydown', this.hotkeyHandler);
            },
            dispose: function () {
                this.close();
                document.removeEventListener('remove', this.hotkeyHandler);
            },
            hotkeyHandler: function (e) {
                if (!this.actived) {
                    return;
                }
                if (e.keyCode === keymap['esc']) {
                    this.close();
                }
            },
            toggleToolbar: function (e) {
                e && e.preventDefault();
                this.toolbar.classList.toggle('hidden');
            },
            open: function (iframe) {
                var input = document.querySelector('input');
                if (input) {
                    input.focus();
                    input.blur();
                }
                this.iframeContainer.innerHTML = iframe;
                document.body.appendChild(this.videoViewer);
                this.actived = true;
            },
            close: function () {
                this.iframeContainer.innerHTML = '';
                document.body.removeChild(this.videoViewer);
                this.actived = false;
            }
        });

        return {
            init: function() {
                this.videoViewer = new VideoViewer();
            },
            events: {
                'normal.dblclick': function(e) {
                    var shape = e.kityEvent.targetShape
                    if (shape.__KityClassName === 'Image' && shape.url && shape.getData('video')) {
                        this.videoViewer.open(shape.getData('video'));
                    }
                }
            }
        };
    });
});