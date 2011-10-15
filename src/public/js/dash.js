
/**
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Dash
 * @requires Core
 */
var Dash = {
	
	/**
	 * Dash options
	 */	
	options: {
		
		/**
		 * Update refresh
		 * @type Number
		 */
		refresh: 10000
		
	},	
	
	run: function() {
		//window.setTimeout(function(){
		//	_update();
		//}, options.refresh);
	},
	
	/**
	 * Update Dashboard
	 */
	_update: function() {
		
	},
	
	_loadProjects: function() {
		$.getJSON(Core.baseUrl + '/json/get-projects', function(json){
			$.each(json, function(slug, job){
				$('#jobTemplate').tmpl(job).appendTo('#main');
			});
		});
	}
	
	
		
};