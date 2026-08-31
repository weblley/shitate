# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

## [0.3.0] - 2026-08-28

WordPress.org 提出準備リリース（GitHub経由の自動配信はこの版で終了）。

### Added

- 余白を純モジュラースケール15段に全面刷新: `--st-space-1〜15`（1段＝タイプスケール比率、基準は7＝本文サイズ）。font-sizeと完全に同じ規則で、カスタマイザーの比率・基準サイズに全段が追従する。既定比率1.25ではDADS近似値（4.2〜95px）。旧トークン名（xxs〜xxxl）は近似段へのエイリアスとして維持し、スペーシングピッカーは15段（既存スラッグ10〜70は据え置き＋中間スラッグ追加）で後方互換

### Fixed

- 枠線色を設定したブロックの文字色まで薄い境界色に変わる問題: パレットのスラッグ `border` が、WPコア生成の文字色クラス `.has-border-color` を生んで**枠線用の構造クラスと同名衝突**していた。スラッグを `line` に改名（表示名「Border」は不変、theme.json＋全スタイルバリエーション＋tokens.css＋パターン/フッターの参照とクラスを一括更新）。従来この衝突経由で偶然色が付いていた枠線には `has-line-border-color` を明示付与

### Removed

- GitHub経由の自動アップデート一式を削除（inc/github-updater.php・functions.phpのrequire・style.cssのUpdate URIヘッダ・build-zip.shの inc）。.org審査要件（Update URI不可・外部通信不可）への対応。以後の更新はWordPress.org公式ディレクトリから配信

### Changed

- Tested up to を 7.1 に更新（style.css / readme.txt。7.1は2026-08-19正式リリース、beta3でスモークテスト済み）

## [0.2.0] - 2026-07-30

### Added

- GitHub経由の自動アップデート（.org掲載までの暫定配信）: style.css の `Update URI` ＋ `inc/github-updater.php`。GitHub Releases の最新版を6時間キャッシュで確認し、「外観 → テーマ」に通常の更新通知を表示。**.org提出前に削除必須**（inc/github-updater.php・functions.phpのrequire・Update URIヘッダ・build-zip.shの inc）

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
