(function ($) {
    "use strict";
    redux.field_objects = redux.field_objects || {};
    redux.field_objects.fonts = redux.field_objects.fonts || {};
    redux.field_objects.fonts.fieldID = '';
    redux.field_objects.fonts.optName = '';

    redux.field_objects.fonts.init = function (selector) {
        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-fonts:visible');
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
               
                redux.field_objects.fonts.deleteFile(el);
                redux.field_objects.fonts.modInit(el);
            }
        );
    };
    redux.field_objects.fonts.deleteFile = function (el) {
        $('a#delete-mo-file').on('click', function () {
            var $this = $(this);
            var file = el.find('select#fonts_switcher').val();
            if (file != '') {
                var data = 'file=' + file + '&action=zetra_deleteFontsFile';
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'json',
                    data: data,
                    beforeSend: function () {
                        $($this).addClass('lang-disabled').html('<i class="el el-refresh el-spin"></i> ' + fonts.del);
                    }
                }).done(function (res) {
                    $($this).removeClass('lang-disabled').html(fonts.del);
                    if (res.status === true) {
                        $('select#fonts_switcher').select2('destroy');
                        $('select#fonts_switcher').empty();
                        $('select#fonts_switcher').append(res.msg);
                        $('select#fonts_switcher').select2();
                        $('select#fonts_switcher').select2({
                            placeholder: fonts.switcher,
                            allowClear: true,
                            dropdownCssClass: "fonts-select2"
                        });
                    }
                });
                return false;
            } else {
                alert(fonts.selectFile);
            }
            return false;
        });
    }
    redux.field_objects.fonts.modInit = function (el) {
        el.find('select#fonts_switcher').select2({
            placeholder: fonts.switcher,
            allowClear: true,
            dropdownCssClass: "fonts-select2"
        });
        el.find('#font_upload_file').on('click', function () {

            el.find('form#fonts_uploader').on('submit', redux.field_objects.fonts.uploader());
            return false;
        });
    };
    redux.field_objects.fonts.uploader = function () {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            var formData = new FormData();
            
            if ($('#fonts_file').val() == '') {
                $("#fonts-error-log").empty();
                $("#fonts-error-log").html(fonts.no_file);
                return false;
            }
            var fsize = $('#fonts_file')[0].files[0].size;
            var ftype = $('#fonts_file')[0].files[0].name;
            var extension = ftype.substr((ftype.lastIndexOf(".") + 1));
            switch (extension) {
                case "otf":
                    break;
                case "eot":
                    break;
                case "ttf":
                    break;
                case "woff":
                    break;
                default:
                    $("#fonts-error-log").empty();
                    $("#fonts-error-log").html("<b>" + ftype + "</b> " + fonts.unsupported);
                    return false
            }

            if (fsize > 1048576) {
                $("#fonts-error-log").html("<b>" + redux.field_objects.fonts.bytesToSize(fsize) + "</b> " + fonts.bigFile);
                return false
            }
            var progress_bar_id = '#font-progress-wrp';
            var submit_btn = '#font_upload_file';
            var result_output = $("#fonts-error-log");
            formData.append('action', 'zetra_fontsUpload');
            formData.append('fonts_file', $('#fonts_file')[0].files[0]);
            $("#fonts-error-log").empty();
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                xhr: function () {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        $('a#font_upload_file > i').addClass('el-spin');
                        $('a#font_upload_file').addClass('lang-disabled');
                        xhr.upload.addEventListener('progress', function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            $(progress_bar_id).show();
                            $(progress_bar_id + " .fonts-progress-bar").css("width", +percent + "%");
                            $(progress_bar_id + " .status").text(percent + "%");
                        }, true);
                    }
                    return xhr;
                },
                mimeType: "multipart/form-data"
            }).done(function (res) {
                $(progress_bar_id).hide();
                $('a#font_upload_file').removeClass('lang-disabled');
                $('a#font_upload_file > i').removeClass('el-spin');
                $('#fonts_file').val('');
                $("#fonts-error-log").empty();
                if (res.status === true) {
                    $('select#fonts_switcher').select2('destroy');
                    $('select#fonts_switcher').empty();
                    $('select#fonts_switcher').append(res.msg);
                    $('select#fonts_switcher').select2();
                    $('select#fonts_switcher').select2({
                        placeholder: fonts.switcher,
                        allowClear: true,
                        dropdownCssClass: "fonts-select2"
                    });
                } else {
                    $(result_output).html(res);
                }
            });
        } else {
            $("#fonts-error-log").empty();
            $("#fonts-error-log").html(fonts.api_error);
            return false;
        }
        return false;
    };
    redux.field_objects.fonts.bytesToSize = function (bytes) {
        var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
        if (bytes == 0) return "0 Bytes";
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    }

})(jQuery);