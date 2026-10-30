# Changelog

Shitate テーマの変更履歴。書式は [Keep a Changelog](https://keepachangelog.com/ja/)、バージョンは [Semantic Versioning](https://semver.org/lang/ja/) に従う。

リリース手順: [Unreleased] にたまった項目を「## [X.Y.Z] - YYYY-MM-DD」セクションに移してから `bin/release.sh X.Y.Z` を実行する。

## [Unreleased]

### Changed

- アイキャッチの角丸を既定で 0 に。`single.html`（投稿以外の個別ページ）と `page.html` のアイキャッチ画像から border-radius（`--st-radius-m`）を削除（`single-post.html` と一覧テンプレートはもともと角丸なし）。角丸が欲しい場合はサイトエディターでブロックの「角丸」を設定する

### Added

- パターン「Posts, first post large」（`shitate/posts-featured-grid`）: 見出しと「一覧を見る」リンク、最新の投稿 1 件を大きなカード（画像の横に本文）、続く 3 件を 3 列のカードで並べる。投稿テンプレートの「カード（1件を大きく）」スタイルと同じ組み方

### Fixed

- パターン `features-3` のアイコン画像に `"height":"auto"` を明示。WordPress 7.1 から画像ブロックが幅だけ指定のとき `height:auto` を付けて保存するようになり、挿入時にエディターが旧形式を自動変換していた。高さを明示すると 7.0 と 7.1 で同じ保存結果になる
- エディターの「shitate設定」パネルで、スケール比率・本文サイズ・ページタイトルの切り替えが詰まって並んでいたのを、16px 間隔に

## [1.0.6] - 2026-10-23

### Changed

- 必要な PHP バージョンを 7.4 から 8.3 に引き上げ（style.css / readme.txt の Requires PHP）。PHP 8.3 未満のサイトでは WordPress がテーマの更新・有効化を止める
- `screenshot.png` を公式サイトのリニューアル後のトップページで撮り直し（1200×900。フローティングの言語切替・タイプスケールボタンとキャンペーン帯は非表示で撮影）

## [1.0.5] - 2026-10-21

### Upgrade notes（1.0.5 で挙動が変わる点）

- 投稿専用テンプレート `single-post.html` は、サイトエディターで保存した `single` より優先される（テンプレート階層 single-post → single）。保存済みの `single` をカスタマイズしていたサイトでは、投稿だけが新しい読み物レイアウトになり、他の投稿タイプは保存済みのまま。元に戻すにはサイトエディターで `single-post` を編集して保存する
- コア既定のプリセット（色 12・グラデーション 12・シャドウ 5）は CSS からも消える。他テーマ時代に作った記事がコア既定色（`has-vivid-red-color` 等）を使っていると無色になるので、テーマのパレットで塗り直す。テーマのパレット・シャドウは影響なし
- フロントの CSS が 1 バンドルになったため、`shitate-reset` / `shitate-utilities` / `shitate-style` の個別 dequeue は効かない（空のエイリアス）。従来の 4 ファイル構成に戻すには `add_filter( 'shitate_use_bundle', '__return_false' )`

### Added

- 投稿専用テンプレート `templates/single-post.html` を追加。本文幅 42rem の読み物レイアウト（パンくず・カテゴリー・タイトル・著者/日付/読了時間のメタ行・16:9 のアイキャッチ・タグ・著者ボックス・前後の記事・コメント）。固定ページとカスタム投稿タイプは従来の `single.html` のまま
- パンくずブロックにスタイル「Single line」（1行・横スクロール）を追加。折り返さず、はみ出した分は横にスクロールする（スクロールバーは非表示）。JA と 6 言語の翻訳つき
- 一覧カードの型を 1 つに決めた（index / archive / search、コアブロックのみ）: アイキャッチ 16:9（角丸なし）→ カテゴリーのチップ＋日付 → タイトル（medium・2 行で省略）→ 抜粋（small・2 行で省略）。グリッドは列間 `--st-space-l`・行間 `--st-space-xl`、1 列あたり 18rem 以上で自動的に折り返す。pro blocks の投稿カードも同じ骨格に揃えた
- ブロックスタイルを追加: 投稿のターム「Chips」（タームごとにチップ。base-2 の面に primary の文字、ホバーで反転）、投稿タイトル／抜粋「Two lines」（2 行で省略）、投稿テンプレート「Cards」（行間を `--st-space-xl` に）。いずれも JA と 6 言語の翻訳つき
- 一覧のレイアウトを 3 型に（他社テーマの調査をもとに 2026-10-20 決定、すべて CSS のブロックスタイル）: 投稿テンプレート「Cards, first post large」（1 件目をグリッド幅いっぱいに、画像左・文字右。2 ページ目以降と狭い幅では普通のカード）、「List」（画像 1/3＋文字、罫線）、「Rows」（日付・チップ・タイトルの 1 行）。既定は index＝1 件目大、archive／search＝リスト。カードのタイトルサイズはスタイル側で決める（medium / 1 件目は x-large / リストは large）
- 投稿ページの見出しを 2 カラムに（タイトル左、固定ページの抜粋を右）、その下にカテゴリーのチップ列（`hidden-category-nav`: 「すべて」＋投稿のあるカテゴリー、現在地は塗り）。カテゴリーアーカイブにも同じ列を表示
- パターン「News rows」（お知らせ行型）: 見出し・最新 5 件の行・「一覧を見る」リンク。クエリをカテゴリーや別の投稿タイプに変えてお知らせ欄に使う
- カードの仕上げ: ホバーで画像をわずかに拡大（reduced-motion では無効）、先頭固定の投稿に「PICKUP」ラベル（翻訳可、`--st-label-pickup`）。「Chips」スタイルは段落とカテゴリーブロックにも登録
- ナビゲーションを国産テーマ風に（ブロックスタイル、CSS のみ）: ナビゲーション「Captioned」＝各項目に小さなキャプション（リンクの「説明」欄。コアは出力だけして非表示にしていたものを表示）、ホバーと現在ページにブランド色の下線バー、ドロップダウンは影付きパネル、スマホのオーバーレイは罫線付きの行。「Underline」はキャプションなしの同型。ナビゲーションリンク「Button」（塗り）／「Outline」（枠線）で右端の CTA を作れる（オーバーレイでは全幅）。既定のヘッダーパーツは Captioned を適用。JA と 6 言語の翻訳つき
- 一覧のページネーションの様式: 中央揃え、番号は 2.25rem の角丸ボタン（現在ページは contrast の面）、前後のリンクは太字・下線なし・シェブロン付き。グリッドとの間は `--st-space-xxl`、見出しとグリッドの間は `--st-space-xl`
- 投稿ページの見出し（`hidden-posts-heading`）: 「投稿ページ」に選んだ固定ページに抜粋が書かれていれば、見出しの下に説明文として表示（neutral）
- エディターのサイドバーに「shitate設定」パネル（タイトル先頭にテーマのマーク＝ファビコン）: 投稿・固定ページ単位で比率と本文サイズを上書き（投稿メタ `_shitate_ratio` / `_shitate_text_m`、優先順位はページ > サイト。投稿タイプ別の段は 2026-10-21 に廃止）。変更は canvas に即時反映。同じパネルの「ページタイトルを出力しない」（`_shitate_hide_title`）で、そのページだけテンプレートの投稿タイトルブロックを出力しない（独自のヒーローで始まるページ向け。ドキュメントタイトルやメニューは不変）

### Changed

- フロントの CSS を 1 ファイルに: reset / tokens / utilities / style.css を `bin/build-css.mjs`（esbuild）で結合・minify した `assets/css/shitate-reset.min.css`（約 36KB → 約 15KB、リクエストも 4 → 1）を読み込む。`SCRIPT_DEBUG` ではソースを個別読み込み、エディタは常にソース。ハンドル名は変更なし（バンドル＝`shitate-tokens`、他は空のエイリアス）。GTmetrix の「Minify CSS」対応
- コア既定のプリセット（色 12・グラデーション 12・シャドウ 5）を global-styles の CSS からも除去（`wp_theme_json_data_default` フィルター。theme.json の `defaultPalette: false` 等は UI を隠すだけで CSS は出ていた）。新規インストールで global-styles が 17.8KB → 10.4KB
- 本文の細部の様式を決めた（theme.json と tokens.css、全サイト共通）: 見出しの字間 -0.015em／リンクの下線は 0.0625rem・文字から 0.2em 下・リンク色の 45%（ホバーで 100%）／引用は 0.25rem の薄い罫＋引用元は小さく中間色／プルクオートは上下 0.0625rem の罫・太字・イタリックなし・上下 1.5 行の余白／表は横罫のみ・見出し行の下は中間色の罫・偶数行は base-2 の縞・数字は等幅（tabular-nums）／キャプションは small・neutral／区切り線は 0.0625rem の薄い罫／コードブロックは base-2 の面＋角丸・等幅フォント・small、インラインコードは base-2 のチップ。罫の色は新トークン `--st-color-rule`（neutral 35% と base の混色）、下線は `--st-color-underline`。長さは rem と余白トークンで指定（px 換算で偶数）、文字に追従する下線位置・字間・インラインコードの大きさだけ em
- 投稿テンプレートの区切り線は色指定なしにし、テーマ既定の罫に従う
- 余白のトークン `--st-space-xxs〜xxxl` を比率連動から固定値に変更: 0.25 / 0.5 / 0.75 / 1 / 1.5 / 2.5 / 4 / 6.5rem（4 / 8 / 12 / 16 / 24 / 40 / 64 / 104px）。比率・本文サイズ・画面幅のどれにも連動しない（流体の絞り込みも廃止）。タイプスケールは文字サイズだけを決め、余白は一定、という方針に（2026-10-20 決定）。既定 1.25 のサイトでは上 3 段がやや広がる（39 → 40、61 → 64、95 → 104px）、他の比率のサイトはこの値に揃う。説明文・readme・マニュアル・カスタマイザーの文言も「余白は比率に従う」から修正
- 本文の縦リズムを「行」単位に変更。基準の blockGap を本文 1 行分（`--st-line` = 本文サイズ × 行の高さ 1.75、新しい spacing プリセット「Line」）にし、画像・表・引用・区切りの前後は 1.5 行、h3/h4 の前は 1.5 行、h1/h2 の前は 2 行、見出しの直後は 0.5 行（note.com など読み物サイトの実測を参考に決定、2026-10-20）。1.0.4 の「比率の累乗」方式は、比率を 1.5 にすると余白が 2 倍以上に膨らんだため取り下げ。比率は文字サイズだけを動かし、余白は本文サイズに追従する。セクションの余白（`--st-space-*`）は従来どおり比率連動。body の行の高さは `--st-line-height` トークン経由にし、theme.json と CSS で共有

### Fixed

- 一覧カード（Cards / 1 件目大 / List）: コアの投稿抜粋ブロックが持つ下余白（blockGap 1 行分）がカード下と罫線上に残っていたのを 0 に。画像と文字の間隔はテンプレートではなくスタイル側で決めるようにし、List と 1 件目大では文字が画像の上端に揃う（インライン指定が勝って効いていなかった）。1 件目大はグリッド自身をコンテナにして（列数固定のときも）狭い幅で普通のカードに戻り、2 ページ目以降と狭い幅では文字サイズと省略行数も通常カードに戻す
- ブロックスタイルの CSS は使われたスタイルの分だけ 1 回出力（これまでは post-template の 4 スタイル分すべて、チップは最大 3 回出ていた）。各スタイルは `shitate-style-<name>` ハンドルの inline スタイルで、`render_block` でそのクラスを持つブロックが描画されたときだけ enqueue。エディターは全部読み込む
- 縦リズム: 見出し直後に画像・表・引用が来たとき、0.5 行ではなく 1.5 行が当たっていた（セレクターの詳細度の差）。`+ :not( :first-child, h1… )` に変えて 0.5 行に
- 「ページタイトルを出力しない」: `render_block_core/post-title` の第 2 引数に context は入らないため常に `get_the_ID()` に頼っていた。ブロックインスタンス（第 3 引数）の context を見るようにし、クエリループ内の投稿タイトルは隠さない
- パンくずのリンク下線は、ブロックの独自 CSS（`edit_css` 権限のないユーザーがテンプレートを保存すると消える）ではなく「Single line」スタイルの CSS で消すように
- アバターの角丸を `9999px` から `50%` に（単位ルール）。spacing プリセット「Line」（28px）の並び順を 40（24px）の次に（エディターのスライダーが大小順になる）
## [1.0.4] - 2026-10-16

### Added

- コアブロックだけで組んだパターン 12 本を追加: `about-image-text`（会社紹介）/ `contact-banner`（お問い合わせ）/ `faq`（よくある質問、details）/ `features-3`（特長 3 つ）/ `hero-cover`（カバー型ヒーロー）/ `hero-split`（左右分割ヒーロー）/ `latest-posts`（最新のお知らせ）/ `pricing-3`（料金 3 プラン）/ `services-grid`（サービス 6 つ）/ `steps-3`（3 ステップ）/ `team-3`（メンバー 3 名）/ `testimonials-2`（お客様の声 2 件）。見本文 109 件は日本語と欧州 6 言語の訳を同梱。1.0.4 で一度見送りが決まっていたが（2026-09-30）、翻訳を済ませて同梱に変更（2026-10-16）。`bin/deferred-patterns.txt` は空にした
- エディターの「タイポグラフィ」パネルで、段落・見出し・投稿タイトル・リスト・引用・ボタンに「フォント」と「外観（太さ・スタイル）」を最初から表示（`register_block_type_args` で既定コントロールに追加。従来は「+」メニューの中に隠れていた）。サイト全体の既定値はこれまでどおりサイトエディター「スタイル → タイポグラフィ」
- カスタマイザー「Typography Scale」に「日本語組版の最適化」チェックボックス（既定オフ）。オンでサイト言語が日本語のときだけ、body に `line-break: strict`、`text-autospace: normal`、`font-feature-settings: "palt" 1` を出力（`code` / `pre` / `kbd` / `samp` は palt を解除）。フォントスタックと同じく `determine_locale()` で判定し、エディターにも同じ CSS を流す。`word-break: auto-phrase` は採用しない（pro blocks の `[wbr]` で手動制御する方針。Chromium のみ対応のため）

### Changed

- 縦のリズムを比率の累乗で段階化（tokens.css、flow / constrained レイアウトのみ）: 積み重なるブロックの間隔を gap × r に 1 段上げ、画像・ギャラリー・表・引用・区切り・埋め込みの前後は gap × r²、見出し h3/h4 の前は gap × r³、h1/h2 の前は gap × r⁴（旧: 通常 gap、見出し前 1.75 倍 / 1.25 倍の固定倍率）。見出しの直後は通常の間隔のまま。theme.json の blockGap は変えない（blockGap はナビゲーションやボタン列の flex gap にも使われ、上げるとフッターメニューが折り返した）。比率 1.236（幅 1000px）での実測: 段落間 30px、h2 前 57px、h3 前 46px、画像前後 37px（旧: 24 / 43 / 31 / 24）。すべて比率に連動し、カード内など gap の小さい文脈では自動的に詰まる
- wordpress.org のタグを 14 個から 18 個に追加（`style.css` と `readme.txt` の `Tags:` を同一内容に）。追加したのは `full-width-template`（`templates/page-full-width.html`）、`template-editing`（テンプレート 7 種とテンプレートパーツをサイトエディターで編集できる）、`theme-options`（カスタマイザーの Typography Scale / パフォーマンス）、`one-column`（全テンプレートにサイドバー領域がない）。既存の 14 個は削除も並べ替えもしていない
- テーマ説明文（`style.css` の Description と `readme.txt` の Description、同一文面）を約 33 語から 197 語に拡充。訴求の軸を「比率で整う」から「8 つから選ぶだけで決まる／前提知識が要らない」に移した。あわせて事実誤りを 2 か所修正: 源となる色は 3 色ではなく 4 色（base / contrast / primary / accent）、同梱翻訳は「英語と日本語」ではなく日本語＋欧州 6 言語

### Fixed

- 投稿・固定ページのエディター（テンプレート非表示時）でタイトルと本文の間に余白がなく、1 行目がタイトルに密着していた。タイトル枠の下に gap × r²（フロントの見出し前と同じ段）を確保（editor.css）
- `readme.txt` の Resources 節のパス誤りを修正（`assets/css/reset/reset.css` → `assets/css/reset.css`。0.4.2 でフラットにしたときの取りこぼし）

## [1.0.3] - 2026-09-22

### Added

- 投稿一覧（index テンプレート）に h1 を追加（`patterns/hidden-posts-heading.php`）。「設定 → 表示設定」で投稿ページに選んだ固定ページのタイトルを使い、未設定なら「Blog」（翻訳あり）。サイトエディターでは通常の見出しブロックとして編集できる

### Fixed

- ヘッダー／フッターのテンプレートパーツで、外側のグループブロックにも `header` / `footer` タグを付けていたため、テンプレート側の `<header>` / `<footer>`（template-part ブロックの tagName）と二重になっていた。パーツ内の外側グループを `div` にし、セマンティック要素はテンプレート側の 1 つだけに。サイトエディターで保存済みのヘッダー／フッター（DB 側）はテーマファイルより優先されるため、既存サイトはパーツを「リセット」するか同じ修正を手で入れる必要がある

### Changed

- テンプレートに直書きしていた英語 5 か所を PHP パターンに移して翻訳可能にした: 「No posts were found.」（index / archive → `hidden-no-results`）、「No results found. Try another search.」（search → `hidden-no-results-search`）、検索ブロックのラベルとボタン「Search」（search → `hidden-search`）、タグの接頭辞「Tags: 」（single → `hidden-post-tags`）。日本語と欧州 6 言語の訳を同梱。デフォルトテーマ（Twenty Twenty-Three〜Five）と同じ作り
- 内部用パターンの名前を `hidden-` 接頭辞に統一: `shitate/footer-credit` → `shitate/hidden-footer-credit`、`shitate/404-content` → `shitate/hidden-404`。**旧スラッグは残していない**ので、サイトエディターで保存済みのフッター／404 テンプレートに旧スラッグの参照が残っているサイトでは、その箇所が空になる。該当テンプレートを「カスタマイズをクリア」するか、スラッグを書き換えること
- カスタマイザーの比率の説明文・マニュアル・開発メモから他社サイトについての記述を削除
- レイアウト幅のトークンを Global Styles に追従させた: `--st-width-text` / `--st-width-max` は `--wp--style--global--content-size` / `--wide-size` を参照（フォールバックは theme.json の 64rem / 78.75rem）。サイトエディター「スタイル → レイアウト」で幅を変えるとトークン側も追従する
- 流体比率の両端を変数化: `--st-fluid-t` は `--st-width-min`（375px）で 0、`--st-width-max`（幅広レイアウトの幅）で 1。従来は 375 と 885（=1260−375）が直書きで、幅広サイズを変えても比率の切り替わり位置が動かなかった。両端は `@property` 登録の `<length>` を経由して px に解決（Safari 対策と同じ仕組み。幅が長さでない値のときは既定値に戻り、分母は 1px 以上に固定）
- カスタマイザー「本文サイズ」の保存時サニタイズを `absint` から 12〜24px にクランプする `shitate_sanitize_text_m()` に変更（表示側の再検証と同じ範囲）。旧設定名 `st_*` からの移行時もカスタマイザーと同じサニタイザーを通す。パターンファイルに直接アクセス時の ABSPATH ガードを追加（いずれも 2026-09-18 の監査で挙がった低リスクの補強）
- テーマ説明文（style.css の Description と readme.txt）を、タイプスケール・FSE・3 色のカラー設計・制作会社が納品後の運用を想定して作った経緯を伝える文面に差し替え

## [1.0.2] - 2026-09-17

### Changed

- 動作要件の宣言を実態に合わせて `Requires PHP: 7.4` に（旧 7.2。WordPress 7.0 以上が前提のため実質の下限は元から 7.4）。`Requires at least: 7.0` は据え置き
- PHP 8.5.3 で動作確認（フロント各テンプレートの描画、カスタマイザー登録、派生色フィルター、画像読み込みヒント、パターン登録で警告・非推奨通知なし）

## [1.0.1] - 2026-09-15

### Fixed

- スタイルバリエーションで Primary（ブランド色）が常に #2952cc に固定されていた不具合。Mono を選んでもボタンとリンクだけ青いまま残り、Dark ではボタン文字（base 色）と Primary のコントラストが 2.4:1 まで落ちていた。各バリエーションが自分の Primary / Primary hover を持つように変更: Dark #7f9cea / #a3b8f0、Mono #1a1a1a / #444444、Cream #8a4f14 / #6f3f10、Mist #257556 / #1f6449（すべて本文・ボタン文字とのコントラスト 4.5:1 以上）。既定の theme.json は据え置き
- 派生色の自動追従（inc/colors.php）が、バリエーション適用直後にそのバリエーションが定めた派生色（Primary hover など）を上書きしていた。源 4 色が同梱パレットのいずれかと完全一致する場合はそのファイルの派生色を正とし、再計算は所有者が源色を編集したときだけ行うように変更
- Safari で流体比率が効かず、全画面幅で「小さな画面での比率」に固定されていた不具合（Safari 26.5 は `tan(atan2(100vw, 1px))` を 0 と評価する）。画面幅を `@property --st-vw`（`<length>` 登録）経由で絶対 px に解決してから atan2() に渡すように変更。Chrome / Firefox の結果は不変

## [1.0.0] - 2026-09-14

WordPress.org 公開後、設計の中核（タイプスケール・リセット・レスポンシブ）が固まったため 1.0.0 とする。

### Changed

- **比率そのものを流動化**: 余白 L〜XXXL と見出しを段ごとに別の傾きで clamp していた方式を廃止し、比率 r を画面幅 375px→1260px で (1+r)/2 → r へ滑らかに変化させ、文字・余白の全段をその一つの比率（`--st-r`）から計算する方式に変更。どの画面幅でも段の比が揃う（以前は中間幅で 1.30〜1.56 に散らばっていた）。両端の値は従来どおり。画面幅の無単位化は `tan(atan2(100vw, 1px))`、非対応ブラウザは固定比率にフォールバック（`@supports`）。流動性が比率に内包されたため、カスタマイザー「フォントサイズにラウンドを適用」は偶数px丸めのみの機能になった

### Added

- ベースリセットに UA スタイルの平準化層を追加（既定で有効）: 全要素 border-box、body/見出し/段落/figure/blockquote/dl/dd/pre の既定マージン 0、b/strong・abbr・sub/sup・code 系フォント・table・fieldset/legend・textarea・ボタンの appearance・フォーム部品のマージンをエンジン間で統一。リストのパディングと見出しサイズ、リンク色、ボタンの見た目はコアに任せて触らない。すべて `:where()` の特異度ゼロ
- トークン `--st-transition`（既定 0.2s）を追加し、ホバー状態を持つ要素（リンク・ボタン・summary・送信ボタン）に `transition: var(--st-transition)` を適用。特異度ゼロなので個別指定が優先。prefers-reduced-motion では無効
- カスタマイザー「Typography Scale」に「小さな画面での比率」を追加（既定「自動」＝1 とメイン比率の中間）。画面幅 375px での比率を PC 用とは別に選べ、1260px までの間で clamp によりメインの比率へ滑らかに補間される。ライブプレビュー対応
- 画像読み込みの最適化（`inc/performance.php`）: ブロックテンプレート内の画像にコアが付けない読み込みヒントを補う。最初の大きな画像に `fetchpriority="high"`、先頭3枚（コアの本文画像と同じ基準）は即時読み込み、それ以降の幅・高さ付き画像に `loading="lazy"`。寸法の無い画像（SVG ロゴ等）と、既に属性を持つ画像は触らない。**既定はOFF**。カスタマイザー「パフォーマンス → 画像の読み込みを最適化」をONにするか、フィルター `shitate_optimize_image_loading` で有効化する。既定OFFなので WP Rocket 等の高速化プラグインと干渉しない

### Fixed

- カスタム HTML ブロックに貼った iframe（Google マップ等）が固定幅で左寄せになる問題: ベースリセットで iframe の max-width を 100% にし、HTML ブロック内に iframe だけがある場合はブロック幅いっぱいに広げる（高さ属性は維持）
- WP 7.1 の「ナビゲーションオーバーレイ」テンプレートパーツ（`.disable-default-overlay`）を使うと、旧オーバーレイ向けの上パディングが効いてメニュー全体と閉じるボタンが下にずれていた。旧オーバーレイ向けの規則を `:not(.disable-default-overlay)` に限定し、新オーバーレイの「閉じる」ブロックは開いた瞬間にハンバーガーとの差分を計測して translate で重ねる（レイアウトは触らない。`--shitate-nav-close-dx/dy`）

## [0.4.2] - 2026-09-12

### Added

- 最小限のベースリセット `assets/css/reset.css` を追加（ハンドル `shitate-reset`、最初に読み込み・エディタにも適用）。コアが扱わない項目だけを `:where()`（特異度0）で補完: text-size-adjust / scrollbar-gutter / メディアの max-width と baseline gap / フォーム部品の font 継承 / :target の scroll-margin / :focus-visible のブランド色リング / prefers-reduced-motion。Normalize 等のライブラリは同梱しない。フィルター `shitate_use_reset` を false にすると無効化できる（フロント・エディタ両方）
- 欧州6言語の翻訳を同梱: ドイツ語 / フランス語 / スペイン語 / イタリア語 / オランダ語 / ポルトガル語（pt_PT）。辞書は `bin/locales.mjs`、生成はプラグイン側 `bin/make-i18n.mjs`（.po / .mo / JS翻訳JSON を一括生成）
- カスタマイザー「Typography Scale」に「小さな文字の数値指定」チェックボックスを追加（既定OFF）。ONにすると Small / X-Small / XX-Small が比率ではなく 0.95rem / 0.8rem / 0.75rem になる

### Changed

- フォントスタックを言語で切り替える方式に変更。既定は OS のシステムフォントのみ（CJK フォントを含めず、漢字の字形はページ言語からブラウザが選ぶ）。日本語サイトでは Hiragino Sans → Yu Gothic Medium → Meiryo の日本語優先スタックを functions.php が上書きする。Webフォントの追加は無し
- 0.4.1 で固定値にした Small / X-Small / XX-Small を、既定ではタイプスケール（比率で割る）に戻した。固定値は上記チェックボックスで選択制に

## [0.4.1] - 2026-09-08

### Added

- サイトエディターで作り直した4パターンを同梱: `shitate/hero`（見出し＋本文＋ボタン2つ）、`shitate/columns-3`（画像カード3列）、`shitate/columns-4`（画像＋見出し＋本文の4列グリッド）、`shitate/cta-two-buttons`（メッセージ＋ボタン2つ）。英語ソース＋日本語訳、画像ブロックは空
- モバイルメニューの閉じるボタンをヘッダーのハンバーガーボタンと同じ位置に自動で合わせる（`assets/js/navigation-toggle.js`＋style.css）。ロゴの高さなどでヘッダーの高さが変わっても、開いた瞬間のボタン位置を計測して追従する。JS無効時はコアの既定位置

### Changed

- 文字サイズの Small / X-Small / XX-Small をタイプスケール（比率で割る）から固定値 0.95rem / 0.8rem / 0.75rem に変更。比率で割ると小さくなりすぎるため。Medium 以上と余白は従来どおり比率連動
- 各テンプレートの main コンテナの margin-top を 0 に変更（ヘッダー直下の余白はパターン/ブロック側で持たせる）
- style.css / readme.txt の説明文から「shitate pro blocks」プラグインへの言及を削除（.org審査の推奨事項。アップセルと見なされる余地をなくす）

### Removed

- 同梱パターンをリセット: インサーターに表示されるコンテンツパターン9種（hero / concept / product / pattern-showcase / cta / faq / pricing / services / recent-posts）と、それらを並べていた front-page テンプレートを削除。フロントページは page テンプレート（固定ページ本文）で表示される。404本文とフッター©の非表示パターン2つは維持

## [0.4.0] - 2026-09-06

WordPress.org 審査（#288998）の指摘対応リリース。

### Changed

- **.org審査指摘対応（#288998）**: 公開識別子の接頭辞を `st` から `shitate` に統一（PHP関数/定数/カスタマイザーID/theme_mod は `shitate_`・`SHITATE_`、ハンドルは `shitate-`、パターンカテゴリ `shitate`・スラッグ `shitate/*`）。テンプレート/パーツの参照も更新。旧 `st_*` のカスタマイザー値は初回ロード時に自動移行。CSS変数 `--st-*` は接頭辞規則の対象外のため据え置き（プラグイン互換）
- フッターの固定文言「© 2026 shitate. All rights reserved.」（テーマ作者の著作権）を、サイト所有者用のパターン `shitate/footer-credit`（年＋サイト名、編集可）に置換
- pricing パターンを有料プラグインの価格表から汎用的な料金表（Basic/Standard/Premium＋カスタム相談バナー）に書き換え。デフォルトのフロントページから宣伝要素を排除（product/faq は汎用化済み）
- readme.txt に `== Resources ==` を追加（screenshot.png を含む同梱リソースの出典・著作権・ライセンスを明記）し、「画像は含まない」との矛盾記述を修正

### Fixed

- パターンヘッダの未登録カテゴリ `faq` / `pricing`（接頭辞なし・WPが無視していた）を除去
- `bin/build-zip.sh` がステージング後に `.DS_Store` を削除するようにし、配布zipへの混入を防止
- `Requires at least` を 6.6 → 7.0 に修正（single.html の core/breadcrumbs は WP7.0 以降。6.6 では「未対応ブロック」になっていた）

### Added

- 固定ページテンプレート（page.html）と投稿テンプレート（single.html）にコメント一覧・ページネーション・返信・コメントフォームを追加（推奨指摘への対応。single.html はサイトエディター版移植時に欠落していたものを復元）

### Added

- 派生色の自動追従（`inc/colors.php`）: サイトエディターで Base / Contrast / Primary を変更すると、Base / Two・Border・Contrast / Two・Neutral・Primary / Hover が自動で追従する（暗い配色では Hover を明るく）。派生色を手動で設定した場合はその値が優先され、スタイルバリエーションの手調整値も親色を変えるまで保持。読み取り時の計算のみで保存データは変更しない

### Fixed

- 固定ページ・投稿テンプレートで「全幅」ブロックが画面端まで広がらなかった問題を修正（page.html / single.html の `main` グループと `post-content` に `align:full` を付与。WP標準テーマと同じ構造にし、入れ子の constrained レイアウトによる全幅の打ち消しを解消。通常ブロックはコンテンツ幅のまま）

### Changed

- 余白トークンの数字名（`--st-space-1〜15`）を廃止し、文字サイズと同じ8名（`--st-space-xxs〜xxxl`）に統一。各名のサイズは従来の割り当て（旧段1/4/6/7/9/11/13/15）と同一で、見た目・ユーティリティ・プラグインのフォールバック・保存済みコンテンツはすべて不変。上位4段の流体化（clamp）も維持
- 開発者URL（Author URI）を https://weblley.co.jp/ に変更
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
