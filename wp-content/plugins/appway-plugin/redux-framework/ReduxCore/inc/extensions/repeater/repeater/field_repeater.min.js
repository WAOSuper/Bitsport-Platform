/* global redux_change */

/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.repeater = redux.field_objects.repeater || {};

    $( document ).ready(
        function() {

        }
    );

    redux.field_objects.repeater.sort_repeaters = function( selector ) {
        if ( !selector.hasClass( 'redux-container-repeater' ) ) {
            selector = selector.parents( '.redux-container-repeater:first' );
        }

        selector.find( '.redux-repeater-accordion-repeater' ).each(
            function( idx ) {

                var id = $( this ).attr( 'data-sortid' );
                var input = $( this ).find( "input[name*='[" + id + "]']" );
                input.each(
                    function() {
                        $( this ).attr( 'name', $( this ).attr( 'name' ).replace( '[' + id + ']', '[' + idx + ']' ) );
                    }
                );

                var select = $( this ).find( "select[name*='[" + id + "]']" );
                select.each(
                    function() {
                        $( this ).attr( 'name', $( this ).attr( 'name' ).replace( '[' + id + ']', '[' + idx + ']' ) );
                    }
                );
                $( this ).attr( 'data-sortid', idx );

                // Fix the accordian header
                var header = $( this ).find( '.ui-accordion-header' );
                var split = header.attr( 'id' ).split( '-header-' );
                header.attr( 'id', split[0] + '-header-' + idx );
                split = header.attr( 'aria-controls' ).split( '-panel-' );
                header.attr( 'aria-controls', split[0] + '-panel-' + idx );

                // Fix the accordian content
                var content = $( this ).find( '.ui-accordion-content' );
                var split = content.attr( 'id' ).split( '-panel-' );
                content.attr( 'id', split[0] + '-panel-' + idx );
                split = content.attr( 'aria-labelledby' ).split( '-header-' );
                content.attr( 'aria-labelledby', split[0] + '-header-' + idx );

            }
        );
    };


    redux.field_objects.repeater.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-repeater:visible' );
        }

        $( selector ).each(
            function( idx ) {

                var el = $( this );

                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                var parent = el;

                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }

                var gid = parent.attr( 'data-id' );

                var blank = el.find( '.redux-repeater-accordion-repeater:last-child' );
                redux.repeater[gid].blank = blank.clone().wrap( '<p>' ).parent().html();


                if ( parent.hasClass( 'redux-container-repeater' ) ) {
                    parent.addClass( 'redux-field-init' );
                }

                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                var active = false;

                //if ( el.find( '.slide-title' ).length < 2 ) {
                //    active = 0;
                //}

                var accordian = el.find( ".redux-repeater-accordion" ).accordion(
                    {
                        header: "> div > fieldset > h3",
                        collapsible: true,
                        //active: active,
                        activate: function( event, ui ) {
                            $.redux.initFields();
                        },
                        heightStyle: "content",
                        icons: {
                            "header": "ui-icon-plus",
                            "activeHeader": "ui-icon-minus"
                        }
                    }
                );
                if ( redux.repeater[gid].sortable == 1 ) {
                    accordian.sortable(
                        {
                            axis: "y",
                            handle: "h3",
                            connectWith: ".redux-repeater-accordion",
                            placeholder: "ui-state-highlight",
                            start: function( e, ui ) {
                                ui.placeholder.height( ui.item.height() );
                                ui.placeholder.width( ui.item.width() );
                            },
                            stop: function( event, ui ) {
                                // IE doesn't register the blur when sorting
                                // so trigger focusout handlers to remove .ui-state-focus
                                ui.item.children( "h3" ).triggerHandler( "focusout" );

                                redux.field_objects.repeater.sort_repeaters( $( this ) );

                            }
                        }
                    );
                } else {
                    accordian.find( 'h3.ui-accordion-header' ).css( 'cursor', 'pointer' );
                }

                el.find( '.redux-repeater-accordion-repeater .bind_title' ).on(
                    'change keyup', function( event ) {
                        if ( $( event.target ).find( ':selected' ).text().length > 0 ) {
                            var value = $( event.target ).find( ':selected' ).text();
                        } else {
                            var value = $( event.target ).val()
                        }
                        $( this ).closest( '.redux-repeater-accordion-repeater' ).find( '.redux-repeater-header' ).text( value );
                    }
                );

                // Handler to remove the given repeater
                el.find( '.redux-repeaters-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );
                        var parent = $( this ).parents( '.redux-container-repeater:first' );
                        var gid = parent.attr( 'data-id' );
                        redux.repeater[gid].blank = $( this ).parents( '.redux-repeater-accordion-repeater:first' ).clone(
                            true, true
                        );
                        $( this ).parents( '.redux-repeater-accordion-repeater:first' ).slideUp(
                            'medium', function() {
                                $( this ).remove();
                                redux.field_objects.repeater.sort_repeaters( el );
                                if ( redux.repeater[gid].limit != '' ) {
                                    var count = parent.find( '.redux-repeater-accordion-repeater' ).length;
                                    if ( count < redux.repeater[gid].limit ) {
                                        parent.find( '.redux-repeaters-add' ).removeClass( 'button-disabled' );
                                    }
                                }
                                parent.find( '.redux-repeater-accordion-repeater:last .ui-accordion-header' ).click();
                            }
                        );

                    }
                );

                String.prototype.reduxReplaceAll = function( s1, s2 ) {
                    return this.replace(
                        new RegExp( s1.replace( /[.^$*+?()[{\|]/g, '\\$&' ), 'g' ),
                        s2
                    );
                };


                el.find( '.redux-repeaters-add' ).click(
                    function() {

                        if ( $( this ).hasClass( 'button-disabled' ) ) {
                            return;
                        }

                        var parent = $( this ).parent().find( '.redux-repeater-accordion:first' );
                        var count = parent.find( '.redux-repeater-accordion-repeater' ).length;

                        var gid = parent.attr( 'data-id' ); // Group id
                        if ( redux.repeater[gid].limit != '' ) {
                            if ( count >= redux.repeater[gid].limit ) {
                                $( this ).addClass( 'button-disabled' );
                                return;
                            }
                        }
                        count++;

                        var id = parent.find( '.redux-repeater-accordion-repeater' ).size(); // Index number


                        if ( parent.find( '.redux-repeater-accordion-repeater:last' ).find( '.ui-accordion-header' ).hasClass( 'ui-state-active' ) ) {
                            parent.find( '.redux-repeater-accordion-repeater:last' ).find( '.ui-accordion-header' ).click();
                        }

                        var newSlide = parent.find( '.redux-repeater-accordion-repeater:last' ).clone( true, true );

                        if ( newSlide.length == 0 ) {
                            newSlide = redux.repeater[gid].blank;
                        }

                        if ( redux.repeater[gid] ) {
                            redux.repeater[gid].count = el.find( '.redux-repeater-header' ).length;
                            var html = redux.repeater[gid].html.reduxReplaceAll( '99999', id );
                            $( newSlide ).find( '.redux-repeater-header' ).text( '' );
                        }

                        newSlide.find( '.ui-accordion-content' ).html( html );
                        // Append to the accordian
                        $( parent ).append( newSlide );
                        // Reorder
                        redux.field_objects.repeater.sort_repeaters( newSlide );
                        // Refresh the JS object
                        var newSlide = $( this ).parent().find( '.redux-repeater-accordion:first' );
                        newSlide.find( '.redux-repeater-accordion-repeater:last .ui-accordion-header' ).click();
                        newSlide.find( '.redux-repeater-accordion-repeater:last .bind_title' ).on(
                            'change keyup', function( event ) {
                                if ( $( event.target ).find( ':selected' ).text().length > 0 ) {
                                    var value = $( event.target ).find( ':selected' ).text();
                                } else {
                                    var value = $( event.target ).val()
                                }
                                $( this ).closest( '.redux-repeater-accordion-repeater' ).find( '.redux-repeater-header' ).text( value );
                            }
                        );
                        if ( redux.repeater[gid].limit > 0 && count >= redux.repeater[gid].limit ) {
                            $( this ).addClass( 'button-disabled' );
                        }

                    }
                );
            }
        );
    };
})( jQuery );
