<?php
session_start();
$_SESSION['userName'] = 'Root';
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Declaração de Ocorrências de Cibercrimes</title>
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
    <?php
        // Receber os dados do formulario
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($_POST['CadArquivoPdf'])) { 

        // Acessa IF quando o usuário clica no botao
        if(!empty($dados['CadArquivoPdf'])){
            //var_dump($dados);

            // Receber o arquivo PDF do formulario
            $arquivo_pdf = $_FILES['arquivo_pdf'];
            //var_dump($arquivo_pdf);

        
                $arquivo_pdf_blob = file_get_contents($arquivo_pdf['tmp_name']);

                $query_arquivo = "INSERT INTO arquivos (nome, cpf, rg, email, idade, estado, cidade, bairro, endereco, complemento, cep, telefone, cb1, cb2, cb3, cb4, cb5, cb6, cb7, cb8, cb9, cb10, cb11, cb12, cb13, cb14, cb15, descricao, nome_documento, arquivo_pdf) VALUES (:nome, :cpf, :rg, :email, :idade, :estado, :cidade, :bairro, :endereco, :complemento, :cep, :telefone, :cb1, :cb2, :cb3, :cb4, :cb5, :cb6, :cb7, :cb8, :cb9, :cb10, :cb11, :cb12, :cb13, :cb14, :cb15, :descricao, :nome_documento, :arquivo_pdf)";
                $cad_arquivo = $conn->prepare($query_arquivo);
                $cad_arquivo->bindParam(':nome', $dados['nome']);
                $cad_arquivo->bindParam(':cpf', $dados['cpf']);
                $cad_arquivo->bindParam(':rg', $dados['rg']);
                $cad_arquivo->bindParam(':email', $dados['email']);
                $cad_arquivo->bindParam(':idade', $dados['idade']);
                $cad_arquivo->bindParam(':estado', $dados['estado']);
                $cad_arquivo->bindParam(':cidade', $dados['cidade']);
                $cad_arquivo->bindParam(':bairro', $dados['bairro']);
                $cad_arquivo->bindParam(':endereco', $dados['endereco']);
                $cad_arquivo->bindParam(':complemento', $dados['complemento']);
                $cad_arquivo->bindParam(':cep', $dados['cep']);
                $cad_arquivo->bindParam(':telefone', $dados['telefone']);
                $cad_arquivo->bindParam(':cb1', $dados['cb1']);
                $cad_arquivo->bindParam(':cb2', $dados['cb2']);
                $cad_arquivo->bindParam(':cb3', $dados['cb3']);
                $cad_arquivo->bindParam(':cb4', $dados['cb4']);
                $cad_arquivo->bindParam(':cb5', $dados['cb5']);
                $cad_arquivo->bindParam(':cb6', $dados['cb6']);
                $cad_arquivo->bindParam(':cb7', $dados['cb7']);
                $cad_arquivo->bindParam(':cb8', $dados['cb8']);
                $cad_arquivo->bindParam(':cb9', $dados['cb9']);
                $cad_arquivo->bindParam(':cb10', $dados['cb10']);
                $cad_arquivo->bindParam(':cb11', $dados['cb11']);
                $cad_arquivo->bindParam(':cb12', $dados['cb12']);
                $cad_arquivo->bindParam(':cb13', $dados['cb13']);
                $cad_arquivo->bindParam(':cb14', $dados['cb14']);
                $cad_arquivo->bindParam(':cb15', $dados['cb15']);
                $cad_arquivo->bindParam(':descricao', $dados['descricao']);
                $cad_arquivo->bindParam(':nome_documento', $arquivo_pdf['name']);
                $cad_arquivo->bindParam(':arquivo_pdf', $arquivo_pdf_blob);
                $cad_arquivo->execute();

                if($cad_arquivo->rowCount()){
                    echo "<p style='color: green;'>Arquivo cadastrado com sucesso!</p>";
                }else{
                    echo "<p style='color: #f00;'>Erro: Arquivo não cadastrado com sucesso!</p>";
                }
        }

        header("location:confirmacao.php");

    }

    $sql = "SELECT id from arquivos ORDER BY id DESC LIMIT 1";
    $result = $conn->query( $sql );
    $rows = $result->fetch();
    $valor = $rows[array_key_last($rows)];

    $_SESSION['valor'] = $valor;
?>

    <!-- script pra prevenir o cadastro repetido com o refresh da página -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>

    <main class="Site-content">
        <div class="header">
            <h1 class="header_logo">Declaração de Ocorrências de Cibercrimes</h1>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="div-section">
                        <h3>Informações para contato</h3>
                        <br>

                        <form method="POST" action="" name="f1" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome completo:</label>
                                <input type="text" class="form-control" id="nome" aria-describedby="emailHelp"
                                    name="nome" required>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control" id="cpf" aria-describedby="emailHelp"
                                        placeholder="000.000.000-00" name="cpf" required>
                                </div>
                                <div class="form-group col">
                                    <label for="rg">RG:</label>
                                    <input type="text" class="form-control" id="rg" aria-describedby="emailHelp"
                                        placeholder="00.000.000-0" name="rg" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" class="form-control" id="email" aria-describedby="emailHelp"
                                    name="email" onblur="validacaoEmail(f1.email)" name="email" required>
                            </div>
                            <div id="msgemail"></div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="idade">Idade:</label>
                                <select class="custom-select my-1 mr-sm-2" id="idade" name="idade" required>
                                    <option disabled selected value> -- selecione uma faixa etária -- </option>
                                    <option value="faixa1" id="faixa1">Menor de 20 anos</option>
                                    <option value="faixa2" id="faixa2">Entre 20 e 29 anos</option>
                                    <option value="faixa3" id="faixa3">Entre 30 e 39 anos</option>
                                    <option value="faixa4" id="faixa4">Entre 40 e 49 anos</option>
                                    <option value="faixa5" id="faixa5">Entre 50 e 59 anos</option>
                                    <option value="faixa6" id="faixa6">Acima de 60 anos</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="estado">Estado:</label>
                                    <select id="estado" class="custom-select my-1 mr-sm-2" name="estado" required>
                                        <option disabled selected value> -- selecione um estado -- </option>
                                        <option value="AC" id="AC">Acre</option>
                                        <option value="AL" id="AL">Alagoas</option>
                                        <option value="AP" id="AP">Amapá</option>
                                        <option value="AM" id="AM">Amazonas</option>
                                        <option value="BA" id="BA">Bahia</option>
                                        <option value="CE" id="CE">Ceará</option>
                                        <option value="DF" id="DF">Distrito Federal</option>
                                        <option value="ES" id="ES">Espírito Santo</option>
                                        <option value="GO" id="GO">Goiás</option>
                                        <option value="MA" id="MA">Maranhão</option>
                                        <option value="MT" id="MT">Mato Grosso</option>
                                        <option value="MS" id="MS">Mato Grosso do Sul</option>
                                        <option value="MG" id="MG">Minas Gerais</option>
                                        <option value="PA" id="PA">Pará</option>
                                        <option value="PB" id="PB">Paraíba</option>
                                        <option value="PR" id="PR">Paraná</option>
                                        <option value="PE" id="PE">Pernambuco</option>
                                        <option value="PI" id="PI">Piauí</option>
                                        <option value="RJ" id="RJ">Rio de Janeiro</option>
                                        <option value="RN" id="RN">Rio Grande do Norte</option>
                                        <option value="RS" id="RS">Rio Grande do Sul</option>
                                        <option value="RO" id="RO">Rondônia</option>
                                        <option value="RR" id="RR">Roraima</option>
                                        <option value="SC" id="SC">Santa Catarina</option>
                                        <option value="SP" id="SP">São Paulo</option>
                                        <option value="SE" id="SE">Sergipe</option>
                                        <option value="TO" id="TO">Tocantins</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" class="form-control" id="cidade" aria-describedby="emailHelp"
                                        name="cidade" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bairro">Bairro:</label>
                                <input type="text" class="form-control" id="bairro" aria-describedby="emailHelp"
                                    name="bairro" required>
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" aria-describedby="emailHelp"
                                    name="endereco" required>
                            </div>
                            <div class="form-group">
                                <label for="complemento">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" aria-describedby="emailHelp"
                                    name="complemento">
                            </div>
                            <div class="form-group">
                                <label for="cep">CEP:</label>
                                <input type="text" class="form-control" id="cep" aria-describedby="emailHelp" name="cep"
                                    placeholder="00000-000" required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" aria-describedby="emailHelp"
                                    name="telefone" placeholder="(00)00000-0000" required>
                            </div>

                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-header">Roubo</h5>
                                        <ul class="list-group" id="l1">
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb1"
                                                    aria-label="..." name="cb1" id="cb1">
                                                Roubo de senha
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb2"
                                                    aria-label="..." name="cb2" id="cb2">
                                                Roubo de redes sociais
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb3"
                                                    aria-label="..." name="cb3" id="cb3">
                                                Roubo de e-mail
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb4"
                                                    aria-label="..." name="cb4" id="cb4">
                                                Roubo de dados ou fotos
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb5"
                                                    aria-label="..." name="cb5" id="cb5">
                                                Outros
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-header">Estelionato</h5>
                                        <ul class="list-group lista-tipos" id="l2">
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb6"
                                                    aria-label="..." name="cb6" id="cb6">
                                                Perfil falso em rede social
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb7"
                                                    aria-label="..." name="cb7" id="cb7">
                                                Roubo de identidade
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb8"
                                                    aria-label="..." name="cb8" id="cb8">
                                                Chantagem
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb9"
                                                    aria-label="..." name="cb9" id="cb9">
                                                Crimes financeiros
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb10"
                                                    aria-label="..." name="cb10" id="cb10">
                                                Clonagem de dados
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-header">Golpe</h5>
                                        <ul class="list-group" id="l3">
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb11"
                                                    aria-label="..." name="cb11" id="cb11">
                                                Falso sequestro
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb12"
                                                    aria-label="..." name="cb12" id="cb12">
                                                Falso emprego
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb13"
                                                    aria-label="..." name="cb13" id="cb13">
                                                Esquema de pirâmide
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb14"
                                                    aria-label="..." name="cb14" id="cb14">
                                                Criptoativos
                                            </li>
                                            <li class="list-group-item border-0">
                                                <input class="form-check-input me-1" type="checkbox" value="cb15"
                                                    aria-label="..." name="cb15" id="cb15">
                                                Golpe do príncipe nigeriano, ou similares
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descreva o acontecido com suas
                                    palavras:</label>
                                <textarea class="form-control" id="descricao" rows="8" name="descricao"
                                    required></textarea>
                            </div>
                            <br>

                            <div class="box-arquivos">
                                <div class="form-group"><label style="padding-bottom: 20px;">Compacte todos os arquivos relevantes à denúncia em um único arquivo .rar ou .zip e envie abaixo:</label>
                                    <input type="file" name="arquivo_pdf"><br><br>
                                </div>
                            </div>
                            <div class="div-botao">
                                <input type="submit" class="btn btn-primary botao-enviar" name="CadArquivoPdf"
                                    value="Enviar">
                            </div><br>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                $("#cpf").mask("999.999.999-99");
            });

            $(document).ready(function() {
                $("#rg").mask("99.999.999-9");
            });

            $(document).ready(function() {
                $("#cep").mask("99999-999");
            });

            function validacaoEmail(field) {
                usuario = field.value.substring(0, field.value.indexOf("@"));
                dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

                if ((usuario.length >= 1) &&
                    (dominio.length >= 3) &&
                    (usuario.search("@") == -1) &&
                    (dominio.search("@") == -1) &&
                    (usuario.search(" ") == -1) &&
                    (dominio.search(" ") == -1) &&
                    (dominio.search(".") != -1) &&
                    (dominio.indexOf(".") >= 1) &&
                    (dominio.lastIndexOf(".") < dominio.length - 1)) {
                    document.getElementById("email").style.border = "1px solid green";
                    document.getElementById("msgemail").style.visibility = "hidden";
                    document.getElementById("msgemail").style.height = "0px";
                } else {
                    document.getElementById("msgemail").style.visibility = "visible";
                    document.getElementById("email").style.border = "1px solid red";
                    document.getElementById("msgemail").innerHTML = "<font color='red'>E-mail inválido </font>";
                    document.getElementById("msgemail").style.height = "20px";
                }
            };

            var phoneMask = IMask(
                document.getElementById('telefone'), {
                    mask: '(00)00000-0000'
                });
            </script>

    </main>

    <footer></footer>

</body>

</html>