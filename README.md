# Rese
<h1>飲食店予約サービズ</h1>
<img src="Rese.png">
<h1>概要</h1>
<p>ある企業グループ会社の飲食店予約サービス</p>
<h1>githubリンク</h1>
<p>https://github.com/NaoyaKatsumata/Rese_coachtech</p>
<h1>機能</h1>
<ul>
    <li>会員登録</li>
    <li>ログイン</li>
    <li>ログアウト</li>
    <li>ユーザ情報取得</li>
    <li>ユーザ飲食店お気に入り一覧取得</li>
    <li>飲食店一覧取得</li>
    <li>飲食店詳細取得</li>
    <li>飲食店お気に入り追加</li>
    <li>飲食店お気に入り削除</li>
    <li>飲食店予約情報追加</li>
    <li>飲食店予約情報削除</li>
    <li>エリアで検索する</li>
    <li>ジャンルで検索する</li>
    <li>店名で検索する</li>
    <li>予約変更機能</li>
    <li>評価機能</li>
    <li>店舗情報編集</li>
    <li>店舗の追加</li>
    <li>メール送信機能</li>
    <li>リマインダー機能</li>
</ul>
<h1>使用技術</h1>
<ul>
    <li>laravel:9.52.16</li>
    <li>php:8.1.29</li>
    <li>Composer:2.7.7</li>
    <li>DB:MySQL</li>
</ul>
<h1>テーブル設計</h1>
<p>areasテーブル</p>
<img src="areas.png">
<p>authoritiesテーブル</p>
<img src="authorities.png">
<p>categoriesテーブル</p>
<img src="categories.png">
<p>favoritesテーブル</p>
<img src="favorites.png">
<p>ownersテーブル</p>
<img src="owners.png">
<p>reservationsテーブル</p>
<img src="reservations.png">
<p>reviewsテーブル</p>
<img src="reviews.png">
<p>shopsテーブル</p>
<img src="shops.png">
<p>usersテーブル</p>
<img src="users.png">
<h1>ER図</h1>
<img src="Rese_ER.png">
<h1>環境構築</h1>
<ol>
    <li>任意のフォルダに移動</li>
    <li>
        フォルダをローカルにclone<br>
        git@github.com:NaoyaKatsumata/Rese_coachtech.git
    </li>
    <li>
        docker-composeをビルド<br>
        docker-compose up -d --build
    </li>
    <li>
        composerのインストール<br>
        docker-compose exec php bash<br>
        composer install
    </li>
    <li>
        .envファイルの作成<br>
        cp .env.example .env<br>
        .envファイルの書き換え<br>
        DB_CONNECTION=mysql<br>
        DB_HOST=mysql<br>
        DB_PORT=3306<br>
        DB_DATABASE=laravel_db<br>
        DB_USERNAME=laravel_user<br>
        DB_PASSWORD=laravel_pass<br>
    </li>
    <li>
        dockerスタート
    </li>
    <li>
        phpコンテナにログイン<br>
        docker-compose exec php bash
    </li>
    <li>
        ダミーデータの投入<br>
        php artisan db:seed
    </li>
    <li>
        phpMyAdmin(localhost:8080)へアクセスし、管理者のメールアドレスを任意のものに変更<br>
        usersテーブル -> id 1 administratorの"email"を個人のメールアドレスに変更
    </li>
    <li>
        adminアカウントで一般ユーザとオーナーアカウントを作成<br>
        もしくは、usersテーブル -> id 2 ownerの"email"を個人のメールアドレスに変更<br>
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;                    id 3 userの"email"を個人のメールアドレスに変更<br>
        (管理者はユーザの作成時に権限を付与、店舗の追加・編集、予約者へのお知らせメールの送信が可能<br>
        &nbsp;オーナーは自分の店舗の編集のみ可能、予約者へのお知らせメールの送信が可能<br>
        &nbsp;一般ユーザは店舗の予約、予約の変更・削除、店舗の評価が可能)
    </li>
</ol>