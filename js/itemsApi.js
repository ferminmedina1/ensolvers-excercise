"use strict";
document.addEventListener('DOMContentLoaded', loadPage);

function loadPage () {
    
    getFolder();
    
 //SE OBTIENEN LAS CARPETAS
    function getFolder(){

        let id= getIdFolder();

        fetch('api/folders/'+ id)
            .then(response =>  response.json())
            .then(folder => renderFolder(folder)) 
            .catch(error => sinItems());
    }
 
    function getIdFolder(){    
        let url = window.location.href; 
        let id = url.substring(url.lastIndexOf('/') + 1); 
        return id;
    }

    function renderFolder(folder) {
        let lista = document.querySelector(".folderName"); 
        lista.innerHTML = "<a href='folders' class='linkFolders'>Folders</a> > " + folder[0].name;
        getItemsByFolder(folder[0].id);
    }

    function getItemsByFolder(id){
        fetch('api/items/folder/'+ id)
            .then(response =>  response.json())
            .then(items => renderItems(items)) //SE LLAMA A LA FUNCION QUE LOS MUESTRA
            .catch(error => sinItems());
    }

     
    function sinItems() {
        let lista = document.querySelector(".itemsList");

        lista.innerHTML = "Currently there are no items in this folder"
    }

    function renderItems(items) {
        let lista = document.querySelector(".itemsList");
        lista.innerHTML = "";       
        items.forEach(items => {
            if(items.completed == 1){
             lista.innerHTML += "<li class='folder'><input type='checkbox' id='completed' checked><label for='completed'>" + items.info  + "</label><a class='botonEditar' id='"+ items.id+"'>Edit</a></li>"
            }else{
                lista.innerHTML += "<li class='folder'><input type='checkbox' id='completed'><label for='completed'>" + items.info  + "</label><a class='botonEditar' id='"+ items.id+"'>Edit</a></li>"
            }
        });
    }

    document.querySelector("#btn_add").addEventListener("click", function(e) {
        e.preventDefault();

        let info = document.querySelector("#info_item").value;
        let idFolder = getIdFolder();

        let item = {
            "info": info,
            "id_folder": idFolder,
        }

        if(item.info != ""){  //SI ESTAN VACIOS LOS CAMPOS NO SE ENVIA
            let lista = document.querySelector(".error");
            lista.innerHTML = "";
            fetch('api/addItem', {
                method: 'POST',
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(item)
            })
                .then(response =>  response.json())
                .then(get => getFolder())   
                .catch(error => console.log(error));
        }else{
            document.querySelector(".error").innerHTML = "Insert information for the item."
        }

        document.querySelector("#info_item").value = null;  //SE RESETEAN LOS CAMPOS DEL FORMULARIO
    })
}