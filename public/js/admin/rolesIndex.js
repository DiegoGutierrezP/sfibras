
const d = document;

d.addEventListener("submit",e=>{
    if(e.target.matches('#form-delete-rol')){

        e.preventDefault();

        Swal.fire({
            title: "Esta seguro?",
            text: `Se eliminara el rol`,
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar",
        }).then((result) => {
            if(result.value){
                e.target.submit();
            }
        });
    }
})
