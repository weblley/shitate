# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

### Added

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
