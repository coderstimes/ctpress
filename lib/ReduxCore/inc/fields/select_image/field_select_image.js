/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.select_image = redux.field_objects.select_image || {};
    var option_values = [];

    $( document ).ready(
        function() {
            //redux.field_objects.select_image.init();
            $(".switch-options").change(function(){
                if ( $(this).find('.selected').hasClass('cb-enable') ) {
                    $('.redux-select-images').val(option_values[0]).trigger('change');
               } else {
                    $('.redux-select-images').val(option_values[1]).trigger('change');
               }
            });
        }

    );

    redux.field_objects.select_image.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-select_image:visible' );
        }

        $( '.redux-select-images option' ).each(function(){
            if($(this).val().length){
                option_values.push($(this).val());
            }
        });

        setTimeout(function(){
            $("#ctpress-comments_preview_image .redux-select-images").hide();
            $("#ctpress-comments_preview_image").css('margin-top','-50px');

            if ( $("#image_comments_preview_image").attr('src') == '' ) {
                $('.redux-select-images option:nth-child(3)').attr('selected', true).trigger('change');
            }

        }, 1000);

        $( selector ).each(
            function() {
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
                var default_params = {
                    width: 'resolve',
                    triggerChange: true,
                    allowClear: true
                };

                var select2_handle = el.find( '.redux-container-select_image' ).find( '.select2_params' );

                if ( select2_handle.size() > 0 ) {
                    var select2_params = select2_handle.val();

                    select2_params = JSON.parse( select2_params );
                    default_params = $.extend( {}, default_params, select2_params );
                }

                el.find( 'select.redux-select-images' ).select2( default_params );

                el.find( '.redux-select-images' ).on(
                    'change', function() {
                        var preview = $( this ).parents( '.redux-field:first' ).find( '.redux-preview-image' );

                        if ( $( this ).val() === "" ) {
                            preview.fadeOut(
                                'medium', function() {
                                    preview.attr( 'src', '' );
                                }
                            );
                        } else {
                            preview.attr( 'src', $( this ).val() );
                            preview.fadeIn().css( 'visibility', 'visible' );
                        }
                    }
                );
            }
        );
    };
})( jQuery );