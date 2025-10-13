# PHP + MySQL Delivery Orders (Single-File CRUD)

This repository contains a **PHP project with MySQL** that implements a simple CRUD (**Create, Read, Update, Delete**) system for managing product delivery orders.  

Unlike other projects where the logic may be separated into multiple files, this one keeps **all functionality inside a single file (`index.php`)**:  
- Database connection  
- Insert new records  
- Update existing records  
- Delete records  
- Reset the entire table  
- Display the table in HTML  

---

## 📂 Database Structure (MySQL)

The system uses a database named **Entregas** with a single table **Pedidos**:  

```sql
CREATE DATABASE Entregas;
USE Entregas;

CREATE TABLE Pedidos (
    id_pedidos INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(100),
    quantidade INT,
    nome_produto VARCHAR(100),
    data_entrega DATE
);
id_pedidos → Auto-incremented primary key.

nome_cliente → Name of the client.

quantidade → Quantity of products.

nome_produto → Name of the product.

data_entrega → Expected delivery date.

⚙️ PHP Code (index.php)
The PHP code begins with the database connection using mysqli:

php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Entregas";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
🔹 Create (Insert)
When the Add form is submitted, PHP collects the inputs and inserts them into the Pedidos table:

php

if(isset($_POST['create'])){
    $nomeCli = $_POST['NomeCli'];
    $Quantidade = $_POST['Quantidade'];
    $NomePro = $_POST['NomePro'];
    $DataEntrega = $_POST['DataEntrega'];

    $sql = "INSERT INTO Pedidos (nome_cliente, quantidade, nome_produto, data_entrega) 
            VALUES ('$nomeCli', '$Quantidade', '$NomePro', '$DataEntrega')";
    $conn->query($sql);
}
🔹 Delete
If the user clicks Excluir, PHP receives the id via $_GET and deletes the record:

php

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM pedidos WHERE id_pedidos=$id";
    $conn->query($sql);
}
🔹 Update
The Update form sends data (including the record ID) via POST, and PHP updates that row:

php

if(isset($_POST['Editar'])){
    $ID = $_POST['id_pedidos'];
    $nomeCli = $_POST['NomeCli'];
    $Quantidade = $_POST['Quantidade'];
    $NomePro = $_POST['NomePro'];
    $DataEntrega = $_POST['DataEntrega'];

    $sql = "UPDATE Pedidos 
            SET nome_cliente='$nomeCli', quantidade='$Quantidade', 
                nome_produto='$NomePro', data_entrega='$DataEntrega' 
            WHERE id_pedidos=$ID";
    $conn->query($sql);
}
🔹 Reset (Truncate)
A link Reiniciar clears all records by running TRUNCATE TABLE Pedidos.

🖥️ HTML + PHP Integration
The HTML part contains two forms:

1️⃣ Add New Order
html

<form method="POST" action="index.php">
    <label for="NomeCli">Client Name:</label>
    <input type="text" name="NomeCli" required>
    
    <label for="Quantidade">Quantity:</label>
    <input type="number" name="Quantidade" required>
    
    <label for="NomePro">Product Name:</label>
    <input type="text" name="NomePro" required>
    
    <label for="DataEntrega">Delivery Date:</label>
    <input type="date" name="DataEntrega" required>
    
    <input type="submit" name="create" value="Add">
</form>
📌 Tags explained:

<form method="POST" action="index.php"> → Sends data to the same page.

<label> → Describes the input.

<input> → Collects user data (text, number, date).

required → Prevents form submission if empty.

<input type="submit"> → Button that sends data.

2️⃣ Update an Existing Order
html

<form method="POST" action="index.php">
    <label for="NomeCli">Client Name:</label>
    <input type="text" name="NomeCli" required>
    
    <label for="Quantidade">Quantity:</label>
    <input type="number" name="Quantidade" required>
    
    <label for="NomePro">Product Name:</label>
    <input type="text" name="NomePro" required>
    
    <label for="DataEntrega">Delivery Date:</label>
    <input type="date" name="DataEntrega" required>
    
    <label for="ID">ID:</label>
    <input type="number" name="id_pedidos" required>
    
    <input type="submit" name="Editar" value="Update">
</form>
Here, the ID of the order is required to identify which row should be updated.

📊 Displaying Data
After processing forms, PHP executes:

php

$sql = "SELECT * FROM Pedidos";
$resultado = $conn->query($sql);
If there are rows, they are displayed inside an HTML table:

html

<table border="1">
    <tr>
        <th>id_pedidos</th>
        <th>nome_cliente</th>
        <th>quantidade</th>
        <th>nome_produto</th>
        <th>data_entrega</th>
        <th>delete</th>
    </tr>
Each row has an Excluir link:

html

<a href="index.php?delete=ID">Delete</a>
🚀 Summary
This project is a basic CRUD in PHP + MySQL.

Everything (backend + frontend) is inside index.php.

MySQL manages the table, while PHP handles logic and HTML forms handle user input.

It’s a good beginner exercise to understand how PHP interacts with MySQL and HTML.
