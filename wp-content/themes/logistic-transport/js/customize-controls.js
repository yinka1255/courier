( function( api ) {

	// Extends our custom "logistic-transport" section.
	api.sectionConstructor['logistic-transport'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );