<?php
/**
 * 固定ページ用テンプレート。
 * テーマ portfolio の直下に置く。スラッグが site-support の固定ページで使われる。
 * css/p-site-support.css はテーマの css フォルダに置く。
 * front-page.php は変更しない。
 */

add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_enqueue_style(
			'and8-support-fonts',
			'https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500;700&family=Roboto:wght@500;700&display=swap',
			array(),
			null
		);
		wp_enqueue_style(
			'and8-site-support',
			get_theme_file_uri( 'css/p-site-support.css' ),
			array( 'style', 'and8-support-fonts' ),
			'1.0.0'
		);
	}
);

add_filter(
	'document_title_parts',
	static function ( $title ) {
		$title['title'] = 'WordPressサイトの点検と保守';
		return $title;
	}
);

$and8_contact = esc_url( home_url( '/#contact' ) );

get_header();
?>
        <div class="c-hamburger__button--area" id="js-hamburger">
            <div class="c-hamburger__button--open"></div>
        </div>
        <nav class="p-menu" id="js-nav">
            <div class="p-menu__inner">
                <div class="c-hamburger__button--area" id="js-hamburger-close">
                    <div class="c-hamburger__button--close" id="js-close-button"></div>
                </div>
                <div>
                    <?php if ( has_nav_menu( 'hamburger' ) ) : ?>
                        <?php
                        wp_nav_menu(
                            array(
                                'menu'            => '',
                                'container'       => false,
                                'menu_class'      => 'p-menu__menulist',
                                'fallback_cb'     => false,
                                'echo'            => true,
                                'depth'           => 1,
                                'theme_location'  => 'hamburger',
                                'item_spacing'    => 'false',
                            )
                        );
                        ?>
                    <?php else : ?>
                        <p class="p-menu__menulist">メニューはまだ設定されていません。</p>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <div id="smooth-wrapper">
            <div id="smooth-content">
                <div class="p-smooth__background" id="js-smooth">
<main class="l-main l-main__font p-support" id="main">
    <section class="p-support__section p-support__hero">
        <div class="p-support__inner">
            <ul class="p-support__local-nav">
                <li><a href="#service">サービス内容</a></li>
                <li><a href="#price">料金</a></li>
                <li><a href="#faq">よくある質問</a></li>
            </ul>
            <p class="p-support__eyebrow">名古屋市名東区の And 8</p>
            <h1 class="p-support__title">
                <strong>WordPressサイトの保守運用プラン</strong>
                <span>お客様がお持ちのWebサイトを更新・修正対応いたします</span>
            </h1>
            <div class="p-support__offer" aria-label="料金の概要">
                <p>1か月単位</p>
                <p><strong>点検のあと、月額で更新対応</strong></p>
                <p class="p-support__price"><span>月額</span> <strong>8,800</strong><small>円（税込）</small></p>
                <ul class="p-support__notes">
                    <li>初回の点検 33,000円</li>
                    <li>月文章800字、写真3枚　他複数サポート</li>
                    <li>追加は4,400円</li>
                </ul>
            </div>
            <div class="p-support__actions">
                <a class="p-support__button" href="<?php echo $and8_contact; ?>">保守について相談する</a>
                <a class="p-support__text-link" href="#service">サービス内容を見る</a>
            </div>
            <ul class="p-support__notes" aria-label="サービスの特徴">
                <li>全国対応</li>
                <li>ログインできないときは初回料金いただきません</li>
                <li>お客様のパスワードは受け取らない</li>
            </ul>
        </div>
    </section>

    <section class="p-support__section p-support__section--facts">
        <div class="p-support__inner">
            <h2 class="p-support__heading p-support__heading--center">正しい情報、載せてありますか？</h2>
            <p class="p-support__lead p-support__lead--center">管理画面を開く時間だけが、取れない。</p>
            <p class="p-support__lead p-support__lead--center">すでにWordPressサイトを公開していて、<br>営業時間、料金、スタッフ、メニュー、お知らせなどを直したい・追加したい事業者さま向けです。</p>
            <ul class="p-support__notes">
                <li>営業時間や料金が古いまま</li>
                <li>お知らせを自分で載せられない</li>
                <li>管理画面を触るのが不安</li>
                <li>テーマやプラグインを更新してよいか分からない</li>
                <li>制作会社との契約が終わった</li>
                <li>作り直すほどではない</li>
                <li>問い合わせフォームが動くか不安</li>
                <li>サーバーやドメインの更新時期が分からない</li>
            </ul>
            <p class="p-support__lead p-support__lead--center">作り直さずに点検し、<strong>修正・更新可能です</strong>。</p>
        </div>
    </section>

    <section class="p-support__section" id="service">
        <div class="p-support__inner">
            <p class="p-support__eyebrow">What we do</p>
            <h2 class="p-support__heading">初回点検後、毎月修正・更新対応します</h2>
            <ol class="p-support__steps">
                <li><span>01</span><h3>ログインを確認</h3><p>WordPressの管理画面と契約サーバーの両方に入れるかを確認します。どちらかに入れない場合、初回料金はいただきません。</p></li>
                <li><span>02</span><h3>点検と整備　33,000円</h3><p>入金を確認してから、ファイルとデータベースのバックアップを取り、更新可否判断から始め、主なページ、問い合わせフォームを確認します。</p></li>
                <li><span>03</span><h3>短い報告</h3><p>行った内容と、月額では扱えない点をお渡しします。</p></li>
                <li><span>04</span><h3>月額　8,800円</h3><p>サイトやプラグインの定期的な更新作業に加え、お知らせや営業時間・料金・メニューの修正などは月に一度、まとめて送られた範囲で直します。</p></li>
                <li><span>05</span><h3>1か月単位</h3><p>最低契約期間はありません。解約の連絡は、前月20日までにお願いします。</p></li>
            </ol>
            <p class="p-support__annotation">更新の実施は、月契約開始後、問題のない範囲だけ行います。追加料金が必要な場合は、勝手に作業いたしません。</p>
        </div>
    </section>

    <section class="p-support__section p-support__section--white">
        <div class="p-support__inner">
            <p class="p-support__eyebrow p-support__heading--center">Check points</p>
            <h2 class="p-support__heading p-support__heading--center">点検で見ること</h2>
            <div class="p-support__grid">
                <article><span>01</span><h3>名義とログイン</h3><p>サイト、ドメイン、サーバーの名義と、管理画面・サーバーに入れるかを確認します。</p></article>
                <article><span>02</span><h3>バックアップ</h3><p>更新の前に、ファイルとデータベースを取ります。保管はサイトのサーバーとは別です。</p></article>
                <article><span>03</span><h3>更新してよいか</h3><p>本体、テーマ、プラグインを、通常の手順で更新できるかを見ます。</p></article>
                <article><span>04</span><h3>SSL</h3><p>証明書が有効かを確認します。</p></article>
                <article><span>05</span><h3>主なページ</h3><p>公開中の主なページが、表示されるかを確認します。</p></article>
                <article><span>06</span><h3>問い合わせフォーム</h3><p>フォームが送れるかを確認します。件名で、保守のテストと分かるようにします。</p></article>
                <article><span>07</span><h3>月額では扱えない点</h3><p>新しいページや、通常更新できない状態は、短い報告に分けて書きます。</p></article>
            </div>
            <p class="p-support__annotation">検索順位、集客、売上、AI検索への掲載は確認せず、約束もしません。</p>
        </div>
    </section>

    <section class="p-support__section p-support__section--monthly">
        <div class="p-support__inner p-support__split">
            <div>
                <p class="p-support__eyebrow">Monthly</p>
                <h2 class="p-support__heading">月額で直す内容</h2>
                <p>一度にまとめて送られたものを月1回とし修正いたします。文章と写真はお客様にご用意いただきます。</p>
                <ul class="p-support__list">
                    <li>営業時間</li>
                    <li>定休日</li>
                    <li>電話番号</li>
                    <li>料金（字数の外）</li>
                    <li>すでにページにある文章（合わせて800字）</li>
                    <li>スタッフやメニューの文章（800字に含める）</li>
                    <li>写真の差し替え（3枚まで）</li>
                    <li>お知らせ（載せる月は本文を800字に含める）</li>
                    <li>サーバーとドメインの更新時期のご案内</li>
                    <li>メールでの短いご相談</li>
                </ul>
            </div>
            <aside class="p-support__card">
                <h3>月額に含めないこと</h3>
                <ul class="p-support__list">
                    <li>新しいページ</li>
                    <li>大幅なデザイン変更</li>
                    <li>機能の追加</li>
                    <li>原稿を書くこと、撮影</li>
                    <li>サーバーの引っ越し</li>
                    <li>改ざんやマルウェアからの復旧</li>
                    <li>SEO、アクセス解析、AI検索</li>
                    <li>検索順位や売上の約束</li>
                </ul>
                <p>この範囲を超える作業は、着手する前に追加の見積もりが発生いたします。</p>
            </aside>
        </div>
    </section>

    <section class="p-support__section p-support__section-update">
        <div class="p-support__inner">
            <p class="p-support__eyebrow">Updates</p>
            <h2 class="p-support__heading">更新作業について</h2>
            <div class="p-support__columns">
                <div class="p-support__panel">
                    
                    <p><strong>テーマやプラグインを定期的に更新します。</strong></p>
                    <p><strong>更新の前に、ファイルとデータベースのバックアップを取ります。</strong></p>
                    <ul class="p-support__list">
						<li>当方の更新が原因で不具合が起きたときは、バックアップから戻し、主なページの表示と問い合わせフォームの確認までを月額の中で行います。安全な更新が認められないときは、月契約はスタートいたしません。</li>
					</ul>
                </div>
                <div class="p-support__panel">
                    <h3>月契約を始めない条件</h3>
                    <ul class="p-support__list">
                        <li>管理画面かサーバーに入れない</li>
                        <li>PHPが古すぎて通常更新できない</li>
                        <li>有料テーマやプラグインの期限切れ</li>
                        <li>改ざんやマルウェアがある</li>
                        <li>サーバーの引っ越しが先に必要</li>
                        <li>毎日の監視</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </section>

    <section class="p-support__section">
        <div class="p-support__inner">
            <p class="p-support__eyebrow p-support__heading--center">Process</p>
            <h2 class="p-support__heading p-support__heading--center">相談から、毎月の更新まで</h2>
            <ol class="p-support__flow">
                <li><span>01</span><h3>返信</h3><p>点検を頼む旨と、サイトのURLをお送りください。パスワードは書かないでください。</p></li>
                <li><span>02</span><h3>ログイン確認</h3><p>お客様のパスワードは受け取りません。And 8用の管理者を1人追加していただき、管理画面とサーバーの両方に入れたら、初回33,000円を請求します。</p></li>
                <li><span>03</span><h3>入金</h3><p>入金を確認してから、バックアップと点検に入ります。</p></li>
                <li><span>04</span><h3>点検と整備</h3><p>更新してよいか、SSL、主なページ、問い合わせフォームを確認します。</p></li>
                <li><span>05</span><h3>報告</h3><p>行った内容と、月額では扱えない点をお渡しします。この段階では月契約はスタート致しません。</p></li>
                <li><span>06</span><h3>月額の請求</h3><p>前月28日に請求し、支払期限はその月末です。振込手数料はお客様にご負担いただきます。</p></li>
                <li><span>07</span><h3>情報を載せる</h3><p>入金を確認してから、まとめて送られた文章と写真を載せます。</p></li>
            </ol>
        </div>
    </section>

    <section class="p-support__section p-support__section--white" id="price">
        <div class="p-support__inner p-support__price-layout">
            <div>
                <p class="p-support__eyebrow">Price</p>
                <h2 class="p-support__heading">料金</h2>
                <p>すでに公開しているWordPressサイトが対象です。サーバーなどの名義はお客様のままです。</p>
            </div>
            <div class="p-support__panel">
                <p class="p-support__eyebrow">月額</p>
                <p class="p-support__price"><strong>8,800</strong><small>円（税込）</small></p>
                <ul class="p-support__list">
                    <li>初回の点検 33,000円</li>
                    <li>同じセットの追加 4,400円</li>
                    <li>営業時間、定休日、電話番号、料金</li>
                    <li>文章は合わせて800字</li>
                    <li>写真は3枚まで</li>
                    <li>お知らせの本文は800字に含める</li>
                    <li>使わなかった分の繰越なし</li>
                </ul>
                <a class="p-support__button" href="<?php echo $and8_contact; ?>">保守について相談する</a>
                <p class="p-support__note">テーマやプラグインはサイトを壊さないよう更新します。</p>
            </div>
        </div>
        <div class="p-support__inner">
            <h3>お支払い</h3>
            <ul class="p-support__list">
                <li>銀行振込。振込手数料はお客様にご負担いただきます</li>
                <li>初回33,000円は、WordPress管理画面とサーバー両方にログインできたときに請求します</li>
                <li>月額は前月28日に請求し、支払期限は当月末です</li>
                <li>解約のご連絡は前月20日までにお願いします</li>
            </ul>
            <p>ログインできないときは、初回料金を・月額料金はいただきません。</p>
            <p>検索順位、集客、売上は約束できませんのでご了承ください。</p>
        </div>
    </section>

    <section class="p-support__section p-support__section--ink">
        <div class="p-support__inner p-support__about">
            <h2 class="p-support__heading">yuiko miyano</h2>
            <div>
                <p>名古屋市を拠点に、WordPressを使ったWebサイト制作・コーディングを行っています。</p>
                <p>HTML・CSS・JavaScriptによるレスポンシブ対応、WordPressオリジナルテーマの構築、既存テーマのカスタマイズなどに対応。</p>
                <p>作り直すことを前提にせず、現在のサイトのチェックと、毎月の情報更新を担当します。</p>
            </div>
        </div>
    </section>

    <section class="p-support__section" id="faq">
        <div class="p-support__inner p-support__inner--narrow p-support__faq">
            <p class="p-support__eyebrow p-support__heading--center">FAQ</p>
            <h2 class="p-support__heading p-support__heading--center">よくある質問</h2>
            <details open>
                <summary>愛知県外でも依頼できますか？</summary>
                <p>はい、可能です。</p>
            </details>
            <details open>
                <summary>他社が作ったサイトでも頼めますか？</summary>
                <p>名義がお客様にあり、管理画面とサーバーに入れる状態であれば可能です。制作会社との契約内容は事前にご確認ください。</p>
            </details>
            <details open>
                <summary>ログインできないときは料金がかかりますか？</summary>
                <p>管理画面かサーバーのどちらかに入れない場合、初回料金・月額はいただきません。探す場所を案内するだけです。</p>
            </details>
            <details open>
                <summary>管理画面にはどうやって入りますか？</summary>
                <p>最初の連絡では入りません。URLと、ご自身で入れるかどうかだけをください。入れる場合は、今のパスワードは受け取らず、WordPressに And 8 用の管理者を1人追加していただきます。追加のメールが届いてから、こちらでパスワードを作ります。追加が難しいときは、電話か対面で一緒に入力します。</p>
            </details>
            <details open>
                <summary>月額で直せるものは何ですか？</summary>
                <p>営業時間、定休日、電話番号、料金は字数の外です。すでにページにある文章は合わせて800字、写真は3枚までです。お知らせを載せる月は、その本文を800字に含めます。</p>
            </details>
            <details open>
                <summary>検索順位は上がりますか？</summary>
                <p>検索順位、集客、売上は約束しません。毎日の死活監視やアクセス解析も含みません。</p>
            </details>
            <details open>
                <summary>新しいページは作れますか？</summary>
                <p>新しいページ、機能の追加、大幅なデザイン変更、原稿、撮影は月額に含みません。着手する前に別の見積もりをします。</p>
            </details>
            <details open>
                <summary>更新で不具合が出たらどうなりますか？</summary>
                <p>And 8の更新が原因のときは、そのバックアップから戻し、主なページの表示と問い合わせフォームの確認までを月額の中で行います。</p>
            </details>
        </div>
    </section>

    <section class="p-support__section p-support__section--white">
        <div class="p-support__inner p-support__inner--narrow">
            <p class="p-support__eyebrow">Contact</p>
            <h2 class="p-support__heading">サイトのURLをお送りください。</h2>
            <p>サイトのURLと、管理画面に入れるかどうかをご記載ください。パスワードは書かないようお願いいたします。</p>
            <a class="p-support__button" href="<?php echo $and8_contact; ?>">保守について相談する</a>
            <p class="p-support__note">送信時点では契約になりません。</p>
        </div>
    </section>
</main>
<?php get_footer(); ?>
