==== Copyright ====
Copyright (c) 2025 yuiko.
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/licenses/.

========  =========

# portfolio - WordPress Custom Theme

このリポジトリは、WordPressで構築したオリジナルのポートフォリオサイト用テーマです。
SCSS（Sass）でのFLOCSS設計、そしてVite + Node.js + npm を使って、SCSS をCSSにコンパイルするビルド環境を構築。
モダンで高速な開発体験と保守性の高いスタイル設計を実現しています。

---

##  サイト概要

- **目的**：Web制作の実績紹介・お問い合わせ導線の提供
- **制作対象**：PC / タブレット / スマートフォン 対応（レスポンシブ対応）
- **構築方法**：WordPressのオリジナルテーマとして、一から設計・実装

---

##  使用技術・ツール

###  フロントエンド

- **HTML5 / CSS3 / JavaScript**  
  モダン構文でのマークアップと動的挙動

- **Sass（SCSS記法）**  
  コンポーネント単位で設計。変数やネストなどを活用

- **Vite**  
  モダンなビルドツール。SCSSやJSのバンドルを高速に実行
    Vite    | 6.3.5

- **Node.js / npm**  
    ViteとSassのビルド環境構築用に使用
    Node.js | v22.15.0
    npm     | 11.4.2

- **Swiper / GSAP**  
  スライダーやスクロールアニメーションを演出
    Swiper  | 11.2.8
    GSAP    | 3.13.0

---

###  バックエンド

- **WordPress**  
  カスタムテーマとして、管理画面から柔軟な運用を可能に

- **PHP**  
  `functions.php` やテンプレート階層を利用したテーマ設計

---

### フォント

ロゴに使用フォント
Putung：Copyright (c) 2025 Khurasan. All rights reserved.
Alucky：Copyright (c) 2025 Khurasan. All rights reserved.


##  ディレクトリ構成
    portfolio                                   
    ├─ css                                      
    │   └─ swiper-bundle.css                    # スワイパー用CSS
    │   
    ├─ dist                                     
    │   ├─ background-iPD8CxWn.webp             # CSSコンパイル用画像
    │   ├─ background-rUiSgsii.webp             # CSSコンパイル用画像
    │   ├─ bundle.js                            # 読み込み用JS
    │   └─ style.css                            # 読み込み用CSS
    │   
    ├─ js                                       
    │   ├─ ScrollSmoother.js                    # 
    │   ├─ ScrollSmoother.min.js                # 
    │   ├─ ScrollToPlugin.js                    # 
    │   ├─ ScrollToPlugin.min.js                # 
    │   ├─ ScrollTrigger.js                     # 
    │   ├─ ScrollTrigger.min.js                 # 
    │   ├─ gsap.min.js                          # 
    │   └─ swiper-bundle.min.js                 # 
    │   
    ├─ picture                                  # 
    │   ├─ background.webp                      # 背景画像
    │   ├─ flowerbackground.webp                # ヒーロ画像
    │   ├─ logo.png                             # ロゴ画像メイン
    │   ├─ logo2.webp                           # ロゴ画像
    │   ├─ favicon.png                          # ファビコン画像
    │   ├─ profile.webp                         # プロフィール写真
    │   └─ modal/                               # 実績モーダル用スライド画像（軽量版）
    │       ├─ cocohome.webp / cocohome-description.webp
    │       ├─ kagu.webp / kagu-description.webp
    │       ├─ hamburger.webp / hamburger-description.webp
    │       └─ portfolio.webp / portfolio-description.webp
    │   
    ├─ scss                                     # 
    │   ├─ foundation / layout / object         # FLOCSS
    │   └─ style.scss                           # エントリ
    │   
    ├─ src                                      
    │   ├─ main.js                              # サイト全体のJS。bundle.jsにビルド
    │   └─ portfolio-data.js                    # 実績モーダルデータ（運用で編集する）
    │   
    ├─ template-parts                           
    │   └─ content-single.php                   # TOPに投稿ページを読み込むファイル
    │   
    ├─ 404.php                                  # 
    ├─ footer.php                               # 
    ├─ front-page.php                           # TOPページ
    ├─ functions.php                            # 
    ├─ header.php                               # 
    ├─ index.php                                # 
    ├─ package-lock.json                        # 
    ├─ package.json                             # 
    ├─ page.php                                 # 固定ページ。フロントページ/個人情報のお取り扱いについて
    ├─ readme.txt                               # 
    ├─ screenshot.png                           # WordPressテーマ用
    ├─ single.php                               # 投稿ページ。メニュー項目
    ├─ style.css                                # テーマ情報記載用
    ├─ style.css.map                            # 
    └─ vite.config.js                           # 


##  Works 実績モーダルの追加・更新（運用）

実績スライダーの中身は **`src/portfolio-data.js`** だけ編集します（`main.js` は触らなくてOK）。

### 紐付けの仕組み

- 一覧サムネ（メディアライブラリのファイル名）と、`portfolio-data.js` のキーを揃える
- 例: `cocohome.webp` / `cocohome-1024x1024.webp` → キーは `cocohome`
- エディタ上の並び順は関係ない（番号の付け替え不要）

### 新規実績を足す手順

1. メディアライブラリに一覧用サムネをアップ（ファイル名ベース = キー）
2. モーダル用画像を `picture/modal/` に置く（例: `newwork.webp`, `newwork-description.webp`）
3. WordPress エディタの Works に画像ブロックを追加し、スタイル「実績画像」を適用
4. `src/portfolio-data.js` にキーを1件追加（配列の先頭がスワイパー1枚目）
5. ビルドする

```bash
npm run build
```

6. 本番には少なくとも次をアップする
   - `dist/bundle.js`
   - `picture/modal/` に追加した画像

### スライドの順番

`portfolio-data.js` 内の配列順がそのままスワイパー表示順です。詳細を先に出す場合は `*-description.webp` を配列の先頭にします。


##  開発環境構築（ローカル）

### 必須環境

- Node.js（v18以上推奨）
- WordPressローカル環境（例：Local by Flywheel, MAMP, XAMPPなど）

### セットアップ手順

```bash
# 1. Node.jsプロジェクト初期化
npm init -y

# 2. 開発依存をインストール
npm install -D vite sass

# 3. ビルド実行（dist/style.cssとbundle.jsを出力）
npm run build
```

### npmスクリプト

```json
"scripts": {
  "dev": "vite",
  "build": "vite build"
}
```

※ ブラウザが読むのは `src/` ではなくビルド後の `dist/bundle.js` / `dist/style.css` です。

html5doctor.com Reset Stylesheet
v1.6.1
Last Updated: 2010-09-17
Twitter: @rich_clark
