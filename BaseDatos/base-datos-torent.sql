DROP DATABASE IF EXISTS torent;
CREATE DATABASE IF NOT EXISTS torent
CHARACTER SET  utf8
COLLATE utf8_unicode_ci;
USE torent;
/*
drop table if exists tr01per;
create table if not exists tr01per
(
idp_01in int(15) not null primary key comment 'id persona',
nom_01vc varchar(50) not null comment 'nombre',
ap1_01vc varchar(50) not null comment 'apellido 1',
ap2_01vc varchar(50) not null comment 'apellido 2',
tel_01vc varchar(50) not null comment 'telefono',
gen_01in int(1) not null comment 'genero',
ema_01vc varchar(50) not null comment 'email',
dir_01vc varchar(50) not null comment 'dirección',
ncu_01vc varchar(50) not null comment 'numero de cuenta',
fna_01dt date not null comment 'fecha nacimiento',
nac_01vc varchar(50) not null comment 'nacionalidad'
)
character set utf8,
collate utf8_unicode_ci,
engine=innodb;
*/
CREATE TABLE IF NOT EXISTS tr02usu
(
nus_02in INT(10) NOT NULL AUTO_INCREMENT COMMENT 'Número de Usuario',
idp_02in INT(10) NOT NULL COMMENT 'Cédula',
con_02vc VARCHAR(250) NOT NULL COMMENT 'Contraseña',
est_02in INT(3) NOT NULL DEFAULT 0 COMMENT 'Estado',
idr_03in INT(3) NULL COMMENT 'Rol',
nom_02vc VARCHAR(50) NOT NULL COMMENT 'Nombre',
ap1_02vc VARCHAR(50) NOT NULL COMMENT 'Apellido 1',
ap2_02vc VARCHAR(50) NOT NULL COMMENT 'Apellido 2',
tel_02vc VARCHAR(50) NOT NULL COMMENT 'Teléfono',
gen_02in INT(1) NOT NULL COMMENT 'Género',
ema_02vc VARCHAR(50) NOT NULL COMMENT 'Email',
dir_02vc VARCHAR(50) NOT NULL COMMENT 'Dirección',
ncu_02vc VARCHAR(50) NULL COMMENT 'Número de Cuenta',
fna_02dt DATE NOT NULL COMMENT 'Fecha Nacimiento',
nac_02vc VARCHAR(50) NOT NULL COMMENT 'Nacionalidad',
PRIMARY KEY(idp_02in,nus_02in),
UNIQUE KEY(nus_02in)
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;
/*
create table if not exists tr03rol
(
idr_03in int(3) not null auto_increment primary key comment 'Id Rol',
rol_03vc varchar(50) not null comment 'Rol'
)
character set utf8,
collate utf8_unicode_ci,
engine=innodb;*/

CREATE TABLE IF NOT EXISTS tr04pri
(
idp_04in INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Id Privilegio',
pri_04vc VARCHAR(50) NOT NULL COMMENT 'Privilegio',
lis_04vc VARCHAR(100) NOT NULL COMMENT 'Menú nav bar'
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tr05usu_pri
(
nus_02in INT(10) NOT NULL COMMENT 'Número de Usuario',
idp_04in INT(3) NOT NULL COMMENT 'Id Privilegio',
PRIMARY KEY(nus_02in,idp_04in)
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tr06cli
(
idp_06in INT(10) NOT NULL COMMENT 'Cédula',
con_06vc VARCHAR(250) NOT NULL COMMENT 'Contraseña',
ncl_06in INT(10) NOT NULL AUTO_INCREMENT COMMENT 'Número de Cliente',
emo_06in INT(1) NOT NULL COMMENT 'Estado de Morosidad',
obs_06vc VARCHAR(50) COMMENT 'Observaciones',
nom_06vc VARCHAR(50) NOT NULL COMMENT 'Nombre',
ap1_06vc VARCHAR(50) NOT NULL COMMENT 'Apellido 1',
ap2_06vc VARCHAR(50) NOT NULL COMMENT 'Apellido 2',
tel_06vc VARCHAR(50) NOT NULL COMMENT 'Teléfono',
gen_06in INT(1) NOT NULL COMMENT 'Género',
ema_06vc VARCHAR(50) NOT NULL COMMENT 'Email',
dir_06vc VARCHAR(50) NOT NULL COMMENT 'Dirección',
ncu_06vc VARCHAR(50) NOT NULL COMMENT 'Número de Cuenta',
fna_06dt DATE NOT NULL COMMENT 'Fecha Nacimiento',
nac_06vc VARCHAR(50) NOT NULL COMMENT 'Nacionalidad',
PRIMARY KEY(idp_06in,ncl_06in),
UNIQUE KEY(ncl_06in)
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;
/*
create table if not exists tr07emp
(
idp_01in int(10) not null comment 'id persona',
nem_07in int(10) not null auto_increment comment 'numero de empleado',
obs_07vc varchar(50) comment 'observaciones',
unique key(nem_07in)
)
character set utf8,
collate utf8_unicode_ci,
engine=innodb;
*/
CREATE TABLE IF NOT EXISTS tr08nhr
(
idn_08in INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Id nombre herramienta',
nom_08vc VARCHAR(50) NOT NULL COMMENT 'Nombre'
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tr09mar
(
cgm_09in INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Código de marca',
nom_09vc VARCHAR(50) NOT NULL COMMENT 'Nombre',
est_09in INT NOT NULL COMMENT 'Estado' /*los estados son int*/
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tr10her
(
chr_10in INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Código de herramienta',
idn_08in INT(10) NOT NULL COMMENT 'Id nombre herramienta',
cgm_09in INT(10) NOT NULL COMMENT 'Código de marca',
vol_10in INT(5) NOT NULL COMMENT 'Voltaje',
des_10vc VARCHAR(100) NOT NULL COMMENT 'Descripcion',
vut_10in INT(5) NOT NULL COMMENT 'Vida util años',
gar_10in INT(5) NOT NULL COMMENT 'Garantía en meses',
tip_10in INT(5) NOT NULL COMMENT 'Tipo', /*los tipos tambien son int*/
est_10in INT(5) NOT NULL COMMENT 'Estado de la herramienta',
alq_10in INT(5) NOT NULL COMMENT 'Alquilada'
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tr11alq
(
nsa_11in INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Número alquiler',
nus_02in INT(10) NOT NULL COMMENT 'Usuario',
chr_10in INT(10) NOT NULL COMMENT 'Código de herramienta',
ncl_06in INT(10) NOT NULL COMMENT 'Número de cliente',
fpr_11dt DATE NOT NULL COMMENT 'Fecha préstamo',
fde_11dt DATE NOT NULL COMMENT 'Fecha devolución',
epr_11in INT(5) NOT NULL COMMENT 'Estado préstamo',
ede_11in INT(5) COMMENT 'Estado devolución',
est_11in INT(5) NOT NULL COMMENT 'Estado',
obs_11vc VARCHAR(100) NOT NULL COMMENT 'Observaciones'
)
CHARACTER SET utf8,
COLLATE utf8_unicode_ci,
ENGINE=INNODB;
