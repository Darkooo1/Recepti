drop database if exists jelasvijeta;
create database jelasvijeta default character set utf8;

use jelasvijeta;

create table registracija(
sifra       int not null primary key auto_increment,
username     varchar(50) not null,
email       varchar(50) not null,
password     char(60) not null,
ime         varchar(50) not null,
prezime     varchar(50) not null, 
sessionid   varchar(100)

);
insert into registracija values 
(null, 'Tomislav', 'zidarto@hotmail.com',
'$2y$10$1ObtPOr7unAMR6Zpo462Kuea4FkJSy3lLAb1eth86Xa7Kp/gcBhJq',
'Tomislav', 'Zidar',null);
insert into registracija values 
(null, 'AdminZidar', 'tozidar@gmail.com',
'$2y$10$b0In9IcFO63vOcA68CAlnemPx8u8lH1z6/1WFcYyFtfLoXiQ2r4DK',
'Admin', 'Zidar',null);

