<?php
    function calcularGorduraCorporal($sexo, $cintura, $altura, $pescoco = 0, $quadril = 0) {
        if ($sexo == "masculino") {
            return 495 / (1.0324 - 0.19077 * (log10($cintura - $pescoco)) + 0.15456 * (log10($altura))) - 450;
        } elseif ($sexo == "feminino") {
            return 495 / (1.29579 - 0.35004 * (log10($cintura + $quadril - $pescoco)) + 0.22100 * (log10($altura))) - 450;
        } else {
            return null; 
        }
    }

    
$sexo = "feminino";
$idade = 27;
$altura = 165;
$peso = 61.40;
$cintura = 74;
$quadril = 98.5;
$pescoco = 32;

$gordura_corporal = calcularGorduraCorporal($sexo, $cintura, $altura, $pescoco, $quadril);
$gordura_corporal = number_format($gordura_corporal, 2);

echo "O percentual de gordura corporal é de: $gordura_corporal%";



?>