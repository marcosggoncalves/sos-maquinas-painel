create database sosmaquinas;

create table usuarios_admin(
	id int not null primary key auto_increment,
	email varchar(80) not null,
	senha varchar(40) not null 
);

create table usuarios(
	id int not null primary key auto_increment,
	email varchar(80),
	cpf varchar(20),
	empresa varchar(255),
	marca_veiculo varchar(255),
	tipo_veiculo varchar(255),
	nome varchar(255),
	telefone varchar(255)
);

create table publicidades(
	id int not null primary key auto_increment,
	imagem text,
	link text,
	cliente text,
	duracao time
);

create table categorias(
	id int not null primary key auto_increment,
	categoria text,
	imagem text
);

create table categorias_simbolos(
	id int not null auto_increment,
	descricao text,
	imagem text,
	titulo text,
	categoria_id int,
	PRIMARY KEY (id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

create table simbolos_items(
	id int not null  auto_increment,
	descricao text,
	tipo varchar(255),
	categoria_simbolo_id int,
	PRIMARY KEY (id),
    FOREIGN KEY (categoria_simbolo_id) REFERENCES categorias_simbolos(id) ON DELETE CASCADE
);

