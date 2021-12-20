jQuery(function($) {
    $(document).ready(function() {

        $('.redux-container').each( function() {
            if ( ! $(this).hasClass('redux-no-sections') ) {
                $(this).find('#redux-sticky').prepend('<div class="redux-search-bar"><span class="dashicons dashicons-search"></span><input class="redux_field_search" name="" type="text" placeholder="' + reduxsearch + '"/></div>');
            }
        } );

        $( '.redux_field_search' ).keypress( function (evt) {
            //Deterime where our character code is coming from within the event
            var charCode = evt.charCode || evt.keyCode;
            if (charCode  == 13) { //Enter key's keycode
                return false;
            }
        } );

        var
        redux_container = $('.redux-container'),
        redux_option_tab_extras = redux_container.find('.redux-section-field, .redux-info-field, .redux-notice-field, .redux-container-group, .redux-section-desc, .redux-group-tab h3, .redux-accordion-field'),
        search_targets = redux_container.find( '.form-table tr, .redux-group-tab'),
        redux_menu_items = $('.redux-group-menu .redux-group-tab-link-li');

        jQuery('.redux_field_search').typeWatch({

            callback:function( searchString ){
                searchString = searchString.toLowerCase();
                var searchArray = searchString.split(',');

                if ( searchString !== '' && searchString !== null && typeof searchString !== 'undefined' && searchString.length > 2 ) {
                    // Add a class to the redux container
                    $('.redux-container').addClass('redux-redux-search');
                    // Show accordion content / options
                    $('.redux-accordian-wrap').show();

                    // Hide option fields and tabs
                    redux_option_tab_extras.hide();
                    search_targets.hide();

                    // Show matching results
                    search_targets.filter( function () {
                        var
                        item = $(this),
                        matchFound = true,
                        text = item.find('.redux_field_th').text().toLowerCase();

                        if ( ! text || text == '' ) {
                            return false;
                        }

                        $.each( searchArray, function ( i, searchStr ) {
                            if ( text.indexOf( searchStr ) == -1 ) {
                                matchFound = false;
                            }
                        });

                        if ( matchFound ) {
                            item.show();
                        }

                        return matchFound;

                    } ).show();

                    // Initialize option fields
                    $.redux.initFields();

                } else {
                    // remove the search class from .redux-container if it exists
                    $('.redux-container').removeClass('redux-redux-search');

                    // Get active options tab id
                    var tab = $.cookie( 'redux_current_tab' );

                    // Show the last tab that was active before the search
                    $('.redux-group-tab').hide();
                    $('.redux-accordian-wrap').hide();
                    redux_option_tab_extras.show();
                    $('.form-table tr').show();
                    $('.form-table tr.hide').hide();
                    $('.redux-notice-field.hide').hide();
                    $( '#' + tab + '_section_group' ).show();

                }

            },

            wait: 800,
            highlight: false,
            captureLength: 0,

        } );

    } );

} );
