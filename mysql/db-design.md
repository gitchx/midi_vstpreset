# VST-MIDI Webアプリ データベース設計

このドキュメントは、VST音源・MIDIデータ・VSTプリセットの管理用データベース設計です。

---

## 1. vsts（VST音源管理）

| カラム名   | 型        | 説明               |
|------------|-----------|------------------|
| id         | INT PK    | プライマリキー     |
| name       | VARCHAR   | VST音源名         |
| vendor     | VARCHAR   | 開発元             |
| version    | VARCHAR   | バージョン         |
| created_at | TIMESTAMP | 作成日時           |
| updated_at | TIMESTAMP | 更新日時           |

---

## 2. midis（MIDIデータ管理）

| カラム名        | 型        | 説明                            |
|----------------|-----------|--------------------------------|
| id             | INT PK    | プライマリキー                  |
| vst_preset_id  | INT FK    | 対応 VST音源 ID → vst_presets.id      |
| file_name      | VARCHAR   | MIDIファイル名                  |
| file_path      | VARCHAR   | 保存場所                         |
| created_at     | TIMESTAMP | 作成日時                         |
| updated_at     | TIMESTAMP | 更新日時                         |

> **vst_presets_id** は vsts.id を参照する外部キー

---

## 3. vst_presets（VSTプリセット管理）

| カラム名      | 型        | 説明                          |
|---------------|-----------|-------------------------------|
| id            | INT PK    | プライマリキー                |
| vst_id        | INT FK    | 対応 VST音源 ID → vsts.id    |
| preset_name   | VARCHAR   | プリセット名                  |
| settings_json | JSON      | パラメータ設定（可変長）      |
| created_at    | TIMESTAMP | 作成日時                       |
| updated_at    | TIMESTAMP | 更新日時                       |

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