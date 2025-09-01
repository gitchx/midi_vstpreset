# 技術スタック
バックエンド: PHP Laravel
フロントエンド: Next.js
データベース: MySQL
MIDIファイル解析: Python(?)

複数人での作業だとそれぞれリポジトリを分けたほうがいいと思いますが、1人で開発するので1つのリポジトリにまとめました。

# VST-MIDI Web App 環境構築手順

このプロジェクトは Laravel + MySQL + Next.js で構成されています。  
Docker を使って簡単に環境を立ち上げられます。

---

## 前提
- Docker Desktop がインストールされていること
- Docker Compose が使えること
- macOS または Linux 環境

---

## 1. Docker ネットワーク作成
サービス間の通信に使うネットワークを作成します。

```bash
docker network create vst_midi_network
```
⚠️ このコマンドを実行しないと、Laravel と MySQL が通信できません。

## 2. MySQL コンテナ起動
```bash
docker-compose -f ./mysql/docker-compose.yml up -d
```
初回起動時は MySQL が初期化されます。

MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD は mysql-docker-compose.yml を参照。

3. Laravel コンテナ起動
```bash
docker-compose -f ./laravel/docker-compose.yml up -d
```
.env の DB_HOST は mysql に設定してください。

マイグレーションを実行してテーブル作成：

```bash
docker exec -it laravel php artisan migrate
```
## 4. Next.js コンテナ起動
```bash
docker-compose -f ./nextjs/docker-compose.yml up -d
```
Next.js フロントエンドが http://localhost:3000 で起動します。

API ベース URL は Laravel コンテナ名 laravel:8000 を使用。

## 5. 確認
ブラウザで http://localhost:3000/vsts や /midis にアクセス

MySQL データベースにテーブルが作成されているか確認

---
