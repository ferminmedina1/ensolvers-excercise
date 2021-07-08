"use strict";
document.addEventListener('DOMContentLoaded', loadPage);

function loadPage () {
    
    getFolders();
    
 //SE OBTIENEN LAS CARPETAS
    function getFolders(){

        fetch('api/folders')
            .then(response =>  response.json())
            .then( folders => renderFolders(folders)) //SE LLAMA A LA FUNCION QUE LOS MUESTRA
            .catch(error => sinCarpetas());
    }
 
 //CUANDO NO HAY COMENTARIOS, ENTRA EN EL .CATCH Y MUESTRA EN EL DOM QUE NO HAY COMENTARIOS
    function sinCarpetas() {
        let lista = document.querySelector(".foldersList");

        lista.innerHTML = "Currently there are no folders"
    }

 //MUESTRA LOS COMENTARIOS EN EL DOM
    function renderFolders(folders) {
        let lista = document.querySelector(".foldersList");

        lista.innerHTML = ""            //SE VACIA EL DIV
        folders.forEach(folders => {
             lista.innerHTML += "<li class='folder'>" + folders.name  + "<a href=items/"+ folders.id+">View items</a><i class='botonBorrar fa fa-trash' id='"+ folders.id+"'style='font-size:36px'></i></li>"
             boton_borrar_fila(); //se le da funcionalidad
            });
    }

    function boton_borrar_fila () { 
        let buttons = document.getElementsByClassName('botonBorrar'); 

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function() {
                    let id = buttons[i].id; //busco a cual fue al que se le dio click
                    borrarCarpeta_en_servidor(id);
                })
                
            }
    }

    function borrarCarpeta_en_servidor(id) {

        fetch('api/folders/'+ id,{
            
            'method': 'DELETE',
            'mode': "cors"

        })
        
        .then(response =>  response.json())
        .then(get => getFolders())   
        .catch(error => console.log(error));
    }

        
    document.querySelector("#btn_add").addEventListener("click", function(e) {
        e.preventDefault();

        let name = document.querySelector("#name_folder").value
    
        let folder = {
            "name": name,
        }

        if(folder.name != ""){  //SI ESTAN VACIOS LOS CAMPOS NO SE ENVIA
            let lista = document.querySelector(".error");
            lista.innerHTML = "";
            fetch('api/addFolder', {
                method: 'POST',
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(folder)
            })
                .then(response =>  response.json())
                .then(get => getFolders())    //OBTIENE LOS COMENTARIOS
                .catch(error => console.log(error));
        }else{
            document.querySelector(".error").innerHTML = "Insert a name for the folder."
        }

        document.querySelector("#name_folder").value = null;  //SE RESETEAN LOS CAMPOS DEL FORMULARIO
    })
}