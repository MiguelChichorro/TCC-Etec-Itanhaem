create database if not exists trampo_certo;
	
use trampo_certo;

create table usuario(
cd_usuario int not null primary key auto_increment,
nm_usuario varchar(75) not null,
ds_email varchar(60) unique not null,
ds_password varchar(20) not null,
nr_cpf varchar(11) unique,
nr_celular varchar(11),
dt_nascimento date,
ds_usendereco varchar(80),
st_admin boolean,
st_ativo boolean,
ds_avaliacao int,
st_foto varchar(255) not null
);


create table servico(
cd_servico int not null primary key auto_increment,
nm_servico varchar(20) not null,
ds_servico varchar(100) not null,
ds_endereco varchar(80) not null,
dt_servico date not null,
dt_prazo date not null, 
id_usuario int not null,
id_categoria int not null,
st_servico boolean not null,
id_orcamento int(11) not null
);

create table categoria(
cd_categoria int not null primary key auto_increment,
nm_categoria varchar(20) not null,
ds_categoria varchar(60) not null,
ds_ftcategoria text not null
);

create table orcamento(
cd_orcamento int not null primary key auto_increment,
id_servico int not null,
id_usuariot int not null,
vl_orcamento varchar(10) not null,
ds_orcamento varchar (200) not null
);

create table report_perfil(
cd_reportperfil int not null primary key auto_increment,
ds_report varchar(200) not null,
dt_report date not null,
id_reporter int not null,
id_reportado int not null,
st_report boolean not null
);

create table report_servico(
cd_reportservico int not null primary key auto_increment,
ds_reports varchar(200) not null,
dt_reports date not null,
id_servicorep int not null,
id_reporters int not null,
id_reportados int not null,
st_reports boolean not null
);

create table arquivo (
  cd_arquivo int(11) not null primary key auto_increment,
  id_usuariof int(11) not null,
  ds_arquivo varchar(40) not null,
  dt_data datetime not null
);

create table usuario_suspenso(
cd_suspenso int not null primary key auto_increment,
id_usuariosuspenso int not null,
dt_inicio datetime not null,
dt_fim datetime not null
);

create table nota(

cd_nota int not null primary key auto_increment,
ds_nota int not null,
id_usuarion int not null,
id_usuarionotado int not null,
id_serviconota int not null
);

alter table servico
add constraint id_usuario foreign key (id_usuario) references usuario (cd_usuario);

alter table servico
add constraint id_orcamento foreign key (id_orcamento) references orcamento (cd_orcamento);

alter table servico
add constraint id_categoria foreign key (id_categoria) references categoria (cd_categoria);

alter table orcamento
add constraint id_servico foreign key (id_servico) references servico (cd_servico);

alter table orcamento
add constraint id_usuariot foreign key (id_usuariot) references usuario (cd_usuario);

alter table report_perfil
add constraint id_reporter foreign key (id_reporter) references usuario (cd_usuario);

alter table report_perfil
add constraint id_reportado foreign key (id_reporter) references usuario (cd_usuario);

alter table report_servico
add constraint id_servicorep foreign key (id_servicorep) references servico (cd_servico);

alter table report_servico
add constraint id_reporters foreign key (id_reporters) references usuario (cd_usuario);

alter table report_servico
add constraint id_reportados foreign key (id_reportados) references usuario (cd_usuario);

alter table arquivo
add constraint id_usuariof foreign key (id_usuariof) references usuario (cd_usuario);

alter table usuario_suspenso
add constraint id_usuariosuspenso foreign key (id_usuariosuspenso) references usuario (cd_usuario);

alter table nota
add constraint id_usuarion foreign key (id_usuarion) references usuario (cd_usuario);

alter table nota
add constraint id_usuarionotado foreign key (id_usuarionotado) references usuario (cd_usuario);

alter table nota
add constraint id_serviconota foreign key (id_serviconota) references servico (cd_servico);

insert into categoria values(NULL, 'Pintor', 'Profissional em pintar', '0');

CREATE TRIGGER trg_usuarioSuspenso after insert
on usuario_suspenso 
for each row 
begin 
	update usuario set st_ativo = 0 where cd_usuario = new.id_usuariosuspenso;
