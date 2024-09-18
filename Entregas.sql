create database Entregas;
use Entregas;

create table Pedidos(
	id_pedidos int primary key auto_increment,
    nome_cliente varchar(100),
    quantidade int,
    nome_produto varchar(100),
    data_entrega date
);