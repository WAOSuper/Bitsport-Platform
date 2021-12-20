(function ($) {
    "use strict";
    redux.field_objects = redux.field_objects || {};
    redux.field_objects.language = redux.field_objects.language || {};
    redux.field_objects.language.fieldID = '';
    redux.field_objects.language.optName = '';
    redux.field_objects.language.init = function (selector) {
        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-language:visible');
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
           
                redux.field_objects.language.deleteFile(el);
                redux.field_objects.language.modInit(el);
            }
        );
    };
    redux.field_objects.language.deleteFile = function (el) {
        $('a#delete-language-file').on('click', function () {
            var $this = $(this);
            var file = el.find('select#language_switcher').val();
            if (file != '') {
                var data = 'file=' + file + '&action=zetra_deleteLanguageFile';
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'json',
                    data: data,
                    beforeSend: function () {
                        $($this).addClass('lang-disabled').html('<i class="el el-refresh el-spin"></i> ' + language.del);
                    }
                }).done(function (res) {
                    $($this).removeClass('lang-disabled').html(language.del);
                    if (res.status === true) {
                        $('select#language_switcher').select2('destroy');
                        $('select#language_switcher').empty();
                        $('select#language_switcher').append(res.msg);
                        $('select#language_switcher').select2();
                        $('select#language_switcher').select2({
                            placeholder: language.switcher,
                            allowClear: true,
                            dropdownCssClass: "language-select2"
                        });
                    }
                });
                return false;
            } else {
                alert(language.selectFile);
            }
            return false;
        });
    }
    redux.field_objects.language.modInit = function (el) {
        el.find('select#language_switcher').select2({
            placeholder: language.switcher,
            allowClear: true,
            dropdownCssClass: "language-select2"
        });
        console.log(el);
        el.find('#upload_file').on('click', function () {
            el.find('form#language_uploader').on('submit', redux.field_objects.language.uploader());
            return false;
        });
    };
    redux.field_objects.language.uploader = function () {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            var formData = new FormData();

            if ($('#language_file').val() == '') {
                $("#error-log").empty();
                $("#error-log").html(language.no_file);
                return false;
            }
            var fsize = $('#language_file')[0].files[0].size;
            var ftype = $('#language_file')[0].files[0].name;
            var extension = ftype.substr((ftype.lastIndexOf(".") + 1));
            switch (extension) {
                case "mo":
                    break;
                default:
                    $("#error-log").empty();
                    $("#error-log").html("<b>" + ftype + "</b> " + language.unsupported);
                    return false
            }

            if (fsize > 1048576) {
                $("#error-log").html("<b>" + redux.field_objects.language.bytesToSize(fsize) + "</b> " + language.bigFile);
                return false
            }
            var progress_bar_id = '#progress-wrp';
            var submit_btn = '#upload_file';
            var result_output = $("#error-log");
            formData.append('action', 'zetra_languageUpload');
            formData.append('language_file', $('#language_file')[0].files[0]);
            $("#error-log").empty();
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
                        $('a#upload_file > i').addClass('el-spin');
                        $('a#upload_file').addClass('lang-disabled');
                        xhr.upload.addEventListener('progress', function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            $(progress_bar_id).show();
                            $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
                            $(progress_bar_id + " .status").text(percent + "%");
                        }, true);
                    }
                    return xhr;
                },
                mimeType: "multipart/form-data"
            }).done(function (res) {
                $(progress_bar_id).hide();
                $('a#upload_file').removeClass('lang-disabled');
                $('a#upload_file > i').removeClass('el-spin');
                $('#language_file').val('');
                $("#error-log").empty();
                if (res.status === true) {
                    $('select#language_switcher').select2('destroy');
                    $('select#language_switcher').empty();
                    $('select#language_switcher').append(res.msg);
                    $('select#language_switcher').select2();
                    $('select#language_switcher').select2({
                        placeholder: language.switcher,
                        allowClear: true,
                        dropdownCssClass: "language-select2"
                    });
                } else {
                    $(result_output).html(res);
                }
            });
        } else {
            $("#error-log").empty();
            $("#error-log").html(language.api_error);
            return false;
        }
        return false;
    };
    redux.field_objects.language.bytesToSize = function (bytes) {
        var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
        if (bytes == 0) return "0 Bytes";
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    }

})(jQuery);