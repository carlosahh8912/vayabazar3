// Dark mode del template
const swdm = document.getElementById('kt_dark_mode_toggle');

function dark(){

	let t = "plugins.dark.bundle.css",
		css = "style.dark.bundle.css",
		b = document.querySelector("#style_bundle"),
		s = document.querySelector("#style_document");

	document.body.classList.add('dark-mode');
	b.setAttribute("href", "assets/plugins/global/"+t);
	window.setTimeout(function(){
		s.setAttribute("href", "assets/css/"+css);
	}, 10);
	
	if (swdm) {
		swdm.setAttribute('checked', "");
	}
}

function ligth(){
	let t = "plugins.bundle.css",
		css = "style.bundle.css",
		b = document.querySelector("#style_bundle"),
		s = document.querySelector("#style_document");

	document.body.classList.remove('dark-mode');
	b.setAttribute("href", "assets/plugins/global/"+t);
	window.setTimeout(function(){
		s.setAttribute("href", "assets/css/"+css);
	}, 10);

	if (swdm) {
		swdm.removeAttribute('checked', "");
	}

}

function darkMode(){
	if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
		dark();
	}else{
		ligth();
	}
}

if (localStorage.getItem('dark-mode')) {

	window.onload = function(){
		if(localStorage.getItem('dark-mode') === 'true'){
			dark();
		}else{
			ligth();
		}
	};
}else{
	darkMode();
}


if(swdm){	
	swdm.addEventListener('click', () => {
		document.body.classList.toggle('dark-mode');
		swdm.setAttribute('checked', "");

		if(document.body.classList.contains('dark-mode')){
			localStorage.setItem('dark-mode', 'true');
			dark();
		}else{
			localStorage.setItem('dark-mode', 'false');
			ligth();
		}
	});
}

