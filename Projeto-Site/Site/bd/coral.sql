create database if not exists coral_books;
use coral_books;

create table leitor (
    id_leitor int auto_increment primary key,
    nome varchar(100),
    email varchar(100),
    senha varchar(255)
);

create table estabelecimento (
    id_livraria int auto_increment primary key,
    nome_res varchar(100),
    nome_est varchar(100),
    endereco varchar(50),
    cidade varchar(25),
    estado char(2),
    telefone varchar(20),
    email varchar(100),
    senha varchar(255)
);

create table livros (
    id_livro int auto_increment primary key,
    id_livraria int,
    titulo varchar(150),
    autor varchar(120),
    genero varchar(80),
    isbn varchar(20),
    capa varchar(255),
    descricao text,
    preco decimal(10,2),
    estoque int not null default 0,
    status enum('a_venda', 'emprestimo', 'indisponivel') not null default 'a_venda',
    corredor varchar(20),
    prateleira varchar(20),
    secao varchar(60),
    criado_em datetime,

    foreign key (id_livraria)
    references estabelecimento(id_livraria)
);