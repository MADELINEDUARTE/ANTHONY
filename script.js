function validar(){
    var nombre, apellidos, correo, clave, expresion;
    nombre = document.getElementById("nombre").value;
    apellidos = document.getElementById("apellidos").value;
    correo = document.getElementById("correo").value;
    clave = document.getElementById("clave").value;
    expresion = /\w+@\w+\.+[a-z]/;

    if (nombre === "" || apellidos === "" || correo === "" || clave === ""){
        alert("Todos los campos son obligatorios");
        return false;    
    }     
else if(nombre.length>30) {
    alert("El nombre es muy largo");
    return false;
}
else if(apellidos.length>80) {
    alert("Los apellidos son muy largos");
    return false;
}
else if(correo.length>100) {
    alert("El correo es muy largo");
    return false;
}
else if (!expresion.test(correo)) {
    alert("El correo no es valido");
    return false;  
}
else if(usuario.length>20 || clave.length>20) {
    alert("El usuario y la clave solo deben tener 20 caracteres");
    return false;
    }
    return true;
}