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
        lista.innerHTML = "<a href='folders' class='linkFolders'>Folders > " + folder[0].name + "</a>";
        getItemsByFolder(folder[0].id);
        btn_submitAdd();
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
                lista.innerHTML += "<li class='folder'><div><input type='checkbox' class='check-button' id='"+ items.id_item +"' checked><label for='completed' class='nameItem'>" + items.info  + "</label></div><a class='botonEditar' id='"+ items.id_item+"'>Edit</a></li>"
            }else{
                lista.innerHTML += "<li class='folder'><div><input type='checkbox' class='check-button' id='"+ items.id_item +"'><label for='completed' class='nameItem'>" + items.info  + "</label></div><a class='botonEditar' id='"+ items.id_item+"'>Edit</a></li>"
            }
            btn_check();
            btn_edit();
            let submit = document.querySelector('.addItem');
            submit.innerHTML='<input type="text" id="info_item" placeholder="New item"><button type="submit" id="btn_add">Add</button><p class="error"></p>';
            btn_submitAdd();
        });
    }
    
    function btn_check () { 
        let buttons = document.getElementsByClassName('check-button'); 

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function() {
                    let id = buttons[i].id; //busco a cual fue al que se le dio click
                    let value = buttons[i].checked;
                    editCompletedItem(id, value);
                })
            }
    }

    function btn_edit(){
        let buttons = document.getElementsByClassName('botonEditar'); 
        
        for(let i = 0; i<buttons.length; i++) {          //con este for hago que todos los botones con la clase botoneditarTD funcionen
    
            buttons[i].addEventListener('click', () => { 
                let name = buttons[i].parentElement.childNodes[0].outerText;
                let id = buttons[i].parentElement.childNodes[1].id;

                document.querySelector('.folderName').innerHTML = 'Editing: "'+ name +'"';
                let list = document.querySelector('.itemsList');
                list.innerHTML='';
                let submit = document.querySelector('.addItem');
                submit.innerHTML= '<input type="text" id="info_item" placeholder="Edit item"><button type="submit" id="btn_edit">Save</button><button id="btn_cancel">Cancel</button><p class="error"></p>'
                btn_submit_edit(id);
                btn_cancel();
            })
        }
    }

    function btn_cancel(){
        document.querySelector("#btn_cancel").addEventListener("click", function(e) {
            getFolder();
        });
    }

    function btn_submit_edit(id){
        document.querySelector("#btn_edit").addEventListener("click", function(e) {
            e.preventDefault();
            let info = document.querySelector("#info_item").value;
            let item = {
                "info": info,
            }
            
            fetch('api/items/' + id , {
                method: 'PUT',
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(item)
            })
            .then(response =>  response.json())
            .then(get => getFolder()) 
            .catch(error => console.log(error));
        })
    }
    
    function btn_submitAdd(){
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

    function editCompletedItem(id,value) {

        let item = {
            "completed": value,
        }
        
        fetch('api/items/check/' + id , {
            method: 'PUT',
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(item)
        })
        .then(response =>  response.json())
        .then(get => getFolder()) 
        .catch(error => console.log(error));
    }
}