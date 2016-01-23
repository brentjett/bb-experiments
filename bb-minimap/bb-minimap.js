
(function($){

    function brjMinimapRenderRows(rows) {
        var html = "";
        var rowTemplate = wp.template('bb-minimap-row');
        $.each(rows, function(i, item) {
            var node = $(item).data('node');
            var data = {
                node: node
            }
            html += rowTemplate(data);
        });
        $('.fl-minimap-rows').html(html);
    }

    $(function(){

        var rows = $('.fl-builder-content .fl-row');
        var renderMinimap = wp.template('bb-minimap');
        var data = {};
        $('body').append(renderMinimap(data));

        brjMinimapRenderRows(rows);

        // Click scroll to row
        $('#fl-minimap').on('click', '.fl-minimap-row', function(event) {
            var barHeight = $('.fl-builder-bar').height();
            var nodeID = $(this).data('node');
            var node = $('.fl-row[data-node="' + nodeID + '"]');
            var position = node.offset().top - barHeight;

            if (position == window.scrollY) {

                FLBuilder._closePanel();
				FLBuilder._showLightbox();

				FLBuilder.ajax({
					action: 'render_row_settings',
					node_id: nodeID
				}, FLBuilder._rowSettingsLoaded);
                event.preventDefault();

            } else {
                scrollTo(0, position);
            }
        });

        // Hover - highlight row
        $('#fl-minimap').on('mouseenter', '.fl-minimap-row', function(event) {
            var nodeID = $(this).data('node');
            var row = $('.fl-row[data-node="' + nodeID + '"]');
			var template = wp.template( 'fl-row-overlay' );

			if ( ! row.hasClass( 'fl-block-overlay-active' ) ) {

				// Append the overlay.
				FLBuilder._appendOverlay( row, template( {
					global : row.hasClass( 'fl-node-global' ),
					node   : row.attr('data-node')
				} ) );

				// Adjust the height of modules if needed.
				row.find( '.fl-module' ).each( function(){
					if ( $( this ).outerHeight( true ) < 20 ) {
						$( this ).addClass( 'fl-module-adjust-height' );
					}
				} );
			}
        });

        $('#fl-minimap').on('mouseleave', '.fl-minimap-row', function(event) {
            //var nodeID = $(this).data('node');
            //var node = $('.fl-row[data-node="' + nodeID + '"]');
            FLBuilder._removeRowOverlays();
        });




        var observer = new MutationObserver(function(mutations) {
        	// For the sake of...observation...let's output the mutation to console to see how this all works
        	mutations.forEach(function(mutation) {
        		console.log(mutation);
        	});
        });

        // Notify me of everything!
        var observerConfig = {
        	attributes: true,
        	childList: true,
        	characterData: false
        };

        // Node, config
        // In this case we'll listen to all changes to body and child nodes
        var targetNode = $('.fl-minimap-rows')[0];
        observer.observe(targetNode, observerConfig);
    });
})(jQuery);


/*
// Notes
_reorderRow: function(node_id, position)
{
    FLBuilder.ajax({
        action: 'reorder_node',
        node_id: node_id,
        position: position,
        silent: true
    });
},
*/
