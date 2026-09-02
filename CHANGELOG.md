# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

### Fixed

- 固定ページ・投稿テンプレートで「全幅」ブロックが画面端まで広がらなかった問題を修正（page.html / single.html の `main` グループと `post-content` に `align:full` を付与。WP標準テーマと同じ構造にし、入れ子の constrained レイアウトによる全幅の打ち消しを解消。通常ブロックはコンテンツ幅のまま）

### Changed

- パターンとテンプレートを、開発サイトで実際に組んだ内容に合わせて全面的に作り直し。テンプレート（archive / index / search / single / page）とヘッダー・フッターはサイトエディターの現行版をそのまま移植し、フロントページは実際の構成（hero → concept → product → pattern-showcase → cta → faq）に更新
- 配布用の調整: テンプレートから `theme` 属性とナビゲーションメニューのID参照を除去、角丸の直書き（8px）をトークン参照に、投稿日ラベルの日本語直書きを英語ソース化、パレット外の灰色（#828282）を neutral に置換
- パターンの文言を英語ソース＋日本語翻訳に統一（新規61文字列を辞書に追加、テーマ翻訳は117/117で100%維持）。画像はブロックを残したまま空にし、ユーザーが差し替える前提に
- 有料プラグイン依存（sb/if）とローカルURL・メディアIDを全パターンから除去。プラグイン紹介・デモサイト固有の文言は、同じレイアウトのまま汎用的なデモ文言に置き換え

### Added

- `patterns/404-content.php`（st/404-content）: 404本文をパターンに分離し、テンプレートからは参照のみに。これまで翻訳できなかった404の文言が翻訳対象になり、ホームへのリンクも `home_url()` でサブディレクトリ設置に対応

## [0.3.0] - 2026-09-01

WordPress.org 提出準備リリース（GitHub経由の自動配信はこの版で終了）。

### Fixed

- `ST_VERSION`（CSS/JSのキャッシュバスター）が 0.1.0 のまま取り残されていた問題: `bin/release.sh` が style.css と readme.txt しか更新していなかったため、リリースのたびにズレが広がりアセットが古いキャッシュのまま配信されうる状態だった。release.sh に functions.php の書き換え（＋書き換え失敗時の中断）を追加し、値を style.css と同じバージョンに揃えた
- readme.txt の Description が実装と食い違っていた問題: 「Brand-derived colors via color-mix()」（color-mix はコード内に不在。実際はパレットのエイリアス方式）、「DADS-based spacing」（現在は純モジュラー15段）。現行の設計に合わせて書き直し、流体余白・スタイルバリエーションの記述を追加。あわせて 0.2.0 / 0.3.0 の Changelog 節を追記（.org 審査対象のため）
- theme.json の `settings.spacing.defaultSpacingSizes` が重複定義されていた（同値のため実害なし）。1つに整理
- style.css の Description の製品名表記「shitate Pro Blocks」を、命名規則どおりの全小文字「shitate pro blocks」に修正

### Added

- `docs/manual.html`: WordPress ブロックマークアップ形式のテーマ公式マニュアル（そのままブロックエディターに貼り付け可能）。配布zipには含めない

### Added

- 余白を純モジュラースケール15段に全面刷新: `--st-space-1〜15`（1段＝タイプスケール比率、基準は7＝本文サイズ）。font-sizeと完全に同じ規則で、カスタマイザーの比率・基準サイズに全段が追従する。既定比率1.25ではDADS近似値（4.2〜95px）。旧トークン名（xxs〜xxxl）は近似段へのエイリアスとして維持。エディタの余白ピッカーには代表8段（XXS〜XXXL）を公開し、スラッグ（10〜70）据え置きで後方互換

### Fixed

- ブロックの余白（パディング/マージン）設定が「XS・M・L」ではなく数字表記になっていた問題: 余白のモジュラー化（15段）の際にプリセット名を "1"〜"15" にしてしまったのが原因。ピッカーに公開する段を8つ（ラダーの1/4/6/7/9/11/13/15）に絞り、名前を従来の XXS〜XXXL に戻した。スラッグ（10/20/25/30/40/50/60/70）は不変のため保存済みコンテンツに影響なし。未使用だった中間スラッグ（14/18/23/35/45/55/65）は削除
- あわせて、コア既定の余白プリセット7段（2X-Small・小・中・大…）がピッカーに混在していた問題も解消（`defaultSpacingSizes: false` と `spacingScale.steps: 0` を明示）。テーマのスケール外の値が選べてしまう状態だった

- 枠線色を設定したブロックの文字色まで薄い境界色に変わる問題: パレットのスラッグ `border` が、WPコア生成の文字色クラス `.has-border-color` を生んで**枠線用の構造クラスと同名衝突**していた。スラッグを `line` に改名（表示名「Border」は不変、theme.json＋全スタイルバリエーション＋tokens.css＋パターン/フッターの参照とクラスを一括更新）。従来この衝突経由で偶然色が付いていた枠線には `has-line-border-color` を明示付与

### Removed

- GitHub経由の自動アップデート一式を削除（inc/github-updater.php・functions.phpのrequire・style.cssのUpdate URIヘッダ・build-zip.shの inc）。.org審査要件（Update URI不可・外部通信不可）への対応。以後の更新はWordPress.org公式ディレクトリから配信

### Added

- 余白の上位段（8〜15）を流体化: 各段が「派生モバイル比率（(1+比率)÷2）〜選択比率」の間をclampで伸縮。狭い画面ではリズム全体が自動で締まり、等比スケールの「モバイルで余白過大」問題をメディアクエリなしで解消（例: 比率1.333・375px幅で step15 159.5→69.9px）
- theme.json に `settings.viewport`（mobile 768px / tablet 1024px、WP 7.1新機能）を宣言: エディタのレスポンシブスタイルの境界が、プラグインのデバイス出し分け（[br_sp]・details・sb/if）と同じ768/1024pxに揃う
- 角丸トークン `--st-radius-s/m/l`（0.375/0.625/0.75rem）を新設し、散在していた直書き（6/8/10/12px）を3語彙に集約。パターン・テンプレートの border-radius もvar()参照に置換

### Changed

- コンテンツ幅・幅広をrem化（1024px→64rem / 1260px→78.75rem）: ブラウザの文字サイズ設定・ズームに行長が追従
- 文字の丸め/流体モード（Typography Scale の「Apply rounding」）を既定ONに変更: インストール直後から見出しがモバイルで自動的に控えめになる
- 見出し前の余白を「ラダーの固定段」から「ローカルの基本リズム連動」に変更: h1/h2 = blockGap×1.75、h3/h4 = ×1.25（`--wp--style--block-gap` 参照）。モジュラー化で見出し前だけ過大になっていた問題の解消（例: 比率1.333で h3前 50.5→35.5px）。gapが狭いカード内では見出し前も自動で狭まり、ユーティリティ等の明示指定は従来どおり優先
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
