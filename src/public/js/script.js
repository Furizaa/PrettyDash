$(function() {
	Page.initialize();
	Blackout.initialize();
	Growl.initialize();
	Load.processLoadQueue();
});

/**
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Core
 */
var Core = {

		/**
		 * Cached Browswer as String
		 * @type String
		 */
		browser: "",
		
		/**
		 * Base Url to root element
		 * @type String
		 */
		baseUrl: '/',
		
		/**
		 * Url for static files like JavaScript and CSS
		 * @type String
		 */
		staticUrl: '',
		
		/**
		 * Url for static files like JavaScript and CSS for this module
		 * @type String
		 */
		moduleStaticUrl: '',
		
		/**
		 * The current host and protocoll
		 */
		host: '',
		
		/**
		 * Initialize the script
		 * @constructor
		 */
		initialize: function() {
			Core.host = location.protocol + '//' + (location.host || location.hostname);
		},
		
		/**
		 * Detect the browser type, based in feature detection and not user agent.
		 * 
		 * @type String
		 */
		getBrowser: function() {
			if ('' !== Core.browser)
				return Core.browser;
			
			var support = $.support;
			if (!support.hrefNormalized && !support.tbody && !support.style && !support.opacity) {
				if ((typeof document.body.style.maxHeight != "undefined") || (window.XMLHttpRequest))
					Core.browser = "ie7";
				else
					Core.browser = "ie6";
			} else if (support.hrefNormalized && support.tbody && support.style && !support.opacity) {
				Core.browser = "ie8";
			} else {
				Core.browser = "other";
			}
			
			return Core.browser;
		},
		
		/**
		 * Is the browser detected as IE?
		 * 
		 * @param {Number} version [6, 7, 8]
		 * @type Boolean
		 */
		isIE: function(version) {
			var browserString = Core.getBrowser();
			if (version) 
				return ('ie'+ version == browserString);
			else
				return ((browserString == 'ie6') || (browserString == 'ie7') || (browserString == 'ie8'));
		},
		
		/**
		 * Checks if the argument is a defined callback function
		 * @type Boolean
		 */
		isCallback: function(callback) {
			return (callback && typeof callback === 'function');
		},
		
		/**
		 * JS Implementation of PHPs sprintf function
		 * Replace {0}, {1}, {n} etc. with the passed arguments.
		 * 
		 * @param {String} str
		 * @type  String
		 */
		msg: function(str) {
			for (var i = 1, len = arguments.length; i < len; ++i) {
				str = str.replace("{" + (i - 1) + "}", arguments[i]);
			}
			return str;
		}
	
};

/**
 * Tool for dynamic loading of js/css files
 * 
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Load
 * @requires Core, Page
 */
var Load = {
	
		/**
		 * Load Queue
		 * @type Array
		 */
		deferredLoadQueue : [],
		
		/**
		 * Include a JavaScript file via XHR
		 * 
		 * @param {String} url
		 * @param {Function} success
		 * @param {Boolean} cache
		 */
		include: function(url, success, cache) {
			$.ajax({
				url: url,
				dataType: 'script',
				success: success,
				cache: cache !== false
			});
		},
		
		/**
		 * Loads either a JavaScript or CSS file, by default deferring the load until after other
		 * content has loaded. The file type is determined by using the file extension.
		 */
		load: function(path, deferred) {
			deferred = deferred !== false;
			
			if (Page.initialized || !deferred)
				Load.loadDeferred(path);
			else
				Load.deferredLoadQueue.push(path);
		},
		
		/**
		 * Determine wich type to load and delegate to typed load method.
		 * 
		 * @param {String} path
		 */
		loadDeferred: function(path) {
			var queryIndex = path.indexOf("?");
			var extIndex   = path.lastIndexOf(".") + 1;
			var ext = path.substring(extIndex, queryIndex == -1 ? path.length : queryIndex);
			switch (ext) {
					case 'js':
						Load.loadDeferredScript(path);
						break;
					case 'css':
						Load.loadDeferredStyle(path);
						break;
			}
		},
		
		/**
		 * Include JavaScript file
		 * 
		 * @param {String} path
		 */
		loadDeferredScript: function(path) {
			$("<script/>", {
				type: "text/javascript",
				src: path
			}).appendTo("head");	
		},
		
		/**
		 * Include CSS file. Don't chance this. This is the only way this works
		 * in IE.
		 * 
		 * @param {String} path
		 */
		loadDeferredStyle: function(path) {
			$('head').append('<link rel="stylesheet" href="' + path + '" type="text/css" media="screen" />');
		},
		
		/**
		 * Run on page load - DOM ready!
		 * Will scan and load evey file in the defered load queue.
		 */
		processLoadQueue: function() {
			if (Load.deferredLoadQueue.length > 0) {
				for (var i = 0, path; path = Load.deferredLoadQueue[i]; i++) {
					Load.load(path);
				}
			}
		}
		
};

/**
 * Utility to record window scroll / dimensions
 * 
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Page
 */
var Page = {
		
		/**
		 * Window Object
		 * @type Object
		 */
		object: null,
		
		/**
		 * Constructor called?
		 * @type Boolean
		 */
		initialized: false,
		
		/**
		 * Window Dimensions
		 * @type Object
		 */
		dimensions: {
			width: 0,
			height: 0
		},
		
		/**
		 * Window scroll
		 * @type Object
		 */
		scroll: {
			top: 0,
			width: 0
		},
		
		/**
		 * Automatic crop of width dimension value
		 * @type Number
		 */
		cropWidth: 0,
		
		/**
		 * Automatic crop of height dimension value
		 * @type Number
		 */
		cropHeight: 0,
		
		/**
		 * Initialize and grab window properties
		 * 
		 * @constructor
		 */
		initialize: function() {
			if (Page.initialized)
				return;
			
			if (!Page.object)
				Page.object = $(window);
			
			//Hook into resize/scroll calls
			Page.object
					.resize(Page.getDimensions)
					.scroll(Page.getScrollValues);
			
			Page.getScrollValues();
			Page.getDimensions();
			Page.initialized = true;
		},
		
		/**
		 * Get window scroll values.
		 */
		getScrollValues: function() {
			Page.scroll.top  = Page.object.scrollTop();
			Page.scroll.left = Page.object.scrollLeft();
		},
		
		/**
		 * Get window dimensions
		 */
		getDimensions: function() {
			Page.dimensions.width  = Page.object.width() - Page.cropWidth;
			Page.dimensions.height = Page.object.height() - Page.cropHeight;
		}
		
};

/**
 * Creates a full page blackout
 * 
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Blackout
 * @requires Core
 */ 
var Blackout = {

		/**
		 * Class been initialized before?
		 * @type Boolean
		 */
		initialized: false,
		
		/**
		 * Blackout DOM Element
		 * @type Object
		 */
		element: null,
		
		/**
		 * Create the DIV DOM Element to be used
		 * 
		 * @constructor
		 */
		initialize: function() {
			Blackout.element = $('<div/>', { id: 'blackout' });
			$("html").append(Blackout.element);
			Blackout.initialized = true;
		},

		/**
		 * Shows the blackout
		 * 
		 * @param {Function} callback - function that gets called after show 
		 */
		show: function(callback) {
			if (!Blackout.initialized)
				Blackout.initialize();
			
			Blackout.element.show();
			
			if (Core.isCallback(callback))
				Blackout.element.click(callback);
		},
		
		/**
		 * Hides blackout
		 * 
		 * @param {Function} callback - function that gets called after blackout hides
		 */
		hide: function(callback) {
			Blackout.element.unbind('click');
			Blackout.element.hide();
			if (Core.isCallback(callback))
				callback();
		}
};

/**
 * Display Growl-like status messages
 * 
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Growl
 * @requires Core
 */
var Growl = {

		/**
		 * Container object to hold messages
		 * @type Object
		 */
		container: null,
		
		/**
		 * Parent to wich the container will be assigned
		 * @type Object
		 */
		parent: null,
		
		/**
		 * Constructor called?
		 * @type Boolean
		 */
		initialized: false,
		
		/**
		 * Max number of simultanly displayed messages
		 * @type Numnber
		 */
		max: 3,
		
		/**
		 * Default options
		 * @type Object
		 */
		options: {
			timer: 5000,
			autoClose: true,
			onClick: null
		},
		
		/**
		 * Create and append growl container
		 * 
		 * @constructor
		 */
		initialize: function() {
			if (Growl.initialized)
				return;
			
			if (!Growl.parent) {
				Growl.parent = $('body');
			}
			
			Growl.container = $('<div/>', { id: 'ui-growl' });
			Growl.parent.append(Growl.container);
			Growl.initialized = true;
		},
		
		/**
		 * Create new growl message element
		 * 
		 * @param  {String} content
		 * @type Object
		 */
		create: function(content) {
			var message = $('<div/>')
					.addClass('ui-growl-toast')
					.hide()
					.appendTo(Growl.container);
			
			$('<div/>').addClass('ui-growl-content').appendTo(message).html(content);
			return message;
		},
		
		/**
		 * Show growl message
		 * 
		 * @param {String} content
		 * @param {Object} options
		 */
		show: function(content, options) {
			if (!Growl.initialized)
				Growl.initialize();
			
			Growl.truncate();
			
			var message = Growl.create(content);
			
			options = $.extend({}, Growl.options, options);
			
			if (options.autoClose) {
				window.setTimeout(function() {
					message.fadeOut('normal', function() {
						message.remove();
					});
				}, options.timer);
			} else {
				message.click(function() {
					message.fadeOut('normal', function() {
						message.remove();
					});
				}).css('cursor', 'ponter');
			};
			
			if (Core.isCallback(options.onClick))
				message.click(options.onClick).css('cursor', 'pointer');
			
			message.fadeIn();
		},
		
		/**
		 * Truncate messages if it exceeds the max limit.
		 */
		truncate: function() {
			var total = Growl.container.find('.ui-growl-toast');
			
			if (total.length > Growl.max)
				Growl.container.find('.ui-growl-toast:lt(' + Math.round(total.length - Growl.max) + ')').fadeOut();
		}
		
};

/**
 * Inline dialog window with messaging
 * 
 * Copyright 2010-2011 Andreas Hoffmann
 * @author Andreas Hoffmann <andreas.hoffmann@holidaycheck.com>
 * @class Dialog
 * @requires Core, Blackout
 */
var Dialog = {
	
		/**
		 * Currently opened dialog element
		 * @type Object
		 */
		element: null,
		
		/**
		 * Function to call after recieved message
		 * message(action, key, value)
		 * @type Object
		 */
		callbackFunc: null,
		
		/**
		 * Create a dialog frame within the document
		 * 
		 * @param {String} url
		 * @param {Number} width
		 * @param {Number} height
		 * @param {Object} parent - if no parent is set the frame will be appended
		 * 					        to the body element.
		 * @param {function} callback
		 */
		open: function(url, width, height, parent, callback) {
			if (undefined === url)
				return;
			
			if (undefined === width)
				return;
			
			if (undefined === height)
				return;
			
			if (undefined === parent)
				parent = $('body');
			
			Dialog.callbackFunc = callback;
			
			if (Core.isIE())
				Dialog.element = $('<iframe src="' + url + '" width="' + width + '" height="' + height + '" scrolling="no" frameborder="0" allowTransparency="true"></iframe>')
					.appendTo(parent);
			else
				Dialog.element = $('<object type="text/html" data="' + url + '" width="' + width + '" height="' + height + '"></object>')
					.appendTo(parent);
			
			Dialog._setListener();
			Blackout.show(function(){
				Dialog.close();
			});
		},
		
		/**
		 * Send message from within a dialog to the parent windows callback method
		 * @param {String} action - What do do
		 * @param {String} key
		 * @param {String} value
		 */
		send: function(action, key, value) {
			var obj = {action: action};
			
			if (key) obj[key] = value;
			
			parent.postMessage(JSON.stringify(obj), Core.host);
			return false;
		},
		
		/**
		 * Close current dialog
		 */
		close: function() {
			Dialog._removeListener();
			Dialog.element.remove();
			Blackout.hide();
		},
		
		/**
		 * Metod is called if the window recieves a message throu the listener handle
		 * @param {String} event
		 */
		_messageFired: function(event) {
			
			/*
			 * !!
			 * Security Check
			 * !!
			 */
			if (event.origin !== Core.host)
				throw new Exception('Postmessage Security Error!');
			// !!
			
			var data = JSON.parse(event.data);
			data.action = data.action || 'noaction';
			data.key 	= data.key 	|| 'nokey';
			data.value 	= data.value 	|| 'novalue';
			
			if (Core.isCallback(Dialog.callbackFunc))
				Dialog.callbackFunc(data.action, data.key, data.value);
		},
		
		/**
		 * Init listener handle
		 */
		_setListener: function() {
			Dialog._removeListener();
			Dialog._listenerHandle = function(event) {
				Dialog._messageFired(event);
			};
			
			if (typeof addEventListener !== "undefined")
				addEventListener("message", Dialog._listenerHandle, false);
			else
				attachEvent("onmessage", Dialog._listenerHandle); //IE
		},
		
		/**
		 * Remove message listener
		 */
		_removeListener: function() {
			if (!Dialog._listenerHandle)
				return;
			
			if (typeof removeEventListener !== "undefined")
				removeEventListener("message", Dialog._listenerHandle, false);
			else
				detachEvent("onmessage", Dialog._listenerHandle); //IE
		}
		
};