import '../scss/style.scss';
import { createPortfolioDataMap } from './portfolio-data.js';


gsap.registerPlugin(ScrollTrigger,ScrollSmoother,ScrollToPlugin)

//gsapでハンバーガーメニューをふわっと出す  

const tl = gsap.timeline({ paused: true });

tl.fromTo(".p-menu", { 
    autoAlpha: 0,
    right: "-100%",
    },//p-menuの挙動に合わせる
    {
    autoAlpha: 1,
    duration: 1.5,
    right: "0%",
    });


//hamburgerメニューtoggle

const hamburger = document.querySelector('#js-hamburger');
const hamburgerClose = document.querySelector('#js-hamburger-close');
const closeButton = document.querySelector('#js-close-button');
const nav = document.querySelector('#js-nav');
const fix = document.querySelector('#js-wrapper');
const menuClose =document.querySelectorAll('.js-menu-close');
const scrollFix =document.querySelector('#js-content');

console.log('scrollFix:', scrollFix); 

let menuOpen = false;

//ScrollSmootherの初期化: 内包を指定
const wrapper = document.querySelector('#smooth-wrapper');
const content = document.querySelector('#smooth-content');
if (wrapper && content) {
  try {
    smoother = ScrollSmoother.create({
    wrapper: '#smooth-wrapper',
    content: '#smooth-content',
    smooth: 1.5,
    effects: true
  });
  console.log('ScrollSmoother initialized',smoother);
} catch (error) {
  console.error('ScrollSmoother initialization failed:', error);
}
}else{
  console.warn('ScrollSmoother elements(#js-wrapper or .js-fix.content-wrapper) not found, skipping initialization');
}

  // ハンバーガーメニュー
if (hamburger && hamburgerClose && nav && closeButton) {
tl.eventCallback("onComplete", () => {
  hamburger.style.borderRadius = '0';
});

tl.eventCallback("onReverseComplete", () => {
  hamburger.style.borderRadius = '50%';
});

  
hamburger.addEventListener('click',function(){
  if(!menuOpen){
    nav.classList.add('open');
    fix.classList.add('fix');
    //scrollFix.classList.add('fix');
    hamburgerClose.style.borderRadius = '0'; 
    closeButton.classList.add('is-appear');
    tl.play().timeScale(1);
    //hamburgerTl.play().timeScale(1);
      if (smoother) {
        smoother.paused(true);
      } else {
        console.warn('ScrollSmoother not initialized, skipping pause');
      }
    menuOpen = true;
  }
});

hamburgerClose.addEventListener('click',function(){
  if(menuOpen){
    nav.classList.remove('open');
    fix.classList.remove('fix');
    //scrollFix.classList.remove('fix');
    hamburger.style.borderRadius = '50%'; // ← 明示的に指定
    closeButton.classList.remove('is-appear');
    tl.timeScale(1).reverse();
      if (smoother) {
        smoother.paused(false);
      }
    menuOpen = false;
  }
});

menuClose.forEach(function(close){
  close.addEventListener('click',function(){
    if(menuOpen){
      nav.classList.remove('open');
      fix.classList.remove('fix');
      //scrollFix.classList.remove('fix');
      hamburger.style.borderRadius = '50%'; // ← 明示的に指定
      closeButton.classList.remove('is-appear');
      tl.timeScale(1).reverse();
      //hamburgerTl.timeScale(1).reverse();
      if (smoother) {
        smoother.paused(false);
      }
      menuOpen = false;
    }
  });
});
} else {
  console.warn('Hamburger menu elements not found, skipping menu functionality');
}




// contactフォーム上部の文章を消す
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form.snow-monkey-form');

  if (!form) {
    console.log('フォームが見つかりません');
    return;
  }

  // 初期チェック
  const initialScreen = form.getAttribute('data-screen');
  if (initialScreen === 'complete' || initialScreen === 'systemerror') {
    document.querySelector('.is-style-contact-text')?.classList.add('none');
  }

  // 監視オブジェクト作成
  const observer = new MutationObserver(mutations => {
    mutations.forEach(mutation => {
      if (
        mutation.type === 'attributes' &&
        mutation.attributeName === 'data-screen'
      ) {
        const currentScreen = form.getAttribute('data-screen');
        console.log('data-screen変更検知:', currentScreen);

        const targetText = document.querySelector('.is-style-contact-text');
        if (!targetText) return;

        if (currentScreen === 'complete' || currentScreen === 'systemerror') {
          targetText.classList.add('none');
          console.log(`${currentScreen} 状態を検知して非表示に`);
        } else {
          targetText.classList.remove('none');
          console.log(`${currentScreen} 状態なので表示に戻す`);
        }
      }
    });
  });

  // 監視スタート
  observer.observe(form, { attributes: true });
});


// ブラウザの自動スクロールを止める
if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}

// ScrollSmoother取得用関数
const getSmoother = () => ScrollSmoother && ScrollSmoother.get();

// スライド要素を強制表示する関数
// 強制表示関数も改善
function revealHiddenContent(container) {
  if (!container) return;

  const elements = container.querySelectorAll('.p-slide__in:not(.is-animated)');
  elements.forEach((el, index) => {
    setTimeout(() => {
      gsap.set(el, {
        autoAlpha: 1,
        y: 0,
      });
      el.classList.add('is-animated');
    }, index * 50); // 少しずつ遅延させて自然に
  });
}

let isMenuClosing = false; // スクロール禁止フラグ

gsap.utils.toArray('a[href^="#"], a[href*="/#"]').forEach((link) => {
  link.addEventListener('click', (e) => {
    const href = link.getAttribute('href');
    const hash = href.includes('#') ? '#' + href.split('#')[1] : null;
    const target = hash ? document.querySelector(hash) : null;

    if (!target) return;

    e.preventDefault();

    // すでにメニュー閉じ処理中なら何もしない
    if (isMenuClosing) return;

    const smoother = getSmoother();

    const performScroll = () => {
      const isSp = isMobile();
    
      if (isSp) {
        // スマホだけ非表示にする
        target.style.visibility = 'hidden';
      }
    
      const scrollDone = () => {
        if (isSp) {
          target.style.visibility = '';
        }
        revealHiddenContent(target);
      };
    
      if (smoother && !isSp) {
        // PC：ScrollSmoother
        smoother.scrollTo(target, {
          duration: 1.5,
          ease: 'power4.out',
          onComplete: scrollDone,
        });
      } else {
        // スマホ or ScrollSmootherなし
        setTimeout(() => {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
          });
          setTimeout(scrollDone, 700); // ← ここで調整
        }, 100);
      }
    };

    if (menuOpen) {
      isMenuClosing = true;

      nav.classList.remove('open');
      fix.classList.remove('fix');
      closeButton.classList.remove('is-appear');
      if (smoother) smoother.paused(false);
      menuOpen = false;

      tl.eventCallback("onReverseComplete", () => {
        isMenuClosing = false;
        performScroll();
        tl.eventCallback("onReverseComplete", null);
      });

      tl.timeScale(1).reverse();
    } else {
      performScroll();
    }
  });
});


// リロード後のハッシュ移動
window.addEventListener('load', () => {
  const hash = window.location.hash;
  const smoother = getSmoother();

  if (hash) {
    const scrollToHash = () => {
      const target = document.querySelector(hash);
      if (target) {
        if (smoother && !isMobile()) {
          smoother.scrollTo(target, {
            duration: 1.5,
            ease: 'power4.out',
          });
        } else {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
          });
        }
        revealHiddenContent(target);
      } else if (scrollToHash.tryCount < 10) {
        scrollToHash.tryCount++;
        setTimeout(scrollToHash, 200);
      }
    };
    scrollToHash.tryCount = 0;
    setTimeout(scrollToHash, 300);
  }
});


// モバイル判定関数（簡易版）
function isMobile() {
  return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
}

//gsap mainvisual
gsap.to(".p-hero__background", { 
    backgroundColor: "rgba(188, 186, 186, 0.63)",
    duration: 3, 
    delay: 1,
     });

console.log("GSAP running", document.querySelector("#js-title-hero"));
gsap.fromTo("#js-title-hero",{
  y : 100,
  autoAlpha: 0,
}, {
    y :0,
    duration: 5,
    //delay: 5,
    ease : "power4.out",
    autoAlpha: 1,
    });
  
//スクロールで要素をふわっと
document.addEventListener("DOMContentLoaded", function () {
  let isChecking = false;
  
  function onScroll() {
    if (isChecking) return;
    isChecking = true;
    
    requestAnimationFrame(() => {
      document.querySelectorAll(".p-slide__in").forEach(function (element) {
        if (element.classList.contains("is-animated")) return;

        const rect = element.getBoundingClientRect();
        // より早めに検知：要素が画面下部に近づいたらアニメーション
        if (rect.top < window.innerHeight + 100) {
          console.log("アニメーション実行", element);
          gsap.to(element,{
              y: 0,
              delay: 0.2,
              duration: 1.5,
              autoAlpha: 1,
              ease: "power4.out"
            }
          );
          element.classList.add("is-animated");
        }
      });
      isChecking = false;
    });
  }

  // 初回チェック
  setTimeout(onScroll, 500);
  
  // ScrollSmootherのスクロールイベントも取得
  const smoother = ScrollSmoother.get();
  if (smoother) {
    // ScrollSmootherのコンテナに直接イベントを追加
    const smoothContent = document.querySelector('#smooth-content');
    if (smoothContent) {
      smoothContent.addEventListener("scroll", onScroll, { passive: true });
    }
    
    // ScrollTriggerでも検知
    ScrollTrigger.create({
      trigger: "body",
      start: "top top",
      end: "bottom bottom",
      onUpdate: onScroll,
      onRefresh: onScroll
    });
  }
  
  // 通常のスクロールイベント（保険）
  window.addEventListener("scroll", onScroll, { passive: true });
  document.addEventListener("scroll", onScroll, { passive: true });
  
  // モバイル対応：各種タッチイベント
  window.addEventListener("touchend", onScroll, { passive: true });
  window.addEventListener("touchmove", onScroll, { passive: true });
  window.addEventListener("touchstart", () => setTimeout(onScroll, 50), { passive: true });
  
  // 定期チェック（最後の砦）
  setInterval(onScroll, 300);
});
  document.addEventListener('DOMContentLoaded', () => {
    console.log('DOMContentLoaded 発火！');
    

    // 要素の取得
    const modalElement = document.querySelector('.p-modal__portfolio');
    const closedButton = document.querySelector('.p-modal__close');
    let swiperInstance = null;
  
    console.log('modalElement:', modalElement);
    console.log('closedButton:', closedButton);

    // モーダル開閉中のスクロール位置（閉じ直後の謎ジャンプ防止）
    let savedScrollPosition = 0;
    let isModalScrollLocked = false;
    const MODAL_SMOOTH_DEFAULT = 1.5;

    function finishSmootherScrub(smoother) {
      const st = smoother.scrollTrigger;
      if (!st || typeof st.getTween !== 'function') return;
      const tween = st.getTween();
      if (tween) {
        // スクラブ追従を即完了（上から戻るアニメを殺す）
        tween.progress(1);
        tween.pause();
      }
    }

    function pinSmootherTo(smoother, y) {
      smoother.scrollTop(y);
      const content = typeof smoother.content === 'function' ? smoother.content() : null;
      if (content) {
        // 見た目の transform も同じ位置へ強制（smooth の遅れを消す）
        gsap.set(content, { y: -y });
      }
      finishSmootherScrub(smoother);
    }

    function lockBackgroundScroll() {
      if (!isModalScrollLocked) return;
      const smoother = ScrollSmoother.get();
      if (smoother) {
        pinSmootherTo(smoother, savedScrollPosition);
      } else if (window.scrollY !== savedScrollPosition) {
        window.scrollTo(0, savedScrollPosition);
      }
    }

    function preventBackgroundWheel(e) {
      if (!isModalScrollLocked) return;
      e.preventDefault();
    }

    function stopTouchPropagate(e) {
      e.stopPropagation();
    }

    function startModalScrollLock() {
      isModalScrollLocked = true;
      gsap.ticker.add(lockBackgroundScroll);
      document.addEventListener('wheel', preventBackgroundWheel, { passive: false });
      if (modalElement) {
        modalElement.addEventListener('touchmove', stopTouchPropagate, { passive: true });
      }
    }

    function stopModalScrollLock() {
      isModalScrollLocked = false;
      gsap.ticker.remove(lockBackgroundScroll);
      document.removeEventListener('wheel', preventBackgroundWheel);
      if (modalElement) {
        modalElement.removeEventListener('touchmove', stopTouchPropagate);
      }
    }

    function restoreScrollPosition() {
      const smoother = ScrollSmoother.get();
      if (!smoother) {
        document.body.style.overflow = '';
        window.scrollTo(0, savedScrollPosition);
        return;
      }

      // smooth=0 のまま見た目も位置も固定してから overflow 解除
      if (typeof smoother.smooth === 'function') {
        smoother.smooth(0);
      }
      pinSmootherTo(smoother, savedScrollPosition);
      document.body.style.overflow = '';
      pinSmootherTo(smoother, savedScrollPosition);

      let frames = 0;
      const holdPosition = () => {
        pinSmootherTo(smoother, savedScrollPosition);
        frames += 1;
        if (frames < 12) {
          requestAnimationFrame(holdPosition);
          return;
        }

        // smooth を戻した直後にスクラブが走るので、即座に完了させてジャンプを潰す
        if (typeof smoother.smooth === 'function') {
          smoother.smooth(MODAL_SMOOTH_DEFAULT);
        }
        pinSmootherTo(smoother, savedScrollPosition);
        finishSmootherScrub(smoother);

        requestAnimationFrame(() => {
          pinSmootherTo(smoother, savedScrollPosition);
          finishSmootherScrub(smoother);
          requestAnimationFrame(() => {
            pinSmootherTo(smoother, savedScrollPosition);
            finishSmootherScrub(smoother);
          });
        });
      };
      requestAnimationFrame(holdPosition);
    }

    // Swiper を初回モーダルオープン時だけ読み込む
    let swiperAssetsPromise = null;
    function loadSwiperAssets() {
      if (typeof Swiper !== 'undefined') {
        return Promise.resolve();
      }
      if (swiperAssetsPromise) {
        return swiperAssetsPromise;
      }

      const cssUrl = (typeof wpData !== 'undefined' && wpData.swiperCss)
        ? wpData.swiperCss
        : '/wp-content/themes/portfolio/css/swiper-bundle.css';
      const jsUrl = (typeof wpData !== 'undefined' && wpData.swiperJs)
        ? wpData.swiperJs
        : '/wp-content/themes/portfolio/js/swiper-bundle.min.js';

      swiperAssetsPromise = new Promise((resolve, reject) => {
        if (!document.querySelector('link[data-swiper-css]')) {
          const link = document.createElement('link');
          link.rel = 'stylesheet';
          link.href = cssUrl;
          link.setAttribute('data-swiper-css', 'true');
          document.head.appendChild(link);
        }

        const script = document.createElement('script');
        script.src = jsUrl;
        script.async = true;
        script.onload = () => resolve();
        script.onerror = () => reject(new Error('Swiper の読み込みに失敗しました'));
        document.body.appendChild(script);
      });

      return swiperAssetsPromise;
    }
  
    // モーダルデータ（中身は src/portfolio-data.js）
    const themeUri = (typeof wpData !== 'undefined' && wpData.themeUri)
      ? wpData.themeUri
      : '/wp-content/themes/portfolio/';
    const portfolioDataMap = createPortfolioDataMap(themeUri);

    function getWorksKeyFromImg(img) {
      const src = img.currentSrc || img.getAttribute('src') || '';
      const file = src.split('/').pop().split('?')[0];
      return file
        .replace(/\.[^.]+$/, '')
        .replace(/-\d+x\d+$/, '')
        .replace(/-scaled$/, '');
    }
  
    // =================================
    // モーダルを開く処理
    // =================================
    async function openModal(worksKey) {
      console.log('モーダルを開く処理開始:', worksKey);
      
      const portfolioData = portfolioDataMap[worksKey];
      if (!portfolioData) {
        console.error('指定されたキーのデータが存在しません:', worksKey);
        return;
      }

      try {
        await loadSwiperAssets();
      } catch (error) {
        console.error(error);
        return;
      }
  
      // 見た目の位置を保存し、smooth を切って transform ごと固定する
      const smoother = ScrollSmoother.get();
      if (smoother) {
        const content = typeof smoother.content === 'function' ? smoother.content() : null;
        const visualY = content ? gsap.getProperty(content, 'y') : 0;
        // smooth の遅れ分も含め、画面に見えている位置を保存
        savedScrollPosition = typeof visualY === 'number' ? -visualY : smoother.scrollTop();
        if (typeof smoother.smooth === 'function') {
          smoother.smooth(0);
        }
        pinSmootherTo(smoother, savedScrollPosition);
      } else {
        savedScrollPosition = window.scrollY;
        document.body.style.position = 'fixed';
        document.body.style.top = `-${savedScrollPosition}px`;
        document.body.style.left = '0';
        document.body.style.width = '100%';
      }
      document.body.style.overflow = 'hidden';
      startModalScrollLock();
  
      // スライドコンテンツを作成
      const wrapper = document.querySelector('.swiper-wrapper');
      if (!wrapper) {
        console.error('swiper-wrapper が見つかりません');
        return;
      }
      
      wrapper.innerHTML = ''; // 前回分をクリア
  
      portfolioData.forEach(data => {
        const slide = document.createElement('div');
        slide.classList.add('swiper-slide');
        slide.innerHTML = `
          <img src="${data.img}" alt="${data.title}" style="width: 100%; height: auto;">
          <h3 style="text-align: center; margin-top: 10px;">${data.title}</h3>
        `;
        wrapper.appendChild(slide);
      });
  
      // 既存のSwiperインスタンスを破棄
      if (swiperInstance) {
        swiperInstance.destroy(true, true);
        swiperInstance = null;
      }
  
      // モーダルを表示
      modalElement.classList.remove('is-close');
      modalElement.classList.add('is-open');
  
      // Swiperを初期化（少し遅延させる）
      // トラックパッドは横スワイプ(deltaX)のみ反応。縦慣性で戻るのを防ぐ
      setTimeout(() => {
        swiperInstance = new Swiper(".swiper", {
          loop: false,
          initialSlide: 0,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          slidesPerView: 1,
          autoHeight: false,
          preventInteractionOnTransition: true,
          mousewheel: {
            forceToAxis: true,
            sensitivity: 1,
            thresholdDelta: 40,
            thresholdTime: 400,
          },
          on: {
            init: function() {
              console.log('Swiper 初期化成功！');
              this.update();
            },
          },
        });
      }, 50); // 50ms後に初期化
    }
  
    // =================================
    // モーダルを閉じる処理
    // =================================
    function closeModal() {
      console.log('モーダルを閉じる処理開始');
      
      // モーダルを非表示（スクロール解除はアニメ完了後。ロックは維持）
      modalElement.classList.remove('is-open');
  
      // アニメーション完了後にクリーンアップ
      setTimeout(() => {
        // Swiperインスタンスを破棄
        if (swiperInstance) {
          swiperInstance.destroy(true, true);
          swiperInstance = null;
        }
        
        // スライドコンテンツをクリア
        const wrapper = document.querySelector('.swiper-wrapper');
        if (wrapper) {
          wrapper.innerHTML = '';
        }

        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.width = '';

        // overflow 解除と ScrollSmoother 再開は restore 内で行う
        stopModalScrollLock();
        restoreScrollPosition();
        
      }, 400); // CSSのtransition時間と合わせる
    }
  
    // =================================
    // イベントリスナーの設定
    // =================================
    
    // モーダルを開くトリガー（ファイル名キーで紐付け。data-index は不要）
    document.querySelectorAll('.is-style-works-image img').forEach((item) => {
      console.log('クリックイベント登録:', item);
      
      item.addEventListener('click', (e) => {
        e.preventDefault();
        
        const key = getWorksKeyFromImg(item);
        console.log('クリックされました。キー:', key);
        
        if (!key || !portfolioDataMap[key]) {
          console.error('対応するモーダルデータがありません:', key, item);
          return;
        }
        
        openModal(key);
      });
    });
  
    // 閉じるボタンのイベント
    if (closedButton) {
      closedButton.addEventListener('click', closeModal);
    } else {
      console.error('閉じるボタンが見つかりません');
    }
  
    // 背景クリックで閉じる
    if (modalElement) {
      modalElement.addEventListener('click', (e) => {
        // モーダルの背景部分をクリックした場合のみ閉じる
        if (e.target === modalElement) {
          closeModal();
        }
      });
    }
  
    // ESCキーで閉じる
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modalElement.classList.contains('is-open')) {
        closeModal();
      }
    });
  
    console.log('モーダル機能の初期化完了');
  });
