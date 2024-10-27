-- Создание базы данных (если она еще не существует)
CREATE DATABASE IF NOT EXISTS cutCodeShop;

-- Создание пользователя, если он не существует
CREATE USER IF NOT EXISTS 'IlyaK'@'%' IDENTIFIED BY 'password';

-- Предоставление всех привилегий для этого пользователя на базе данных
GRANT ALL PRIVILEGES ON cutCodeShop.* TO 'IlyaK'@'%';

-- Принудительное обновление привилегий
FLUSH PRIVILEGES;
