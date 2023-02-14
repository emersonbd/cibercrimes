<?php
session_start();
include_once 'connect.php';
$valor = $_SESSION['valor'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Formulário de reclamação para crimes cibernéticos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" media="all" href="css\style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js" />
    </script>
</head>

<body>

    <main class="Site-content">
        <div class="header">
            <h1 class="header_logo">Formulário de reclamação para crimes cibernéticos</h1>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="div-section">
                        <form method="POST" action="" name="f1" enctype="multipart/form-data">
                            <div class="box-aviso">
                                <div class="form-group">
                                        <h2>Seu formulário foi submetido e será analisado.</h2><br>
                                        <h2>Para atendimento, seu número de protocolo é:</h2>
                                        <br>
                                        <h1><?php echo $valor ?></h1>
                                </div>
                            </div>
                            <div class="div-botao">
                                <button class="btn btn-primary botao-enviar" onclick="printFunction()">Salvar número de protocolo</button>

                                <script>
                                function printFunction() {
                                    window.print();
                                }
                                </script>
                                <a  href="form-novo.php" class="btn btn-primary botao-enviar">Voltar</a>
                            </div><br>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>


    </main>

    <footer></footer>

</body>

</html>