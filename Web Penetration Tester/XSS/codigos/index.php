<?php

    if(isset($_GET['pesquisa']) and !empty($_GET['pesquisa'])){
        $pesquisa = $_GET['pesquisa'];
    }

?>


<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIte de teste</title>
</head>
<body>
    <center>
        <form action="/index.php" method="get">
            <label for="pesquisa">Pesquisar</label>
            <input type="text" name="pesquisa" id="">
            <input type="submit" value="Pesquisar">
        </form>
        <?php if(isset($pesquisa)): //and !strpos($pesquisa, "script")): ?>
            <?= "Você pesquisou $pesquisa" ?>
        <?php endif ?> 
    </center>
   <!-- 
    and !strpos($pesquisa, "script")
        bloqueia tags com a palavra script.
        Mas a tag script não é a UNICA FORMA de trigar um XSS reflected

        Explicação no resumo!
   -->   
</body>
</html>

