(function ($) {
    "use strict";
    redux.field_objects = redux.field_objects || {};
    redux.field_objects.social_media = redux.field_objects.social_media || {};
    redux.field_objects.social_media.fieldID = '';
    redux.field_objects.social_media.optName = '';
    $(document).ready(
            function () {

            }
    );
    redux.field_objects.social_media.init = function (selector) {
        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-social_media:visible');
        }

        $(selector).each(
                function () {
                    var el = $(this);
                    var parent = el;
                    if (!el.hasClass('redux-field-container')) {
                        parent = el.parents('.redux-field-container:first');
                    }
                    if (parent.is(":hidden")) { // Skip hidden fields
                        return;
                    }
                    if (parent.hasClass('redux-field-init')) {
                        parent.removeClass('redux-field-init');
                    } else {
                        return;
                    }
                    redux.field_objects.social_media.modInit(el);
                    redux.field_objects.social_media.initReset(el);
                }
        );
    };
    redux.field_objects.social_media.modInit = function (el) {
    
        redux.field_objects.social_media.fieldID = el.find('.icons-pack').data('id');
        redux.field_objects.social_media.optName = el.find('.icons-pack').data('opt-name');
        el.find('.icons-sec').enscroll();
        el.find('div.icons-pack .icons-sec ul > li').on('click', function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                var key = $(this).data('key');
                el.find('li#redux-social_meida-' + key).slideDown();

                redux.field_objects.social_media.updateDataString = function (el, key, name, value) {
                    var dataEl = el.find('.redux-social_media-hidden-data-' + key);
                    var rawData = dataEl.val();

                    rawData = decodeURIComponent(rawData);
                    rawData = JSON.parse(rawData);
                    rawData[name] = value;

                    rawData = JSON.stringify(rawData);
                    rawData = encodeURIComponent(rawData);

                    dataEl.val(rawData);
                };
                redux.field_objects.social_media.updateDataString(el, key, 'enable', 'true');
                el.find('.redux-social_media-url-text-' + key).on('blur', function () {
                    var key = $(this).data('key');
                    var val = $(this).val();
                    redux.field_objects.social_media.updateDataString(el, key, 'url', val);
                });
                el.find('span.del-btn').on('click', function () {
                    redux.field_objects.social_media.updateDataString(el, key, 'enable', '');
                    el.find('div.icons-pack div.icons-sec > ul li').each(function () {
                        var getKey = $(this).data('key');
                        if (getKey === key) {
                            $(this).removeClass('active');
                            el.find('li#redux-social_meida-' + key).slideUp();
                        }
                    });
                });
                var palette = [
                    ["#000000", "#434343", "#666666", "#999999", "#b7b7b7", "#cccccc", "#d9d9d9", "#efefef", "#f3f3f3", "#ffffff"],
                    ["#980000", "#ff0000", "#ff9900", "#ffff00", "#00ff00", "#00ffff", "#4a86e8", "#0000ff", "#9900ff", "#ff00ff"],
                    ["#e6b8af", "#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d9ead3", "#c9daf8", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                    ["#dd7e6b", "#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#a4c2f4", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                    ["#cc4125", "#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6d9eeb", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                    ["#a61c00", "#cc0000", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3c78d8", "#3d85c6", "#674ea7", "#a64d79"],
                    ["#85200c", "#990000", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#1155cc", "#0b5394", "#351c75", "#741b47"],
                    ["#5b0f00", "#660000", "#783f04", "#7f6000", "#274e13", "#0c343d", "#1c4587", "#073763", "#20124d", "#4c1130"]
                ];
                el.find('input.redux-social_media-color-picker-' + key).spectrum({
                    showAlpha: true,
                    showInput: true,
                    allowEmpty: true,
                    className: 'redux-full-spectrum',
                    showInitial: true,
                    showPalette: true,
                    showSelectionPalette: true,
                    clickoutFiresChange: true,
                    preferredFormat: 'rgb',
                    localStorageKey: 'redux.social-profiles.spectrum',
                    palette: palette,
                    change: function (color) {
                        var className;
                        el.find('li#redux-social_meida-' + key + ' span.icon-title > i').css({
                            'color': color.toRgbString()
                        });
                        className = 'color';
                        redux.field_objects.social_media.updateDataString(el, key, className, color.toRgbString());
                    }
                });
                el.find('input.redux-social_media-background-picker-' + key).spectrum({
                    showAlpha: true,
                    showInput: true,
                    allowEmpty: true,
                    className: 'redux-full-spectrum',
                    showInitial: true,
                    showPalette: true,
                    showSelectionPalette: true,
                    clickoutFiresChange: true,
                    preferredFormat: 'rgb',
                    localStorageKey: 'redux.social-profiles.spectrum',
                    palette: palette,
                    change: function (color) {
                        var className;
                        el.find('li#redux-social_meida-' + key + ' span.icon-title > i').css({
                            'background': color.toRgbString()
                        });
                        className = 'background';
                        redux.field_objects.social_media.updateDataString(el, key, className, color.toRgbString());
                    }
                });


            }
        });
    };

    redux.field_objects.social_media.initReset = function (el) {
        el.find('button.clear-btn').on('click', function () {
            var buttonClicked = $(this);
            if (buttonClicked.length > 0) {
                var itemToReset = buttonClicked.data('value');
                redux.field_objects.social_media.resetItem(el, itemToReset);
            }
            return false;
        });
    };

    redux.field_objects.social_media.resetItem = function (el, itemID) {
        el.find('input.redux-social_media-color-picker-' + itemID).spectrum("set", '');
        el.find('input.redux-social_media-background-picker-' + itemID).spectrum("set", '');
        redux.field_objects.social_media.updateDataString(el, itemID, 'color', '');
        redux.field_objects.social_media.updateDataString(el, itemID, 'background', '');
        redux.field_objects.social_media.updateDataString(el, itemID, 'url', '');
        el.find('.redux-social_media-url-text-' + itemID).val('');
        el.find('li#redux-social_meida-' + itemID + ' span.icon-title > i').css({
            'background': 'inherit',
            'color': 'inherit'
        });
        return false;
    };

})(jQuery);