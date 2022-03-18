const d = document,
            $checkCliente = d.getElementById('check-cliente-nuevo'),
            $formClonar = d.getElementById('form-clonar-coti');

        d.addEventListener("DOMContentLoaded", e => {
            //select2 cdn
            $('#select-clientes').select2();
        })
        d.addEventListener("change", e => {
            if (e.target.matches('#check-cliente-nuevo')) {
                const $selectCliente = d.querySelector('.content-select-clientes'),
                    $clienteNuevo = d.querySelector('.content-form-nuevo-cliente');
                if (e.target.checked) {
                    $selectCliente.classList.add('d-none');
                    $clienteNuevo.classList.remove('d-none');
                } else {
                    $selectCliente.classList.remove('d-none');
                    $clienteNuevo.classList.add('d-none');
                }
            }
        })
        d.addEventListener("click",e=>{
            if(e.target.matches(".btn-clonar")){
                e.preventDefault();
                //console.log($checkCliente.checked);
                if($checkCliente.checked){
                    const $formCliente = d.getElementById("form-nuevo-cliente");
                    let nombreCliente = $formCliente.querySelector('input[name="nombreCliente"]').value;
                    if(!nombreCliente){

                        $formCliente.querySelector('.error-nombre').textContent = 'El campo nombre es obligatorio';
                        errorFormCliente = "Ingrese el nombre del cliente";
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            background:'#FEEFB3',
                            title:'Ingrese el nombre del cliente',
                            toast:true,
                            color: '#9f6000',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        })
                        window.scrollTo({
                            behavior:"smooth",
                            top:0,
                        })
                    }else{
                        $formClonar.submit();
                    }
                }else{
                    $formClonar.submit();
                }
            }
        })
