# ローカルホストルート
http://localhost/

# MailHog
http://localhost:8025/

# phpMyAdmin
http://localhost:8080/

# バージョン情報
|name|version|
|---|---|
|web|php:7.3.9-apache|
|db|mysql:5.7.23|
|phpmyadmin|latest|
|node|10.16.3|
|mailhog|latest|
|laravel|^6.0(6.3.0)|
|vue|^2.6.11(2.6.11)|
|bootstrap|^4.4.1(4.4.1)|

# 初回実行コマンド

```
# docker起動
$ docker-compose up -d

# phpコンテナに入る
$ docker-compose exec php bash

# 設定ファイルコピー
$ cp -a .env.example .env

# composerインストール
$ composer install

# key 生成
$ php artisan key:generate

# マイグレーション（＋初期データ投入）
$ php artisan migrate --seed
or
$ php artisan migrate:fresh --seed

# phpコンテナから出る
$ exit

# nodeコンテナに入る
$ docker-compose run node bash

# エラー回避
$ npm install --save-dev cross-env

# インストール
$ npm install

# ビルド
$ npm run dev

# 常時監視
$ npm run watch