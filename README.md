# 留言版

### [demo](https://message-board-v3.herokuapp.com/) 
帳號：test / 密碼：test

## 如何安裝

1. git clone https://github.com/hrh47/message-board-v3.git
2. cd message-board-v3
3. composer install
4. create a mysql database
5. mysql &lt;your-database-name&gt; -u &lt;your-username&gt; -p &lt; init.sql
6. cp .env.example .env
7. add your db name, username, password to .env
8. rm .env.example
9. move the directory to your apache root directory
10. write apache conf (see https://medium.com/@awonwon/laravel-5-4-on-apache-%E5%9C%A8-apache-%E6%9E%B6-laravel-%E7%B6%B2%E7%AB%99-9b7d1ad938af)

## 如何 deploy 上 heroku

1. git clone https://github.com/hrh47/message-board-v3.git
2. git checkout heroku-dev
3. heroku create
4. git push heroku heroku-dev:master
5. heroku addons:create heroku-postgresql:hobby-dev
6. heroku pg:psql &lt; init.sql
7. heroku open

## 學到的東西

- 如何用 PHP 寫出一個簡單的 MVC 框架
- 基本的 PDO 的寫法
- 如何寫出一個 query builder
- 如何將寫好的網站發布到 heroku
- 基礎 .htaccess 的寫法
- 如何利用 ajax 傳送表單資料
- 基礎 FormData 的使用
- application/x-www-form-urlencoded 和 multipart/form-data 的差別
- 基礎 moment.js 的使用
- 如何實做登入機制
- 如何實做 session 功能
- 如何實做 flash 功能
- 如何使用 bootstrap

## 當中遭遇到的坑

- 上傳到 heroku，將 mysql 改成 postgresql，讓我比較了 mysql 和 postgresql 資料型態的不同。
- heroku 上 postgresql 上 timestamp 的時區預設是 UTC+0，讓我學習到以後在設計時間欄位時，應該要有一致的時區。
