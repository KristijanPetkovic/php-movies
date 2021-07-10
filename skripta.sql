CREATE TABLE user (
`id` int(11) NOT NULL auto_increment,
`username` varchar(20) NOT NULL default '',
`pass` varchar(20) NOT NULL default '',
`city` varchar(30) NOT NULL default '',
PRIMARY KEY (`id`) );

INSERT INTO user VALUES 
(1,'kris', '1234','Novi Sad'),
(2,'pera', '5678','Beograd'),
(3,'mika', '8527','Doboj');

select * from user;
drop table user;
---------------------------------------------------
CREATE TABLE `movies` (
`id` int(15) NOT NULL auto_increment,
`name` varchar(20) NOT NULL default '',
`cinema` varchar(20) NOT NULL default '',
`movieCity` varchar(20) NOT NULL default '',
`relaseYear` int(4) NOT NULL default '0',
PRIMARY KEY (`id`)) ;

INSERT INTO movies VALUES 
(1,'Ko to tamo peva', 'Narodno kino', 'Doboj','1980'),
(2,'Mi nismo andjeli', 'Kinoteka','Doboj','1992'),
(3,'Pad u raj','KinoFino', 'Doboj','2004'),
(4,'Terminator 1','Arena', 'Novi Sad','1984'),
(5,'Iron man 1','Cineplex', 'Novi Sad','2008'),
(6,'Mehanic','Filmici', 'Novi Sad','2011'),
(7,'Black Widow','KokiceKino', 'Beograd','2021'),
(8,'Wreck it Ralph','CineplexArena', 'Beograd','2012'),
(9,'Who am I','Kinče', 'Beograd','2011');

select * from movies;
drop table movies;
-----------------------------------------------
select movies.name from movies INNER JOIN user ON movies.movieCity=user.city where username='kris'; 