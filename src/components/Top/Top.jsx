import React, { useContext, useState, useEffect } from 'react';
import { Container } from 'react-bootstrap';
import Fade from 'react-reveal/Fade';
import { Link } from 'react-scroll';
import PortfolioContext from '../../context/context';

const Top = () => {
  const { top } = useContext(PortfolioContext);
  const { title, date, intro } = top;

  const [isDesktop, setIsDesktop] = useState(false);
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    if (window.innerWidth > 769) {
      setIsDesktop(true);
      setIsMobile(false);
    } else {
      setIsMobile(true);
      setIsDesktop(false);
    }
    
    let mainPosts = document.querySelectorAll(".main-post");
    let posts = document.querySelectorAll(".post");

    let i = 0;
    let postIndex = 0;
    let currentPost = posts[postIndex];
    let currentMainPost = mainPosts[postIndex];

    setInterval(progress, 100); // 180

    function progress() {
      if (i === 100) {
        i = -5;
        // reset progress bar
        console.log(currentPost);
        currentPost.querySelector(".progress-bar__fill").style.width = 0;
        document.querySelector(
          ".progress-bar--primary .progress-bar__fill"
        ).style.width = 0;
        currentPost.classList.remove("post--active");

        postIndex++;

        currentMainPost.classList.add("main-post--not-active");
        currentMainPost.classList.remove("main-post--active");

        // reset postIndex to loop over the slides again
        if (postIndex === posts.length) {
          postIndex = 0;
        }

        currentPost = posts[postIndex];
        currentMainPost = mainPosts[postIndex];
      } else {
        i++;
        currentPost.querySelector(".progress-bar__fill").style.width = `${i}%`;
        document.querySelector(
          ".progress-bar--primary .progress-bar__fill"
        ).style.width = `${i}%`;
        currentPost.classList.add("post--active");

        currentMainPost.classList.add("main-post--active");
        currentMainPost.classList.remove("main-post--not-active");
      }
    }
  }, []);

  return (
    <section id="top" className="jumbotron">
      <div className="rela-block2 top-section grad-back" id="topSection">
        <div className="carouselx">
          <div className="progress-bar2 progress-bar--primary hide-on-desktop">
            <div className="progress-bar__fill" />
          </div>
          <header className="main-post-wrapper">
            <div className="slides">
              <article className="main-post main-post--active">
                <div className="main-post__image">
                  <img src="https://www.formula1.com/content/dam/fom-website/manual/Misc/2019-Races/Monaco2019/McLarenMonaco19.jpg.transform/9col/image.jpg" alt="New McLaren wind tunnel 'critical' to future performance, says Tech Director Key" />
                </div>
                <div className="main-post__content">
                  <div className="main-post__tag-wrapper">
                    <span className="main-post__tag">KAtegori</span>
                  </div>
                  <h1 className="main-post__title">Berita Hari Ini 1</h1>
                  <a className="main-post__link" href="/">
                    <span className="main-post__link-text">Baca Selengkapnya</span>
                    <svg className="main-post__link-icon main-post__link-icon--arrow" width={37} height={12} viewBox="0 0 37 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 6H36.0001M36.0001 6L31.0001 1M36.0001 6L31.0001 11" stroke="white" />
                    </svg>
                  </a>
                </div>
              </article>
              <article className="main-post main-post--not-active">
                <div className="main-post__image">
                  <img src="https://www.formula1.com/content/dam/fom-website/sutton/2019/Hungary/Saturday/1017645792-LAT-20190803-_2ST5188.jpg.transform/9col-retina/image.jpg" alt="What To Watch For in the 2019 Hungarian Grand Prix" />
                </div>
                <div className="main-post__content">
                  <div className="main-post__tag-wrapper">
                    <span className="main-post__tag">Kategori 2</span>
                  </div>
                  <h1 className="main-post__title">Berita Hari ini 2</h1>
                  <a className="main-post__link" href="/">
                    <span className="main-post__link-text">Baca Selengkapnya</span>
                    <svg className="main-post__link-icon main-post__link-icon--arrow" width={37} height={12} viewBox="0 0 37 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 6H36.0001M36.0001 6L31.0001 1M36.0001 6L31.0001 11" stroke="white" />
                    </svg>
                  </a>
                </div>
              </article>
              <article className="main-post main-post--not-active">
                <div className="main-post__image">
                  <img src="https://www.formula1.com/content/dam/fom-website/manual/Misc/2019-Races/Austria-2019/Top3Austria2019.jpg.transform/9col-retina/image.jpg" alt="Hamilton wants harder championship fight from Leclerc and
            Verstappen" />
                </div>
                <div className="main-post__content">
                  <div className="main-post__tag-wrapper">
                    <span className="main-post__tag">Kategori 3</span>
                  </div>
                  <h1 className="main-post__title">Berita Hari ini 3
                  </h1>
                  <a className="main-post__link" href="/">
                    <span className="main-post__link-text">Baca Selengkapnya</span>
                    <svg className="main-post__link-icon main-post__link-icon--arrow" width={37} height={12} viewBox="0 0 37 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 6H36.0001M36.0001 6L31.0001 1M36.0001 6L31.0001 11" stroke="white" />
                    </svg>
                  </a>
                </div>
              </article>
            </div>
          </header>
          <div className="posts-wrapper hide-on-mobile">
            <article className="post post--active">
              <div className="progress-bar2">
                <div className="progress-bar__fill" />
              </div>
              <header className="post__header">
                <span className="post__tag">Kategori 1</span>
                <p className="post__published">12 Januari 1992</p>
              </header>
              <h2 className="post__title">Berita Hari ini 1</h2>
            </article>
            <article className="post">
              <div className="progress-bar2">
                <div className="progress-bar__fill" />
              </div>
              <header className="post__header">
                <span className="post__tag">Kategori 2</span>
                <p className="post__published">13 Januari 1992</p>
              </header>
              <h2 className="post__title">Berita hari ini 2</h2>
            </article>
            <article className="post">
              <div className="progress-bar2">
                <div className="progress-bar__fill" />
              </div>
              <header className="post__header">
                <span className="post__tag">Kategori 3</span>
                <p className="post__published">14 Januari 2992</p>
              </header>
              <h2 className="post__title">Berita Hari ini 3
              </h2>
            </article>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Top;