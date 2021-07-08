<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensolvers - Excercise</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/folders.css">
    <script type="text/javascript" src="./js/nav.js"></script>
    <base href="{$base_url}">
</head>

<body>

 <!-- header -->
 
    {include file="header.tpl"}


 <!-- CUERPO DE LA PAGINA -->
    
    <article class="content">
        <section class="folders">
            <h1>Folders</h1>
            {foreach from=$folders item=folder}
            <a href= 'folder/{$folder->id}' class="folder"> {$folder->name}</a>
            {/foreach}
        </section>

    </article>

 <!-- FOOTER 

    {include file="footer.tpl"}-->

</body>
</html>