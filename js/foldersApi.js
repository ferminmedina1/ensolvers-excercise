"use strict";
document.addEventListener('DOMContentLoaded', loadPage);

function loadPage () {
    
    getFolders();
    

    function getFolders(){

        fetch('api/folders')
            .then(response =>  response.json())
            .then( folders => renderFolders(folders)) 
            .catch(error => sinCarpetas());
    }
 
    function sinCarpetas() {
        let lista = document.querySelector(".foldersList");

        lista.innerHTML = "Currently there are no folders"
    }

    function renderFolders(folders) {
        let lista = document.querySelector(".foldersList");

        lista.innerHTML = "";          
        folders.forEach(folders => {
             lista.innerHTML += "<li class='folder'><p class='text'>" + folders.name  + "</p><a href=folder/"+ folders.id+">View items</a><i class='botonBorrar fa fa-trash' id='"+ folders.id+"'style='font-size:36px'></i></li>"
             boton_borrar_fila(); 
            });
    }

    function boton_borrar_fila () { 
        let buttons = document.getElementsByClassName('botonBorrar'); 

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function() {
                    let id = buttons[i].id; 
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

        let name = document.querySelector("#name_folder").value;
    
        let folder = {
            "name": name,
        }

        if(folder.name != ""){ 
            let lista = document.querySelector(".error");
            lista.innerHTML = "";
            fetch('api/addFolder', {
                method: 'POST',
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(folder)
            })
                .then(response =>  response.json())
                .then(get => getFolders())   
                .catch(error => console.log(error));
        }else{
            document.querySelector(".error").innerHTML = "Insert a name for the folder."
        }

        document.querySelector("#name_folder").value = null; 
    })
}