var isDebugPC = false;
var hasNativeStorage = null;

window.KokosilClient = (function($) {
	var userAgent = window.navigator.userAgent.toLowerCase();
	if ((userAgent.indexOf('android') == -1) && (userAgent.indexOf('kokosil/ios') == -1)
			&& (userAgent.indexOf('iphone') == -1)) {
		document.write("<script type='text/javascript' src='js/debug_stub_interface.js'><\/script>");
		isDebugPC = true;
	}

	function hasKokosilClientNativeStorage() {
		if (hasNativeStorage == null) {
			if ((typeof KokosilClientInterface != 'undefined')
					&& (typeof KokosilClientInterface.setContext == 'function')
					&& (typeof KokosilClientInterface.getContext == 'function')) {
				hasNativeStorage = true;
			} else {
				hasNativeStorage = false;
			}
		}
		return hasNativeStorage;
	}

	function callKokosilWrapper(event, args) {
		if (isDebugPC) {
			DebugStubInterface.callKokosil(event, args);
		} else {
			KokosilClientInterface.callKokosil(event, args);
		}
	}

	function getContext(key) {
		var data;
		if (hasKokosilClientNativeStorage()) {
			data = KokosilClientInterface.getContext(key);
		} else {
			data = localStorage.getItem(key);
		}	
		if (isDebugPC) {
			DebugStubInterface.setContext(key, data);
		}
		if (data == null) {
			//alert("data is null");
			return null;
		}
		//return data;
		return JSON.parse(data);
	}

	function setContext(key, value) {
		if ((key == null) || (key.length == 0)) {
			return;
		}
		var data = null;
		if (value != null) {
			data = JSON.stringify(value);
		}
		if (hasKokosilClientNativeStorage()) {
			KokosilClientInterface.setContext(key, data);
		} else {
			localStorage.setItem(key, data);
		}

		if (isDebugPC) {
			DebugStubInterface.setContext(key, data);
		}
	}

	function notifyEvent(event, args) {
		$(window).trigger(event, args);
	}

	// =========================================================================
	// ■特定 ucode受信を通知するための機能
	// =========================================================================

	function requestUcodeUpdate(enabled) {
		var args = {
			enabled : enabled
		};
		callKokosilWrapper('requestUcodeUpdate', args);
	}

	function registerUcodeNotification(ucode, message) {
		var args = {
			ucode : ucode,
			message : message
		};
		callKokosilWrapper('registerUcodeNotification', args);
	}

	function unregisterUcodeNotification(ucode) {
		var args = {
			ucode : ucode
		};
		callKokosilWrapper('unregisterUcodeNotification', args);
	}

	// =========================================================================
	// ■タイマ通知機能
	// =========================================================================

	function registerAlarmNotification(id, date, message) {
		var args = {
			id : id,
			date : date,
			message : message
		};
		callKokosilWrapper('registerAlarmNotification', args);
	}

	function unregisterAlarmNotification(id) {
		var args = {
			id : id
		};
		callKokosilWrapper('unregisterAlarmNotification', args);
	}

	// =========================================================================
	// ■特定の場所への入退場を通知するための機能
	// =========================================================================

	function registerPlaceNotification(id, area, message) {
		var args = {
			id : id,
			area : area,
			message : message
		};
		callKokosilWrapper('registerPlaceNotification', args);
	}

	function unregisterPlaceNotification(id) {
		var args = {
			id : id
		};
		callKokosilWrapper('unregisterPlaceNotification', args);
	}

	// =========================================================================
	// ■現在地を通知するための機能
	// =========================================================================

	function requestLocationUpdate(enabled) {
		var args = {
			enabled : enabled
		};
		callKokosilWrapper('requestLocationUpdate', args);
	}

	// =========================================================================
	// ■その他
	// =========================================================================

	function launchQrReader() {
		var args = {};
		callKokosilWrapper('launchQrReader', args);
	}

	function sendAnalyticsEvent(category, action, label, value) {
		var args = {
			category : category,
			action : action,
			label : label,
			value : value
		};
		callKokosilWrapper('sendAnalyticsEvent', args);
	}

	function play(path, startPosition) {
		var args = {
			path : path,
			startPosition : startPosition
		};
		callKokosilWrapper('play', args);
	}

	function dbgLog(message) {
		var args = {
			message : message,
		}
		callKokosilWrapper('dbgLog', args);
	}

	return {
		getContext : getContext,
		setContext : setContext,
		notifyEvent : notifyEvent,
		requestUcodeUpdate : requestUcodeUpdate,
		registerUcodeNotification : registerUcodeNotification,
		unregisterUcodeNotification : unregisterUcodeNotification,
		registerAlarmNotification : registerAlarmNotification,
		unregisterAlarmNotification : unregisterAlarmNotification,
		registerPlaceNotification : registerPlaceNotification,
		unregisterPlaceNotification : unregisterPlaceNotification,
		requestLocationUpdate : requestLocationUpdate,
		launchQrReader : launchQrReader,
		sendAnalyticsEvent : sendAnalyticsEvent,
		play : play,
		dbgLog : dbgLog
	};
})(window.jQuery);

$(function() {
	var hashes = location.hash.slice(1).split('&');
	for (i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		KokosilClient.setContext(hash[0], hash[1]);
	}

	if (Main.onInit != null) {
		$(window).bind('onInit', Main.onInit);
	}

	if (Main.onResume != null) {
		$(window).bind('onResume', Main.onResume);
	}

	if (Main.onPause != null) {
		$(window).bind('onPause', Main.onPause);
	}

	if (Main.onTerminate != null) {
		$(window).bind('onTerminate', Main.onTerminate);
	}

	if (Main.onUcode != null) {
		$(window).bind('onUcode', Main.onUcode);
	}

	if (Main.onTimer != null) {
		$(window).bind('onTimer', Main.onTimer);
	}

	if (Main.onPlace != null) {
		$(window).bind('onPlace', Main.onPlace);
	}

	if (Main.onLocation != null) {
		$(window).bind('onLocation', Main.onLocation);
	}

	if (isDebugPC) {
		$(document).trigger('onInit', null);
		$(document).trigger('onResume', null);
	}

	$(window).bind('beforeunload', function(event) {
		$(document).trigger('onPause', null);
		$(document).trigger('onTerminate', null);
		// return 'Any string';
	});
});
