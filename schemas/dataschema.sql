CREATE DATABASE librarydb;

CREATE TABLE images (
  image_id INT(11) UNSIGNED AUTO_INCREMENT,
  image_rute char(20) NOT NULL,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_time_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(image_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE categories (
  categorie_id INT UNSIGNED AUTO_INCREMENT,
  categorie_name char(200) NOT NULL DEFAULT "",
  url char(200) NOT NULL DEFAULT "",
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_time_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(categorie_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE subcategories (
  subcategorie_id INT(11) UNSIGNED AUTO_INCREMENT,
  categorie_id INT(11) UNSIGNED NOT NULL,
  subcategorie_name char(200) NOT NULL DEFAULT "",
  url char(200) NOT NULL DEFAULT "",
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_time_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(subcategorie_id),
  CONSTRAINT fk_subcategories_categories FOREIGN KEY (categorie_id) REFERENCES categories(categorie_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE articles (
  article_id INT(11) UNSIGNED AUTO_INCREMENT,
  image_id INT(11) UNSIGNED NOT NULL,
  user_id INT(11) UNSIGNED NOT NULL,
  categorie_id INT(11) UNSIGNED NOT NULL,
  subcategorie_id INT(11) UNSIGNED NOT NULL,
  title char(20) NOT NULL DEFAULT "",
  description char(70) NOT NULL DEFAULT "",
  content TEXT NOT NULL DEFAULT "",
  state INT NOT NULL DEFAULT 0,
  views INT NOT NULL DEFAULT 0,
  shared INT NOT NULL DEFAULT 0,
  url char(200) NOT NULL DEFAULT "",
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_time_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(article_id),
  CONSTRAINT fk_articles_images FOREIGN KEY (image_id) REFERENCES images(image_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_articles_categories FOREIGN KEY (categorie_id) REFERENCES categories(categorie_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_articles_subcategories FOREIGN KEY (subcategorie_id) REFERENCES subcategories(subcategorie_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE users (
  user_id INT(11) UNSIGNED AUTO_INCREMENT,
  username TEXT NOT NULL,
  password TEXT NOT NULL,
  email TEXT NOT NULL,
  mode TEXT NOT NULL,
  photo TEXT NOT NULL,
  checked int(11) NOT NULL,
  encryptedEmail TEXT COLLATE utf8_spanish_ci NOT NULL,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_time_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE favorites (
  favorite_id INT(11) UNSIGNED AUTO_INCREMENT,
  user_id INT(11) UNSIGNED NOT NULL,
  article_id INT(11) UNSIGNED NOT NULL,,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(subcategorie_id),
  CONSTRAINT fk_favorites_users FOREIGN KEY (user_id) REFERENCES users(user_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_favorites_articles FOREIGN KEY (article_id) REFERENCES articles(article_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE comments (
  comment_id INT(11) UNSIGNED AUTO_INCREMENT,
  user_id INT(11) UNSIGNED NOT NULL,
  article_id INT(11) UNSIGNED NOT NULL,
  comment TEXT NOT NULL,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(comment_id),
  CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(user_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_comments_articles FOREIGN KEY (article_id) REFERENCES articles(article_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE admin (
  admin_id INT(11) UNSIGNED AUTO_INCREMENT,
  first_name TEXT NOT NULL,
  last_name TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  roll INT NOT NULL,
  photo TEXT NOT NULL,
  encryptedEmail TEXT COLLATE utf8_spanish_ci NOT NULL,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_access timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
