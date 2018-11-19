function getTextes() {
	var lang = window.navigator.userLanguage || window.navigator.language;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var textesObj = JSON.parse(this.responseText);
			Object.keys(textesObj).forEach(function(key) {
				elem = document.getElementById(key);
                    if(elem != null){
                            elem.innerHTML = textesObj[key];
                    }
			});
			document.getElementById("container").removeAttribute("style");
		}
	};
	xmlhttp.open("GET", "js/text."+lang.substring(0, 2)+".json", true);
	xmlhttp.send();
}