# アプリケーション名
FashionablyLate お問い合わせフォーム

## 環境構築
Dockerビルド
1.
docker compose up -d --build

Laravel環境構築
1.docker compose exec php bush
2.composer install
3. .env.exampleから.envを作成し環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6.php artisan db:seed


## 使用技術(実行環境)
バックエンドLaravel10.0
フロント　Bladeテンプレート
DB MySQL8.0
認証　Laravel Fortify
言語　PHP8.0
## ER図
![S__58441744](https://github.com/user-attachments/assets/3bac8dcd-1692-48c2-b823-5cba0bed2e96)


## URL
開発環境：http://localhost/
phpMyAdmin:http://localhost:8080/
