Pour faire marcher le code sur votre machine il faut :

Telecharger XAMPP : https://www.apachefriends.org/fr/index.html

Lancer Apache et mySQL

Aller sur phpMyAdmin (http://localhost:8080/phpmyadmin)

Créer une nouvelle base de donnée et l'appeler : desc_bdd.

Créer une nouvelle table nommée users et ensuite aller dans la section SQL et entrer le code ci-dessous :

CREATE TABLE `users` (

  `id` int(11) NOT NULL,

  `username` varchar(50) NOT NULL,

  `email` varchar(100) NOT NULL,

  `password` varchar(255) NOT NULL,

  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),

  `profile_picture` varchar(255) DEFAULT 'default.jpg',

  `points` int(11) NOT NULL DEFAULT 0

);


En créer une autre nommée posts et entrer le code ci-dessous : 

CREATE TABLE `posts` (

  `id` int(11) NOT NULL,

  `user_id` int(11) NOT NULL,

  `type` enum('demande','offre') NOT NULL,

  `category` varchar(100) NOT NULL,

  `details` text NOT NULL,

  `disponibilites` varchar(255) DEFAULT NULL,

  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),

  `points_requis` int(11) NOT NULL DEFAULT 0

);

En créer une autre nommée transactions et entrer le code ci-dessous : 

CREATE TABLE `transactions` (

  `id` int(11) NOT NULL,

  `user_id` int(11) NOT NULL,

  `post_id` int(11) NOT NULL,

  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  
) 

Rendez-vous sur http://localhost:8080/desc/index.php.
