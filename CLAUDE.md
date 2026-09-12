# shitate テーマ開発

無料配布のWordPressブロックテーマ。有料プラグイン「shitate pro blocks」とセット販売する商用フリーミアムの無料側。テーマは**設計専用**（ブロックは同梱しない — プラグイン側の責務）。

- 開発サイト: Local `shitate2607`（WP 7.0）。このフォルダで直接開発。
- 会社表記: weblley inc

## 命名規則
- **公開識別子の接頭辞は `shitate`**（2026-09-06、.org審査指摘: 接頭辞は4文字以上）: PHP関数・オプション(theme_mod)・カスタマイザーID `shitate_`、定数 `SHITATE_`、スクリプト/スタイルハンドル `shitate-`、パターン `shitate/*`（カテゴリ `shitate`）。**CSS変数だけは `--st-*` を維持**（CSSカスタムプロパティは接頭辞規則の対象外。プラグインの `var(--st-*, …)` フォールバックと保存済みコンテンツの互換のため。改名しない）。旧 `st_*` の theme_mod は `shitate_migrate_theme_mods()` で自動移行
- 例外: テキストドメインは `shitate`（.org要件でフォルダ名と一致）
- プラグイン側は `sb`（sb/ブロック名・`--sb-*`）。テーマは `--sb-*` を定義しない

## デザインシステム（重要ルール）
- **トークンは `assets/css/tokens.css` の `--st-*` に集約**。theme.json の custom は使わない
- **色**: theme.json パレット（実値）が源。`--st-color-*` はプリセットのエイリアス（`var(--wp--preset--color--primary, #2952cc)` 形式）。ブランド色 #2952cc。スタイルバリエーション（styles/dark|cream|mist|mono.json）はパレット上書き方式で、**primary は全バリエーション #2952cc 固定**
- **派生色は自動追従**（2026-09-03、`inc/colors.php`）: パレットは源4色（base / contrast / primary / accent）＋派生5色（base-2 / line / contrast-2 / neutral / primary-hover）。`wp_theme_json_data_user` フィルタで、**親色がサイトエディターで変更され、かつ派生色が未編集（theme.json/各バリエーションの既定値のまま）**のときだけ派生色を読み取り時に再計算する（保存データは書き換えない＝可逆、手動設定した派生色は常に優先）。式: base-2=mix(base 95%, primary) / line=mix(base 87%, primary) / contrast-2=mix(contrast 75%, base) / neutral=mix(mix(contrast 71%, primary) 70%, base) / primary-hover=primary+黒22%（baseが暗い場合は+白25%）。**theme.json に color-mix() を書く方式は不可**（KSESが色関数を削除し、ユーザーがパレットを1色でも保存すると派生項目ごと消える）。エディタ編集中のライブプレビューには反映されず、保存後の再読込で一致する
- **文字**: モジュラースケール（typescale.com方式）。`--st-ratio`（既定1.25）×基準 `--st-text-m`（16px固定）→ `--st-text-l〜xxxl`。m未満（s/xs/xxs）は既定では比率で割る。**カスタマイザー `shitate_fixed_small_text`（「小さな文字の数値指定」、既定OFF）をONにすると 0.95rem / 0.8rem / 0.75rem に固定**（2026-09-10。0.4.1で一度固定値にしたが選択制に戻した。ONのときは丸めモードの下位段処理をスキップ）。カスタマイザー「Typography Scale」で ratio/base/丸めを変更可（`st_ratio` / `st_text_m` / `st_round_scale`）。丸めONで流体clamp＋`round(…,2px)`偶数スナップ（ratio-min は `(1+ratio)/2` 自動派生）
- **比率は流動（2026-09-12、ユーザー決定）**: `--st-r` = `--st-ratio-fluid` = `--st-ratio-min`（375px、カスタマイザー `shitate_ratio_mobile`＝既定 auto なら (1+r)/2）→ r（1260px）を `clamp(0, (tan(atan2(100vw,1px)) - 375) / 885, 1)` で線形補間。**文字・余白の全段は必ず `--st-r` から計算**（段ごとの clamp/vw は禁止＝中間幅で等比が崩れる）。`@supports` で非対応ブラウザは固定 r。丸めモードは偶数px丸めのみ。これは feature query であり「メディアクエリ禁止」の対象外
- **余白＝タイプスケールと同名の8段**（2026-09-06に数字トークンを廃止）: `--st-space-xxs/xs/s/m/l/xl/xxl/xxxl` のみ。m=`--st-text-m`、上は2乗刻み（l=m·r²、xl=m·r⁴、xxl=m·r⁶、xxxl=m·r⁸）、下は s=m/r・xs=m/r³・xxs=m/r⁶。サイズは旧15段時代の割り当て（段1/4/6/7/9/11/13/15）と同一＝既定1.25で≈4/8/13/16/25/39/61/95px。**`--st-space-1〜15` は存在しない・復活させない**（中間サイズが必要なら `calc(var(--st-space-m) * var(--st-ratio))` のように比率を掛ける）。小比率で圧縮・大比率で拡大するのは仕様
- **l〜xxxl は流体**（clampで「派生モバイル比率 `(1+r)/2`（=`--st-ratio-min`）〜選択比率」の間を1/2/3/4vwで伸縮。狭い画面ではリズム全体が自動で締まる＝MQ不使用のレスポンシブ余白）。xxs〜s は差が知覚不能のため静的
- **エディタの余白ピッカーは同じ8段**（slug 10/20/25/30/40/50/60/70・名前 XXS〜XXXL・size は `var(--st-space-*)`）。**`defaultSpacingSizes: false` ＋ `spacingScale.steps: 0` 必須**（前者を省くとコア既定の7段「2X-Small/小/中/大…」がピッカーに混在、後者を省くとコアがテーマ側にも自動生成段を作る）
- **縦リズム**: margin-top方式。基本= blockGap。見出しは前を広く＝**ローカルgap連動**（2026-09-01変更: h1/h2 = `--wp--style--block-gap`×1.75、h3/h4 = ×1.25。tokens.css内の `:root :where(...)` ルール。狭いgapの文脈では見出し前も自動で狭まる。ユーティリティ等の明示指定が優先）。全コアブロックは `register_block_type_args` フィルタで**上マージンのみ**
- **フォントは言語切替**（2026-09-10）: theme.json の fontFamily は `var(--st-font-sans/serif/mono)` 参照。tokens.css の既定はシステムフォントのみで **CJK フォントを含めない**（中国語・韓国語で日本語字形にならないよう、漢字のフォールバックはブラウザに任せる）。日本語サイト（`determine_locale()` が ja*）だけ `shitate_font_inline_css()` が Hiragino Sans → Hiragino Kaku Gothic ProN → Yu Gothic Medium → Yu Gothic → Meiryo の順で上書き（フロント・エディタ両方に注入）。Webフォント同梱は禁止
- **翻訳ロケール**: 日本語はプラグイン側 make-i18n.mjs の JA 辞書、**欧州6言語（de_DE / fr_FR / es_ES / it_IT / nl_NL / pt_PT）は `bin/locales.mjs`**。文字列を追加したら両方に訳を足して `node bin/make-i18n.mjs` を実行（欧州分は .mo と JSON も自動生成、日本語の .mo だけ msgfmt を手動実行）。MISSING/UNUSED が出たら辞書を直す
- **画像読み込みヒント（2026-09-12、`inc/performance.php`）**: コアは `template` コンテキストの画像に lazy/fetchpriority を付けない（front-page の内容がテンプレートにあると全画像 eager になる）ため、`wp_get_loading_optimization_attributes` フィルターで補完。先頭3枚（`wp_omit_loading_attr_threshold()`）まで eager・最初の大きな画像（≥50000px²）に high、以降の寸法付き画像は lazy。寸法なし・属性済みは不干渉。**既定OFF（オプトイン）**: theme_mod `shitate_image_loading`（カスタマイザー「パフォーマンス」）をONにするか `shitate_optimize_image_loading` フィルターで有効化。既定OFFの理由＝WP Rocket 等との干渉回避（ユーザー決定 2026-09-12）
- **メディアクエリ禁止**（clamp/grid/auto-fitで解決）。例外は2種のみ: ①デバイス出し分け ②**ユーザー設定に応答する `prefers-*`（reduced-motion / contrast / color-scheme）**。基準は「ビューポート幅で分岐しない」。幅による分岐は常に禁止
- **ベースリセット `assets/css/reset/reset.css`**（2026-09-11）: Normalize/Meyer 等のライブラリは入れない（コアの global-styles とブロックCSSがその役割を担う）。コアが触らない項目だけを `:where()` で補完。`!important` は reduced-motion ブロックのみ許可（utilities.css に次ぐ2つ目の例外）。読み込み順は reset → tokens → utilities → style。**フィルター `shitate_use_reset`（既定 true）を false にするとフロント・エディタ両方で読み込まない**（`add_filter( 'shitate_use_reset', '__return_false' )`）ただし theme.json `settings.viewport`（mobile 768px / tablet 1024px、WP7.1）は宣言済み＝**ユーザーがエディタのレスポンシブスタイルを使うときの境界**（プラグインの[br_sp]・details・sb/ifと同じ768/1024に統一）
- **!important 禁止**。例外は utilities.css（ユーティリティ層）のみ
- コンテンツ幅 64rem / 幅広 78.75rem（`--st-width-text` / `--st-width-max` 同期。2026-09-01にrem化＝ブラウザ文字サイズ設定に行長が追従）
- **角丸は3語彙のみ**: `--st-radius-s/m/l`（0.375/0.625/0.75rem）。直書きpx禁止、パターン/テンプレートもvar()参照（旧8px→m、10px→m、12px→l に集約済み）
- 文字の丸め/流体モード（shitate_round_scale）は**既定ON**（2026-09-01〜）

## ユーティリティ
- `assets/css/utilities.css`: `mt|mb|ml|mr|mx|my|m|pt|pb|pl|pr|px|py|p`-`0|xxs..xxxl` ＋ `mx-auto`
- エディタツールバー「余白」ドロップダウン: `assets/js/utilities-toolbar.js`（全ブロックにmt/mb/pt/pb/px＋mx-autoを付け外し）
- フロント用JS `assets/js/navigation-toggle.js`（ハンドル `shitate-navigation-toggle`、defer）: モバイルメニューを開いた瞬間にハンバーガーの位置を `--shitate-nav-toggle-top/right/size` としてナビブロックに記録し、style.css が閉じるボタンをそこへ absolute 配置（オーバーレイはコアが transform でフェードインするため fixed ではなく absolute）。ヘッダー高さに依存しない。**WP 7.1 のカスタム「ナビゲーションオーバーレイ」（コンテナに `.disable-default-overlay`）では** 旧規則を効かせず（`:not(.disable-default-overlay)`）、`.wp-block-navigation-overlay-close` を MutationObserver で `is-menu-open` 付与後に計測 → `--shitate-nav-close-dx/dy` の translate で重ねる（サイト所有者のオーバーレイ設計を崩さない）。rAF は非表示タブで止まるので使わない

## パターン
- `patterns/*.php`、Slug `shitate/*`、文言は `esc_html_e( '…', 'shitate' )`（日本語訳は languages/ で提供済み、サイト言語に自動追従）
- **2026-09-08 リセット**: インサーターに出るコンテンツパターン9種（hero/concept/product/pattern-showcase/cta/faq/pricing/services/recent-posts）と templates/front-page.html を削除。ユーザーがサイトエディターで作り直す方針（DB側のパターン/テンプレートを後でファイルに書き出す）。同日、サイトエディター上の「マイパターン」4つ（wp_block 5670/5674/5672/5684）を英語ソース＋JA辞書で `hero` / `columns-3` / `columns-4` / `cta-two-buttons` として書き出し済み（DB側の wp_block はそのまま＝インサーターでは同名が2つ見える）。基盤パターン2つ（404-content・footer-credit、`Inserter: no`）は維持。front-page.html が無い間、フロントページは page.html（固定ページの本文）で表示
- sb/* ブロックを使うパターンはテーマに置かない（プラグイン側で register_block_pattern）

## i18n（翻訳の更新手順）
翻訳辞書と抽出スクリプトはプラグイン側にある（横断管理）:
```bash
cd ../../plugins/shitate-pro-blocks && node bin/make-i18n.mjs
cd - && msgfmt languages/shitate-ja.po -o languages/ja.mo
```
JS翻訳（utilities-toolbar）は `languages/shitate-ja-shitate-utilities-toolbar.json`（ハンドル名命名）。

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
- カスタマイザーのスケール上書きは `shitate_scale_inline_css()` → フロントは shitate-tokens 直後にインライン、エディタは `block_editor_settings_all` で注入
- 配布zip: `bin/build-zip.sh` → dist/shitate.zip
- フッターの©表記は `patterns/footer-credit.php`（年＋サイト名、サイト所有者の表記。テーマ作者の著作権をフロントに出さない＝.org要件）。404本文も `shitate/404-content` パターンで翻訳可
