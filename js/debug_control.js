window.Main = (function($) {
	//
	// コンテンツ読み込み
	//
	function loadContent() {
		parent.right.location.href = $('#content_file').val();
		//alert($('#content_file').val());
	}

	//
	// 通知（ネイティブ ⇒ ブラウザ）
	//
	function selectEvent() {
		$('[id^=param_key]').val('');
		$('[id^=param_val]').val('');
		var eventType = $('#n2b_notification').val();
		if (eventType == 'onUcode') {
			$('#param_key1').val('ucode');
			$('#param_key2').val('type');
		} else if (eventType == 'onTimer') {
			$('#param_key1').val('id');
		} else if (eventType == 'onPlace') {
			$('#param_key1').val('id');
			$('#param_key2').val('enter');
		} else if (eventType == 'onLocation') {
			$('#param_key1').val('longitude');
			$('#param_key2').val('latitude');
			$('#param_key3').val('floor');
			$('#param_key4').val('accuracy');
		}
	}

	function sendEvent() {
		var eventParam = new Object();
		for ( var i = 1; i <= 4; i++) {
			var key = $('#param_key' + i).val();
			var val = $('#param_val' + i).val();
			if (key.length > 0 && val.length > 0) {
				eventParam[key] = val;
			}
		}
		var eventType = $('#n2b_notification').val();
		parent.right.KokosilClient.notifyEvent(eventType, eventParam);
	}

	//
	// 要求（ブラウザ ⇒ ネイティブ）の履歴
	//
	function callKokosil(event, args) {
		var text = $('#b2n_request').val() + event + ' ' + JSON.stringify(args) + '\n';	
		$('#b2n_request').val(text);
	}

	function clearHistory() {
		$('#b2n_request').val('');
	}

	//
	// ローカルストレージ
	//
	function setContext(key, value) {
		var replaced = false;
		$('#local_storage tr').each(function() {
			if ($('td', this).eq(0).text() == key) {
				replaced = true;
				$('<tr><td>' + key + '</td><td>' + value + '</td></tr>').replaceAll(this);
				return false;
			}
		});
		if (!replaced) {
			$('#local_storage').append('<tr><td>' + key + '</td><td>' + value + '</td></tr>');
		}
	}

	return {
		loadContent : loadContent,
		selectEvent : selectEvent,
		sendEvent : sendEvent,
		callKokosil : callKokosil,
		clearHistory : clearHistory,
		setContext : setContext
	};
})(window.jQuery);
