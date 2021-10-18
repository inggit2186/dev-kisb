import React, { useContext, useEffect, useState } from 'react';
import Fade from 'react-reveal/Fade';
import Tilt from 'react-tilt';
import { Container, Row, Col } from 'react-bootstrap';
import PortfolioContext from '../../context/context';
import Title from '../Title/Title';

const Gallery = () => {
  const { gallery } = useContext(PortfolioContext);

  const date = new Date();

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

    (function() {

      function init(item) {
        var items = item.querySelectorAll('li'),
            current = 0,
            autoUpdate = true,
            timeTrans = 4000;
            
        //create nav
        var nav = document.createElement('nav');
        nav.className = 'nav_arrows';
    
        //create button prev
        var prevbtn = document.createElement('button');
        prevbtn.className = 'prev';
        prevbtn.setAttribute('aria-label', 'Prev');
    
        //create button next
        var nextbtn = document.createElement('button');
        nextbtn.className = 'next';
        nextbtn.setAttribute('aria-label', 'Next');
    
        //create counter
        var counter = document.createElement('div');
        counter.className = 'counter';
        counter.innerHTML = "<span>1</span><span>"+items.length+"</span>";
    
        if (items.length > 1) {
          nav.appendChild(prevbtn);
          nav.appendChild(counter);
          nav.appendChild(nextbtn);
          item.appendChild(nav);
        }
    
        items[current].className = "current";
        if (items.length > 1) items[items.length-1].className = "prev_slide";
    
        var navigate = function(dir) {
          items[current].className = "";
    
          if (dir === 'right') {
            current = current < items.length-1 ? current + 1 : 0;
          } else {
            current = current > 0 ? current - 1 : items.length-1;
          }
    
          var	nextCurrent = current < items.length-1 ? current + 1 : 0,
            prevCurrent = current > 0 ? current - 1 : items.length-1;
    
          items[current].className = "current";
          items[prevCurrent].className = "prev_slide";
          items[nextCurrent].className = "";
    
          //update counter
          counter.firstChild.textContent = current + 1;
        }
        
        item.addEventListener('mouseenter', function() {
          autoUpdate = false;
        });
    
        item.addEventListener('mouseleave', function() {
          autoUpdate = true;
        });
    
        setInterval(function() {
          if (autoUpdate) navigate('right');
        },timeTrans);
        
        prevbtn.addEventListener('click', function() {
          navigate('left');
        });
    
        nextbtn.addEventListener('click', function() {
          navigate('right');
        });
    
        //keyboard navigation
        document.addEventListener('keydown', function(ev) {
          var keyCode = ev.keyCode || ev.which;
          switch (keyCode) {
            case 37:
              navigate('left');
              break;
            case 39:
              navigate('right');
              break;
          }
        });
    
        // swipe navigation
        // from http://stackoverflow.com/a/23230280
        item.addEventListener('touchstart', handleTouchStart, false);        
        item.addEventListener('touchmove', handleTouchMove, false);
        var xDown = null;
        var yDown = null;
        function handleTouchStart(evt) {
          xDown = evt.touches[0].clientX;
          yDown = evt.touches[0].clientY;
        };
        function handleTouchMove(evt) {
          if ( ! xDown || ! yDown ) {
            return;
          }
    
          var xUp = evt.touches[0].clientX;
          var yUp = evt.touches[0].clientY;
    
          var xDiff = xDown - xUp;
          var yDiff = yDown - yUp;
    
          if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
            if ( xDiff > 0 ) {
              /* left swipe */
              navigate('right');
            } else {
              navigate('left');
            }
          } 
          /* reset values */
          xDown = null;
          yDown = null;
        };
    
    
      }
    
      [].slice.call(document.querySelectorAll('.cd-slider')).forEach( function(item) {
        init(item);
      });
    
    })();
  }, []);

  return (
    <section id="gallery">
      <div className="about-head has-border">
          <h2>&nbsp;GALERI</h2>
      </div>
        <br />
      <div className="main">
        <div className="cd-slider">
          <ul>
            <li>
              <div className="image" style={{backgroundImage: 'url(https://images.unsplash.com/photo-1421809313281-48f03fa45e9f?crop=entropy&fit=crop&fm=jpg&h=675&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1000)'}} />
              <div className="content">
                <h2>Gallery KISB/2021-1</h2>
                <a href="#">View Gallery</a>
              </div>
            </li>
            <li>
              <div className="image" style={{backgroundImage: 'url(https://images.unsplash.com/uploads/1411724908903377d4696/2e9b0cb2?crop=entropy&fit=crop&fm=jpg&h=675&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1000)'}} />
              <div className="content">
                <h2>Gallery KISB/2021-2</h2>
                <a href="#">View Gallery</a>
              </div>
            </li>
            <li>
              <div className="image" style={{backgroundImage: 'url(https://images.unsplash.com/photo-1416838375725-e834a83f62b7?crop=entropy&fit=crop&fm=jpg&h=675&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1000)'}} />
              <div className="content">
                <h2>Gallery KISB/2021-3</h2>
                <a href="#">View Gallery</a>
              </div>
            </li>
            <li>
              <div className="image" style={{backgroundImage: 'url(https://images.unsplash.com/35/JOd4DPGLThifgf38Lpgj_IMG.jpg?crop=entropy&fit=crop&fm=jpg&h=675&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1000)'}} />
              <div className="content">
                <h2>Gallery KISB/2021-4</h2>
                <a href="#">View Gallery</a>
              </div>
            </li>
            <li>
              <div className="image" style={{backgroundImage: 'url(https://images.unsplash.com/photo-1453974336165-b5c58464f1ed?crop=entropy&fit=crop&fm=jpg&h=675&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1000)'}} />
              <div className="content">
                <h2>Gallery KISB/2021-5</h2>
                <a href="#">View Gallery</a>
              </div>
            </li>      
          </ul>
        </div> {/*/.cd-slider*/}
      </div>
    </section>
      );
};

export default Gallery;
