<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
//Instanciando o SoapClient com o WSDL o qual vamos acessar
$client = new SoapClient('https://xxxxxx.seniorcloud.com.br:36101/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_colaboradoresAdmitidos?wsdl');

//Operação a ser executada
$function = 'ColaboradoresAdmitidos';

//Montando o payload de requisição
$parameters = array('user'            => 'senior.qsss',
                    'password'        => 'xxxx',
                    'encryption'      => 0,
                    'parameters'      => array( 'numEmp'      => '1',
                                                'abrTipCol'   => '1',
                                                'iniPer'      => '01/08/2022',
                                                'fimPer'      => '01/12/2022'));

 //Sobrescrevendo endpoint do serviço
$arguments = array('ColaboradoresAdmitidos' => array( $parameters));

$options = array('location' => 'https://web31.seniorcloud.com.br:36101/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_colaboradoresAdmitidos');

//Chamada do serviço
$result = $client->__soapCall($function, $parameters,$options);

$results = (array) $result->TMCSColaboradores;
$array = json_decode(json_encode($results), true);

//var_dump($results);
echo "<table class='table table-hover '>
        <tr>
           <td>Empresa</td>
           <td>Filial</td>
           <td>Matricula</td>
           <td>Nome</td>
           <td>Data Admissão</td>
           <td>Cargo</td>
        <tr>";
foreach($array as $row)
{
    echo "<tr>";
    echo "<td>".$row['numEmp']."</td>";
    echo "<td>".$row['codFil']."</td>";
    echo "<td>".$row['numCad']."</td>";
    echo "<td>".$row['nomFun']."</td>";
    echo "<td>".$row['datAdm']."</td>";
    echo "<td>".$row['titCar']."</td>";
    echo "</tr>";
}
echo "<table>";
die();
echo "<pre>";
var_dump($result);
echo "</pre>";
?>