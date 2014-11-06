window.DebugStubInterface = (function($) {
	function setContext(key, value) {
		parent.left.Main.setContext(key, value);
	}

	function callKokosil(event, args) {
		parent.left.Main.callKokosil(event, args);
	}

	return {
		setContext : setContext,
		callKokosil : callKokosil
	};
})(window.jQuery);
