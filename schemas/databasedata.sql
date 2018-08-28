INSERT INTO `categories`(`categorie_id`, `categorie_name`, `url`, `registration_date`, `last_time_update`) VALUES
(0,"Programación","programacion",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,"Matemáticas","matematicas",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,"Backend","backend",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,"Frontend","frontend",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

INSERT INTO `subcategories`(`subcategorie_id`, `categorie_id`, `subcategorie_name`, `url`, `registration_date`, `last_time_update`) VALUES
(0,1,"C++","programacion-c-mas-mas",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,1,"C#","programacion-c-sharp",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,1,"Java","programacion-java",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,1,"JavaScript","programacion-java-script",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,1,"PHP","programacion-php",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),

(0,2,"Calculo Integral","calculo-integral",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,2,"Calculo Diferencial","calculo-diferencial",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,2,"Geometria","geometria",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,2,"Geometria Analitica","geometria-analitica",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,2,"Trigonometria","trigonometria",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),

(0,3,"VPS","virtual-private-server",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,3,"Heroku","heroku",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,3,"Digital Ocean","digital-ocean",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),

(0,4,"HTML","html",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,4,"CSS","css",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,4,"Progresive Web App","progresive-web-app",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

INSERT INTO `images`(`image_id`, `image_rute`, `registration_date`, `last_time_update`) VALUES
(0,"images/img-1.jpg",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
(0,"images/Portada.jpg",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

SELECT  categories.categorie_name, subcategories.subcategorie_name
FROM subcategories
INNER JOIN categories ON subcategories.categorie_id = categories.categorie_id


SELECT images.image_rute As Imagen, categories.categorie_name As Categoria, subcategories.subcategorie_name As Subcategoria FROM `articles`
INNER JOIN images ON articles.image_id = images.image_id
INNER JOIN categories ON articles.categorie_id = categories.categorie_id
INNER JOIN subcategories ON articles.subcategorie_id = subcategories.subcategorie_id
WHERE views > 5

SELECT images.image_rute As Imagen, categories.categorie_name As Categoria, subcategories.subcategorie_name As Subcategoria, articles.title, articles.description, articles.registration_date FROM `articles`
INNER JOIN images ON articles.image_id = images.image_id
INNER JOIN categories ON articles.categorie_id = categories.categorie_id
INNER JOIN subcategories ON articles.subcategorie_id = subcategories.subcategorie_id
ORDER BY(articles.article_id) DESC LIMIT 4

INSERT INTO `articles`(`article_id`, `image_id`, `user_id`, `categorie_id`, `subcategorie_id`, `title`, `description`, `content`, `state`, `views`, `shared`, `url`, `registration_date`, `last_time_update`) VALUES
  (0,1,2,1,1,"Este es el titulo de mi tercer post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-tercer-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,1,1,"Este es el titulo de mi cuarto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-cuarto-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,1,2,"Este es el titulo de mi quinto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-quinto-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,1,2,"Este es el titulo de mi sexto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-sexto-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),

  (0,1,2,1,3,"Este es el titulo de mi tercer post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-t-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,1,3,"Este es el titulo de mi cuarto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-c-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,1,4,"Este es el titulo de mi quinto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-q-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,1,4,"Este es el titulo de mi sexto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-s-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,1,5,"Este es el titulo de mi tercer post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-te-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,1,5,"Este es el titulo de mi cuarto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-cu-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,1,5,"Este es el titulo de mi quinto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-qu-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,2,1,"Este es el titulo de mi sexto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-se-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,2,1,"Este es el titulo de mi tercer post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-ter-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,2,1,"Este es el titulo de mi cuarto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-cua-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,1,2,2,2,"Este es el titulo de mi quinto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-qui-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (0,2,2,2,2,"Este es el titulo de mi sexto post","description","JSON",0,0,0,"este-es-el-titulo-de-mi-sex-post",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
