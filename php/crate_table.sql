CREATE TABLE user_login (
  id int(11) NOT NULL AUTO_INCREMENT,
  Username varchar(255) NOT NULL,
  Password varchar(100) NOT NULL,
  Email varchar(255) NOT NULL,
  
  Status enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
);

INSERT INTO user_login (Username,Password, Email, Activation, Status) VALUES ('testlog','Password@123', 'balanovich123@gmail.com', '111', '1');

CREATE TABLE `validate_temp`(
	id int(11) NOT NULL AUTO_INCREMENT,
    Email varchar(255) NOT NULL,
    CheckSum varchar(1000) NOT NULL,
    Date varchar(255) NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `materials`(
	id int(11) NOT NULL AUTO_INCREMENT,
	title text NOT NULL,
	id_city int(11) NOT NULL,
	city varchar(255) NOT NULL,
	short_dicription text NOT NULL,
	text longtext NOT NULL,
	banner_photo longblob NOT NULL,
	data_create datetime NOT NULL,
	data_lastupdate datetime NULL,
	id_user int(10) NOT NULL,
	website varchar(255) NULL,
	phone varchar(255) NULL,
	email varchar(255) NULL,
	address varchar(255) NULL,
	lat FLOAT( 11, 7 ) NULL,
	lng FLOAT( 11, 7 ) NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_city) REFERENCES `city`(id),
	FOREIGN KEY (city) REFERENCES `city`(cityName)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;
INSERT INTO `materials` (title, id_city, city, short_dicription, text, banner_photo, data_create, data_lastupdate, id_user) VALUES ('ТЕСТ ТІТЛ коворкінг', '1', 'Київ',
'short dascription 1 This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content.',
 'Наша история
Когда мы открывали WeWork в 2010 г., мы поставили цель не просто построить красивые офисные помещения для совместного пользования, а создать сообщество единомышленников. В которое приходили бы индивидуальные "я" и становились частью "мы". В котором успех измерялся бы удовлетворенностью каждого резидента, а не сухими итоговыми цифрами. Сообщество — наш основной ориентир.
 
Создайте работу мечты
Основатели
Слева: Мигель Маккелви, Адам Нойманн, Ребекка Нойманн
Summer Camp 2015
Ежегодное выездное мероприятие для резидентов и сотрудников в горах Адирондак
Глобальный саммит 2016
Встреча всех сотрудников WeWork
Наши ценности
•	Воодушевленные
Мы делаем то, что любим, и становимся частью чего-то большего, чем мы сами.
•	Предприимчивые
Мы — предприниматели, лидеры и инициаторы. Мы пробуем новое, бросаем вызов условностям и не боимся ошибаться.
•	Искренние
Мы искренне верим в наш бренд, миссию и ценности. Мы не идеальны и не притворяемся такими. Мы работаем максимально честно и понятно.
•	Настойчивые
Мы никогда не останавливаемся. Мы решаем сложные задачи и делаем это хорошо. Будьте настойчивы и ломайте стены (если нужно, даже в прямом смысле). Мы вам разрешаем.
•	Благодарные
Мы благодарны друг другу, нашим резидентам, а также благодарны за возможность быть частью этого дела. Мы знаем цену успеха. Мы радуемся жизни.
•	Вместе
Мы занимаемся этим вместе. Это усилия всей команды. Мы всегда заботимся друг о друге. Мы сопереживаем друг другу, потому что все мы люди и знаем, что в одиночку нам не справиться.
Наша команда
Наша миссия не ограничивается содействием малому бизнесу и предпринимателям, которые называют наши офисы домом. Своей верой в команду мы помогаем создать работу мечты каждому резиденту. Мы быстро меняемся и подстегиваем друг друга, но также и заботимся друг о друге и бережем нашу культуру, поэтому работа в нашем сообществе воздается сторицей. Нам еще многое предстоит сделать, и для этого потребуется участие каждого резидента.
Присоединиться
 
Summer Camp 2015
', '../images/main-banner1.png', '2019-01-01 12:00:00', '2019-05-02 12:00:00', '1');

/*------------Фоткі додавати через SQL----------------------*/
UPDATE `materials` SET `banner_photo` = '../images/main-banner-small.png' WHERE id=2;

ALTER TABLE `materials` ADD website varchar(255) NULL;


CREATE TABLE `city`(
	id int(11) NOT NULL AUTO_INCREMENT,
	cityName varchar(255) NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO `city` (cityName) VALUES('Харків');
INSERT INTO `city` (cityName) VALUES('Kyiv');
INSERT INTO `city` (cityName) VALUES('Одесса');
INSERT INTO `city` (cityName) VALUES('Харьков');
INSERT INTO `city` (cityName) VALUES('Київ');

CREATE TABLE `rating`(
	id int(11) NOT NULL AUTO_INCREMENT,
	id_article int(11) NOT NULL,
	votes_count int(11) NULL,
	rating decimal(9,2) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_article) REFERENCES `materials`(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;
INSERT INTO `rating` (id_article, votes_count, rating) VALUES('1', '0', '0');


CREATE TABLE `article_photo`(
	id int(11) NOT NULL AUTO_INCREMENT,
	id_article int(11) NOT NULL,
	photo longblob NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_article) REFERENCES `materials`(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

INSERT INTO `article_photo` (id_article, photo) VALUES('1', '../images/articles-photos/article-1/article-1-1.jpg');


CREATE TABLE `articleview` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `article_id` int NOT NULL,
 `userip` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1


CREATE TABLE `totalview` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `article_id` int NOT NULL,
 `totalvisit` int NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

CREATE TABLE `price`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_article` int(11) NOT NULL,
	`time_measure` varchar(255) NOT NULL,
	`price_name` varchar(255) NOT NULL,
	`price` FLOAT(20,2) NOT NULL,
	`currency` varchar(255) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (id_article) REFERENCES `materials`(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

INSERT INTO `price` (`id`, `id_article`, `time_measure`, `price_name`, `price`, `currency`) VALUES ('', '1', '1 осб./1 год.', 'Загальний простір', '35', 'грн');


CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  FOREIGN KEY (id_article) REFERENCES `materials`(id),
  FOREIGN KEY (id_user) REFERENCES `user_login`(id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


<?php 
$some_name = session_name("some_name");
session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');

  session_start();
  if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
  } else{
    $_SESSION['id'] = "index";
    $id = $_SESSION['id'];
  }
 
  echo "<script type='text/javascript'>alert('$id q')</script>";
?>

<?php 
  session_start();
  if(!isset($_COOKIE['cookie_id_user']))
    setcookie('cookie_id_user', '0');
  
    $id = $_COOKIE['cookie_id_user'];
?>