const d = document;

/* d.addEventListener("click",e=>{
    if(e.target.matches('.btn-form-contact')){
        e.preventDefault();
        console.log('sad');
    }
}); */

function validationForm(form){
    let errors = {};
    let regexName = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    let regexEmail = /^(\w+[/./-]?){1,}@[a-z]+[/.]\w{2,}$/;
    let regexComments = /^.{1,255}$/;

    if(!form.nombre.trim()){
        errors.nombre = 'El campo nombre es requerido';
    }else if(!regexName.test(form.nombre.trim())){
        errors.nombre = 'El campo nombre solo acepta letras y espacios en blanco';
    }

    if(!form.email.trim()){
        errors.email = 'El campo email es requerido';
    }else if(!regexEmail.test(form.email.trim())){
        errors.email = 'El campo email es incorrecto';
    }

    if(!form.asunto.trim()){
        errors.asunto = 'El campo Asunto es requerido';
    }

    if(!form.mensaje.trim()){
        errors.mensaje = 'El campo Mensaje es requerido';
    }else if(!regexComments.test(form.mensaje.trim())){
        errors.mensaje = 'El campo Mensaje solo acpeta hasta 255 caracteres';
    }

    return errors;
}

d.addEventListener("submit",e=>{
    if(e.target.matches("#form-contact")){
        e.preventDefault();
        const $formContact = d.getElementById("form-contact");
        let form ={};
        form.nombre = $formContact.nombre.value;
        form.email = $formContact.email.value;
        form.telefono = $formContact.telefono.value;
        form.asunto = $formContact.asunto.value;
        form.mensaje = $formContact.mensaje.value;

        let errors = validationForm(form);

        if(Object.keys(errors).length === 0){

        }else{
            if(errors.nombre){
                $formContact.querySelector('.error-nombre').textContent = errors.nombre;
                $formContact.nombre.classList.add('error');
            }else{
                $formContact.querySelector('.error-nombre').textContent = '';
                $formContact.nombre.classList.remove('error');
            }
            if(errors.email){
                $formContact.querySelector('.error-email').textContent = errors.email;
                $formContact.email.classList.add('error');
            }else{
                $formContact.querySelector('.error-email').textContent = '';
                $formContact.email.classList.remove('error');
            }
            if(errors.asunto){
                $formContact.querySelector('.error-asunto').textContent = errors.asunto;
                $formContact.asunto.classList.add('error');
            }else{
                $formContact.querySelector('.error-asunto').textContent = '';
                $formContact.asunto.classList.remove('error');
            }
            if(errors.mensaje){
                $formContact.querySelector('.error-mensaje').textContent = errors.mensaje;
                $formContact.mensaje.classList.add('error');
            }else{
                $formContact.querySelector('.error-mensaje').textContent = '';
                $formContact.mensaje.classList.remove('error');
            }
        }
    }
})

d.addEventListener("input",e=>{
    if(e.target.matches(".box")){
        const $formContact = d.getElementById("form-contact");
        let form ={};
        form.nombre = $formContact.nombre.value;
        form.email = $formContact.email.value;
        form.telefono = $formContact.telefono.value;
        form.asunto = $formContact.asunto.value;
        form.mensaje = $formContact.mensaje.value;
        let errors = validationForm(form);

        $formContact.querySelector('.error-nombre').textContent = '';
        $formContact.nombre.classList.remove('error');
        $formContact.querySelector('.error-email').textContent = '';
        $formContact.email.classList.remove('error');
        $formContact.querySelector('.error-asunto').textContent = '';
        $formContact.asunto.classList.remove('error');
        $formContact.querySelector('.error-mensaje').textContent = '';
        $formContact.mensaje.classList.remove('error');
        if(Object.keys(errors).length !== 0){
            if(errors.nombre){
                $formContact.querySelector('.error-nombre').textContent = errors.nombre;
                $formContact.nombre.classList.add('error');
            }
            if(errors.email){
                $formContact.querySelector('.error-email').textContent = errors.email;
                $formContact.email.classList.add('error');
            }
            if(errors.asunto){
                $formContact.querySelector('.error-asunto').textContent = errors.asunto;
                $formContact.asunto.classList.add('error');
            }
            if(errors.mensaje){
                $formContact.querySelector('.error-mensaje').textContent = errors.mensaje;
                $formContact.mensaje.classList.add('error');
            }
        }
    }
})
