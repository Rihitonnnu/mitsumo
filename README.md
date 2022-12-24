# mitsumo

## クローン
```
$ git clone git@github.com:Rihitonnnu/mitsumo.git
```

## プロジェクトセットアップ
### ビルドとコンテナ起動
```
$ docker compose up -d
```

### envファイルコピー
```
$ cp .env.example .env
```

### コンテナに入る
```
$ docker compose exec web bash
```

### Composerインストール
```
$ composer install
```

### 認証キー作成
```
$ php artisan key:generate
```

### マイグレーション、シーディング
```
$ php artisan migrate:fresh --seed
```

## Viteセットアップ
### npmインストール
```
$ npm install
```

### ビルド
```
#開発環境用
$ npm run dev

#本番環境用
$ npm run build
```


