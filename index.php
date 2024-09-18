<?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "Entregas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn -> connect_error){
        die("Conexão falhou:" . $conn -> connect_error);
    }

    if(isset($_POST['create'])){

        $nomeCli = $_POST['NomeCli'];
        $Quantidade = $_POST['Quantidade'];
        $NomePro = $_POST['NomePro'];
        $DataEntrega = $_POST['DataEntrega'];

        $sql = "INSERT INTO Pedidos (nome_cliente, quantidade, nome_produto, data_entrega) values ('$nomeCli', '$Quantidade', '$NomePro', '$DataEntrega')";
        
        if($conn -> query($sql) === TRUE){
            echo "Registro Adicionado";
        }else{
            echo "Erro . $sql<br>" . $conn -> error;
        }

    }

    


        

    

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql = "DELETE FROM pedidos where id_pedidos=$id";

        if($conn -> query($sql) === TRUE){
            echo "Pedido Excluido";
        }else{
            echo "Erro . $sql<br>" . $conn -> error;
        }
    }


    if(isset($_POST['Editar'])){
        $nomeCli = $_POST['NomeCli'];
        $Quantidade = $_POST['Quantidade'];
        $NomePro = $_POST['NomePro'];
        $DataEntrega = $_POST['DataEntrega'];
        $ID = $_POST['id_pedidos'];

        $sql = "UPDATE Pedidos SET nome_cliente = '$nomeCli', Quantidade='$Quantidade', nome_produto='$NomePro', data_entrega='$DataEntrega' WHERE id_pedidos=$ID";
    
        if($conn -> query($sql) === TRUE){
            echo '<br>Atualizado com sucesso!<br>';
        }else {
            echo "Erro: " . $sql . "<br>" . $conn -> error;
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Pedidos</title>
</head>
<body>
    <form method="POST" action="index.php">
        <label for="NomeCli">Nome Cliente:</label>
        <input type="text" name="NomeCli" required>
        <label for="Quantidade">Quantidade:</label>
        <input type="number" name="Quantidade" required>
        <label for="NomePro">Nome Produto:</label>
        <input type="text" name="NomePro" required>
        <label for="DataEntrega">Data entrega:</label>
        <input type="Date" name="DataEntrega" required>
        <input type="Submit" name="create" value="Adicionar"> 
    </form>

    <form method ="POST" action="index.php">
    <label for="NomeCli">Nome Cliente:</label>
        <input type="text" name="NomeCli" required>
        <label for="Quantidade">Quantidade:</label>
        <input type="number" name="Quantidade" required>
        <label for="NomePro">Nome Produto:</label>
        <input type="text" name="NomePro" required>
        <label for="DataEntrega">Data entrega:</label>
        <input type="Date" name="DataEntrega" required>
        <label for="ID">ID:</label>
        <input type="Number" name="id_pedidos" required>
        <input type="Submit" name="Editar" value="Atualizar"> 
    </form>
    
<?php

echo '<br><a href="index.php?Reiniciar">Reiniciar</a>';

if(isset($_GET['Reiniciar'])){
    $sql = "Truncate Pedidos";
    
    if($conn -> query($sql) === TRUE){
        echo "Tabela Excluido";
    }else{
        echo "Erro . $sql<br>" . $conn -> error;
    }
}

$sql = "SELECT * FROM Pedidos";
    
$resultado = $conn -> query($sql);

if($resultado -> num_rows > 0){
    echo "<table border = '1'>
    <tr>
        <th> id_pedidos </th>
        <th> nome_cliente </th>
        <th> quantidade </th>
        <th> nome_produto </th>
        <th> data_entrega </th>
        <th> deletar </th>
    </tr>";
    
    while($row = $resultado -> fetch_assoc()){ 
    echo "<tr>
        
        <td> {$row['id_pedidos']}</td>
        <td> {$row['nome_cliente']}</td>
        <td> {$row['quantidade']}</td>
        <td> {$row['nome_produto']}</td>
        <td> {$row['data_entrega']}</td>
        <td>
            <a href='index.php?delete={$row['id_pedidos']}'>Excluir</a>
        </td>
    </tr>"; 
    }


    echo "</table>";
}else{
    echo"Nenhum registro encontrado.";
}




?>


</body>
</html>