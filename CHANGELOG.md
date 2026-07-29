# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

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
