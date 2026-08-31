# shitate テーマ開発

無料配布のWordPressブロックテーマ。有料プラグイン「shitate pro blocks」とセット販売する商用フリーミアムの無料側。テーマは**設計専用**（ブロックは同梱しない — プラグイン側の責務）。

- 開発サイト: Local `shitate2607`（WP 7.0）。このフォルダで直接開発。
- 会社表記: weblley inc

## 命名規則
- `st` = shitate theme。PHP関数 `st_`、定数 `ST_`、ハンドル `st-`、CSS変数 `--st-*`、パターン `st/*`（カテゴリ `st`）
- 例外: テキストドメインは `shitate`（.org要件でフォルダ名と一致）
- プラグイン側は `sb`（sb/ブロック名・`--sb-*`）。テーマは `--sb-*` を定義しない

## デザインシステム（重要ルール）
- **トークンは `assets/css/tokens.css` の `--st-*` に集約**。theme.json の custom は使わない
- **色**: theme.json パレット（実値）が源。`--st-color-*` はプリセットのエイリアス（`var(--wp--preset--color--primary, #2952cc)` 形式）。ブランド色 #2952cc。スタイルバリエーション（styles/dark|cream|mist|mono.json）はパレット上書き方式で、**primary は全バリエーション #2952cc 固定**
- **文字**: モジュラースケール（typescale.com方式）。`--st-ratio`（既定1.25）×基準 `--st-text-m`（16px固定）→ `--st-text-xxs〜xxxl`。カスタマイザー「Typography Scale」で ratio/base/丸めを変更可（`st_ratio` / `st_text_m` / `st_round_scale`）。丸めONで流体clamp＋`round(…,2px)`偶数スナップ（ratio-min は `(1+ratio)/2` 自動派生）
- **余白**: DADS（デジタル庁）比率を `--st-space-xxs〜xxxl`（基準×0.25/0.5/0.75/1/1.5/2.5/4/6.5）。theme.json spacingSizes（slug 10〜70）も同変数参照
- **余白はタイプスケールに連動**（2026-08-28）: `--st-space-scale: calc(var(--st-ratio,1.25)/1.25)` を全 `--st-space-*` に乗算。デフォルト比率1.25ではDADS値と完全一致、比率変更で全体が比例伸縮（段間のDADS比率は不変）。丸めはしない
- **縦リズム**: margin-top方式。基本= blockGap(24px)、見出しは前を広く（h1/h2=64px, h3/h4=40px、tokens.css内の `:root :where(...)` ルール）。全コアブロックは `register_block_type_args` フィルタで**上マージンのみ**
- **メディアクエリ禁止**（clamp/grid/auto-fitで解決）。例外はデバイス出し分けのみ
- **!important 禁止**。例外は utilities.css（ユーティリティ層）のみ
- コンテンツ幅 1024px / 幅広 1260px（`--st-width-text` / `--st-width-max` 同期）

## ユーティリティ
- `assets/css/utilities.css`: `mt|mb|ml|mr|mx|my|m|pt|pb|pl|pr|px|py|p`-`0|xxs..xxxl` ＋ `mx-auto`
- エディタツールバー「余白」ドロップダウン: `assets/js/utilities-toolbar.js`（全ブロックにmt/mb/pt/pb/px＋mx-autoを付け外し）

## パターン
- `patterns/*.php`、Slug `st/*`、文言は `esc_html_e( '…', 'shitate' )`（日本語訳は languages/ で提供済み、サイト言語に自動追従）
- sb/* ブロックを使うパターンはテーマに置かない（プラグイン側で register_block_pattern）

## i18n（翻訳の更新手順）
翻訳辞書と抽出スクリプトはプラグイン側にある（横断管理）:
```bash
cd ../../plugins/shitate-pro-blocks && node bin/make-i18n.mjs
cd - && msgfmt languages/shitate-ja.po -o languages/ja.mo
```
JS翻訳（utilities-toolbar）は `languages/shitate-ja-st-utilities-toolbar.json`（ハンドル名命名）。

## GitHub自動アップデート（廃止済み・2026-08-28）
- .org提出準備のため v0.3.0 で削除（inc/github-updater.php・functions.phpのrequire・style.cssのUpdate URIヘッダ・build-zip.shの inc）。v0.3.0 が最後のGitHub経由配信で、以後の更新は.org公式ディレクトリから
- 実装履歴は v0.2.0（`update_themes_github.com` フィルタ方式・実機検証済み）。再導入する場合は git 履歴の inc/github-updater.php を参照。**.org掲載中はUpdate URI・外部通信とも禁止なので再導入しない**

## リリース（GitHub）
- リポジトリ: `weblley/shitate`（private）。アップデート情報は **CHANGELOG.md** に記録していく（普段は [Unreleased] に追記）
- リリース手順:
  1. CHANGELOG.md に「## [X.Y.Z] - YYYY-MM-DD」セクションを書く（[Unreleased] から移す）
  2. `bin/release.sh X.Y.Z` — バージョン一括更新（style.css / readme.txt）→ commit → tag vX.Y.Z → zipビルド → push → GitHub Release にzip添付・CHANGELOG該当節をノートに転記、まで自動
- readme.txt の `== Changelog ==` はユーザー向け（.org審査対象）。リリース時に同内容を手動で反映する
- 日常の変更は普通に commit / push してよい（Release はタグ時のみ作られる）

## その他
- カスタマイザーのスケール上書きは `st_scale_inline_css()` → フロントは st-tokens 直後にインライン、エディタは `block_editor_settings_all` で注入
- 配布zip: `bin/build-zip.sh` → dist/shitate.zip
- templates/*.html 内の直書き英文（フッター©・404等）は翻訳不可の既知事項
