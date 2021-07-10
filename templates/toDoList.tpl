<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensolvers - Excercise</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/folders.css">
    <link rel="stylesheet" href="../css/items.css">
    <!--<script type="text/javascript" src="./js/nav.js"></script>-->
    <script src="../js/itemsApi.js"></script>
    <base href="{$base_url}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

 <!-- header -->
 
    {include file="header.tpl"}


 <!-- CUERPO DE LA PAGINA -->
    
    <article class="content">
        <div class="container">
        <h1 class ="folderName">To-Do List</h1>
        <section class="toDoSection">
            <ul class='itemsList'>
        
            </ul>
        </section>
        <section class="addItem">
            <input type="text" id="info_item" placeholder="New item">
            <button type="submit" id="btn_add">Add</button>
            <p class="error"></p>
        </section>
        </div>
    <a id="logout" class="item" href="logout">Log out!</a>
    </article>

</body>
</html>