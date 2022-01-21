function alerta(campo) { alert("Por favor, completa el campo " + campo) }

function comprobarDatosFormulario() {
	let comprobacion = false;
	let expReg = /(?=^.{6,180}$)(?=.*[A-Z])(?=.*[a-z]).*$/;
	let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	const expPas = /(?=^.{8,15}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[!@#$&%*])(?=.*[A-Z])(?=.*[a-z]).*$/;
	let nombre = document.getElementById('nombre').value;
	let email = document.getElementById('email').value;
	let password = document.getElementById('password').value;
	let password2 = document.getElementById('password_confirm').value;
	if (nombre == "") {
		alerta('\"Nombre\"'); nombre.focus(); //return true; 
	}
	else {
		if (!(expReg.test(nombre))) {
			alert('Nombre incorrectos, el formulario NO se enviará');
			//return false;
		}
	}
	if (email == "") {
		alerta('\"Correo\"'); email.focus(); //return true; 
	} else {
		if (!(re.test(email))) {
			alert('Email incorrectos, el formulario NO se enviará');
			//return false;
		}
	}

	if (password == "") {
		alerta('\"Password\"'); password.focus(); //return true; 
	} else {
		if (!(expPas.test(password))) {
			alert('Password incorrectos, el formulario NO se enviará');
			//return false;
		}
	}
	if (password2 == "") {
		alerta('\"Repetición de password\"'); password.focus();	
	} else{
		if(password == password2)

		{ form.submit(); }
	
		else
	
		{
	
		alert("La repetición de la contraseña no coincide.");
	
		password = ""; password2; return true;
		}
	}
		
}
