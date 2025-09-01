# VST-MIDI Webアプリ データベース設計

このドキュメントは、VST音源・MIDIデータ・VSTプリセットの管理用データベース設計です。

---

## 1. vsts（VST音源管理）

| カラム名        | 型         | 説明      |
| ----------- | --------- | ------- |
| id          | INT PK    | プライマリキー |
| name        | VARCHAR   | VST音源名  |
| vendor      | VARCHAR   | 開発元     |
| version     | VARCHAR   | バージョン   |
| description | TEXT      | 説明      |
| created\_at | TIMESTAMP | 作成日時    |
| updated\_at | TIMESTAMP | 更新日時    |


---

## 2. midis（MIDIデータ管理）

| カラム名        | 型         | 説明                         |
| ----------- | --------- | -------------------------- |
| id          | INT PK    | プライマリキー                    |
| name        | VARCHAR   | プリセット名                     |
| vst\_name   | VARCHAR   | VST音源名（文字列保存）              |
| category    | VARCHAR   | カテゴリ（Lead, Pad など）         |
| author      | VARCHAR   | 作成者名                       |
| description | TEXT      | 説明                         |
| file\_path  | VARCHAR   | プリセットファイルのパス               |
| format      | VARCHAR   | プリセット形式（fxp, vstpreset など） |
| tags        | JSON      | タグ                         |
| favorite    | BOOLEAN   | お気に入りフラグ                   |
| created\_at | TIMESTAMP | 作成日時                       |
| updated\_at | TIMESTAMP | 更新日時                       |

> **vst_presets_id** は vsts.id を参照する外部キー

---

## 3. vst_presets（VSTプリセット管理）

| カラム名                         | 型         | 説明                      |
| ---------------------------- | --------- | ----------------------- |
| id                           | INT PK    | プライマリキー                 |
| title                        | VARCHAR   | MIDIタイトル                |
| composer                     | VARCHAR   | 作曲者名                    |
| genre                        | VARCHAR   | ジャンル                    |
| bpm                          | INT       | 推奨テンポ                   |
| key\_signature               | VARCHAR   | 調性（例: C Major, A Minor） |
| time\_signature\_numerator   | INT       | 拍子（分子）                  |
| time\_signature\_denominator | INT       | 拍子（分母）                  |
| length\_seconds              | INT       | 再生時間（秒）                 |
| tracks\_count                | INT       | トラック数                   |
| file\_path                   | VARCHAR   | MIDIファイルのパス             |
| tags                         | JSON      | タグ                      |
| favorite                     | BOOLEAN   | お気に入りフラグ                |
| description                  | TEXT      | 説明・メモ                   |
| created\_at                  | TIMESTAMP | 作成日時                    |
| updated\_at                  | TIMESTAMP | 更新日時                    |


> JSON カラムでプリセットのパラメータをまとめて保存可能

---

## 4. ER図（簡易イメージ）
```
vsts
├── id
├── name
└── ...

midis
├── id
├── vst_preset_id → vst_presets.id
└── ...

vst_presets
├── id
├── vst_id → vsts.id
└── ...
```

- **vsts** が親テーブル  
- **vst_presets** が子テーブルとして関連
- **midis** は **vst_presets** と関連

---

### ポイント

- VST音源テーブルを基準に、MIDIデータ・プリセットを紐づける  
- JSON 型を使えばプリセットの可変設定を管理できるかも