# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

### Fixed

- アイキャッチ画像が荒い問題: アイキャッチブロックが出力する `post-thumbnail` サイズをテーマで未定義だったため、旧テーマ由来の150×150定義が残ったサイトで極小画像が引き伸ばされていた。`set_post_thumbnail_size( 1568, 9999 )`（等比・クロップ無し）を定義して解消。**既存サイトでは対象画像の再生成（wp media regenerate）が必要**

### Added

- 管理画面メニュー「外観 → パターン」: サイトエディターのパターン画面（site-editor.php?p=/pattern）への直リンク。ブロックテーマでは「エディター」の奥に隠れるパターン管理への動線（add_theme_page使用＝.org審査で許可されているAPI）

- screenshot.png（フロントページの実キャプチャ・.org規定の1200×900）
- readme.txt に Copyright セクション（GPL宣言＋サードパーティリソース非同梱の明記）

### Changed

- style.css / readme.txt のタグを.org許可リストに準拠（無効な `business` を削除、`accessibility-ready` はアクセシビリティ審査回避のため初回申請では外す、`style-variations` を追加）
- Theme URI をプレースホルダーから公式サイト https://shitate.weblley.co.jp/ に変更

## [0.1.0] - 2026-07-29

開発ベースライン（初回リリース前の到達点）。

### Added

- theme.json v3 ＋ templates / parts / patterns（hero・services・CTA ほか）
- デザイントークン `assets/css/tokens.css`（`--st-*`）: モジュラースケール文字サイズ・DADS準拠余白
- margin-top 縦リズム（blockGap 24px・見出し階層余白）、メディアクエリ不使用レイアウト
- スタイルバリエーション dark / cream / mist / mono（primary は全て #2952cc 固定）
- カスタマイザー「Typography Scale」（ratio / base / 丸め、ライブプレビュー対応）
- 余白ユーティリティ（utilities.css ＋ エディタツールバー「余白」）
- 日本語翻訳（languages/、JS翻訳JSONはハンドル名命名）
- 配布zipビルド `bin/build-zip.sh`
