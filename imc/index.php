<?php
function gorduraHomem($cintura, $pescoco, $altura) {
    return 495 / (1.0324 - 0.19077 * (log10($cintura - $pescoco)) + 0.15456 * (log10($altura))) - 450;
}

function gorduraMulher($cintura, $quadril, $pescoco, $altura) {
    return 495 / (1.29579 - 0.35004 * (log10($cintura + $quadril - $pescoco)) + 0.22100 * (log10($altura))) - 450;
}
$color = "rgb(196, 174, 174)";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if (isset($_GET['altura']) && isset($_GET['peso']) 
    && isset($_GET['sexo']) && isset($_GET['cintura']) 
    && isset($_GET['quadril']) && isset($_GET['pescoco']) 
    && isset($_GET['idade'])) {
        $sexo = $_GET['sexo'];
        $altura = $_GET['altura'] / 100; 
        $peso = $_GET['peso'];
        $cintura = $_GET['cintura'];
        $quadril = $_GET['quadril'];
        $pescoco = $_GET['pescoco'];
        $idade = $_GET['idade'];


        #Verificando o gênero da pessoa
        if ($sexo == "masculino") {
            $gordura_corporal = gorduraHomem($cintura, $pescoco, $altura);
        }
        else if($sexo == "feminino") {
            $gordura_corporal = gorduraMulher($cintura, $quadril, $pescoco, $altura);
        }
        $gordura_corporal = number_format($gordura_corporal, 2);
        $imc = $peso / ($altura * $altura);
        $imc = number_format($imc, 2);

        if($imc < 18.50){
            $color = "#6FB4EA";#ABAIXO
            $peso = "Abaixo do Normal";
        }
        else if($imc >= 18.50 && $imc <=24.99) {       
            $color = "#7EC395";#NORMAL
            $peso = "Normal";
        }
        else if($imc >= 25.00 && $imc <=29.99) {
            $color = "##FFA728";#SOBREPESO
            $peso = "Sobrepeso";
        }
        else if($imc >= 30.00 && $imc <=34.99) {
            $color = "#FFA728";#OBESIDADE I
            $peso = "Obesidade I";

        }
        else if($imc >= 35.00 && $imc <=39.99) {
            $color = "#FC6E3E"; #OBSEIDADE II
            $peso = "Obesidade II";

        }
        else {
            $color= "#DE4D55"; #OBESIDADE III
            $peso = "Obesidade III";

        }
        

    } else {
        echo "<p>Por favor, preencha todos os campos do formulário.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMC</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="content">
        <div id="div-title">
            <h1 id="title">Calculo de IMC</h1>
        </div>
        <div id="main">

            <form action="" method="get" id="form">
                <label for="sexo">SEXO</label>
                <select id="sexo" name="sexo">
                    <option value="" disabled selected hidden>Selecione o seu sexo</option>
                    <option value="feminino">Feminino</option>
                    <option value="masculino">Masculino</option>
                </select>

                <label for="altura">ALTURA (cm):</label>
                <input type="number" step="0.01" id="altura" name="altura" placeholder="Digite sua altura">
                <label for="peso">PESO</label>
                <input type="number" step="0.01" id="peso" name="peso" placeholder="Digite seu peso">
                <label for="cintura">CINTURA (cm):</label>
                <input type="number" step="0.01" id="cintura" name="cintura" placeholder="Digite a medida de sua cintura">
                <label for="quadril">QUADRIL (cm):</label>
                <input type="number" step="0.01" id="quadril" name="quadril" placeholder="Digite a medida de seu quadril">
                <label for="pescoco">PESCOÇO (cm):</label>
                <input type="number" step="0.01" id="pescoco" name="pescoco" placeholder="Digite a medida de seu pescoço">
                <label for="idade">IDADE:</label>
                <input type="number" id="idade" name="idade" placeholder="Digite a sua idade"> <!-- Corrigido aqui -->

                <input id="calc-button" type="submit" value="CALCULAR">
            </form>
            <input id="clear-button" type="submit" value="LIMPAR"> <!-- CLEAR BUTTON HERE -->


            <div id="result-main">
                <div id="result-content">
                    <h2>IMC CALCULADO:</h2>
                    <div id="imc-result" style="background-color: <?=$color?>;">
                    <?php
                        if(isset($imc)) {
                            echo "<p id='imc'>IMC: $imc</p>";
                            }
                        else {
                            echo "<p id='imc'>TESTE IMC</p>";
                        }
                        ?>
                        
                        <?php
                        if(isset($peso)) {
                            echo "<p id='peso'>$peso</p>";
                            }
                        ?>
                    </div>
                    <?php
                    if(isset($gordura_corporal)){
                        echo "<h3 id='alert'>Porcentual de Gordura: $gordura_corporal%</h3>";
                      }
                    else {
                        echo "<h3 id='alert'>Porcentual de Gordura:%</h3>";
                    }
                    ?>



                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate, voluptatum earum est
                        sed fugiat magnam animi accusantium commodi, perferendis odio exercitationem tempore ullam
                        aspernatur consequatur nesciunt amet natus doloribus? Cupiditate! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit officia quos delectus amet, veritatis exercitationem? Autem aspernatur doloribus adipisci mollitia sed laborum impedit ipsum. Atque nulla odio temporibus sed optio!</p>
                </div>

            </div>


        </div>
    </div>

    <div id="imc-table">
        <p id="p-table">
            O nível de IMC foi definido pelas cores:
        </p>

            <div class="imc-color" id="abaixo"><p>ABAIXO DO NORMAL</p></div>
            <div class="imc-color" id="normal"><p>PESO NORMAL</p></div>
            <div class="imc-color" id="sobrepeso"><p>SOBREPESO</p></div>
            <div class="imc-color" id="obesidade1"><p>OBESIDADE I</p></div>
            <div class="imc-color" id="obesidade2"><p>OBESIDADE II</p></div>
            <div class="imc-color" id="obesidade3"><p>OBESIDADE III</p></div>

    </div>


</body>

</html>
