/**
 * Works モーダル用データ（運用で追加・変更する場所）
 *
 * キー = メディアライブラリのファイル名ベース
 *   例: cocohome.webp / cocohome-1024x1024.webp → "cocohome"
 *
 * 各配列 = モーダル内スワイパーのスライド順（先頭が1枚目）
 * 画像ファイルはテーマの picture/modal/ に置く
 */
export function createPortfolioDataMap(themeUri) {
  const modal = (file) => `${themeUri}picture/modal/${file}`;

  return {
    cocohome: [
      {
        img: modal('cocohome-description.webp'),
        title: '株式会社ココホーム様の詳細',
      },
      {
        img: modal('cocohome.webp'),
        title: '株式会社ココホーム様',
      },
    ],
    kagu: [
      {
        img: modal('kagu-description.webp'),
        title: 'KAGU(架空)の詳細',
      },
      {
        img: modal('kagu.webp'),
        title: 'KAGU(架空)',
      },
    ],
    hamburger: [
      {
        img: modal('hamburger-description.webp'),
        title: 'Hamburger(架空)の詳細',
      },
      {
        img: modal('hamburger.webp'),
        title: 'Hamburger(架空)',
      },
    ],
    portfolio: [
      {
        img: modal('portfolio-description.webp'),
        title: 'Portfolioの詳細',
      },
      {
        img: modal('portfolio.webp'),
        title: 'Portfolio',
      },
    ],
    tataraportfolio: [
      {
        img: modal('tataraportfolio-description.webp'),
        title: 'tatara-portfolioの詳細',
      },
      {
        img: modal('tataraportfolio.webp'),
        title: 'tatara-portfolio',
      },
    ],
    viecreative: [
      {
        img: modal('viecreative-description.webp'),
        title: 'viecreativeの詳細',
      },
      {
        img: modal('viecreative.webp'),
        title: 'viecreative',
      },
    ],
    viedesigner: [
      {
        img: modal('viedesigner-description.webp'),
        title: 'viedesignerの詳細',
      },
      {
        img: modal('viedesigner.webp'),
        title: 'viedesigner',
      },
    ],
    knuckledown: [
      {
        img: modal('knuckledown-description.webp'),
        title: 'knuckledownの詳細',
      },
      {
        img: modal('knuckledown.webp'),
        title: 'knuckledown',
      },
    ]
  };
}
