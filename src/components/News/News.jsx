import React, { useContext, useState, useEffect } from 'react';
import { Container } from 'react-bootstrap';
import Fade from 'react-reveal/Fade';
import { Link } from 'react-scroll';
import PortfolioContext from '../../context/context';

const News = () => {

  const { news } = useContext(PortfolioContext);
  const { date, title, intro, img, isi, tag } = news;

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
  }, []);

  return (
        <section id="news">
        <div className="about-head has-border">
          <h2>&nbsp;BERITA TERBARU</h2>
        </div>
        
        <div className="wrapper">
        <Fade top duration={1000} delay={800} distance="30px">
        <div className="news-item hero-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 1000px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/divinity-small.jpg" />
                <source media="(min-width: 1100px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/divinity-medium.png" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/divinity-small.jpg" alt="Divinity" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Review</span>
              <h1 className="title">Divinity: Original Sin 2 is awesome</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 599px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/re7-chris-large.jpg" />
                <source media="(min-width: 600px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/re7-chris-small.jpg" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/re7-chris-large.jpg" alt="Resident Evil 7" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Featured</span>
              <h1 className="title">Resident Evil 7: Scarier than ever</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 599px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/bioshock-large.jpg" />
                <source media="(min-width: 600px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/bioshock-small.jpg" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/bioshock-large.jpg" alt="Bioshock 2" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Guide</span>
              <h1 className="title">Bioshock 2: Tactics on killing Big Sisters</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 1000px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/lara-small.jpg" />
                <source media="(min-width: 1100px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/lara-medium.jpg" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/lara-small.jpg" alt="Tomb Raider" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Adventure</span>
              <h1 className="title">Tomb Raider: The reincarnation of Lara Croft</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        </Fade>

        <Fade bottom duration={1000} delay={800} distance="30px">
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 1000px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/dishonored-small.jpg" />
                <source media="(min-width: 1100px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/dishonored-2-medium.jpg" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/dishonored-small.jpg" alt="Dishonored 2" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Stealth</span>
              <h1 className="title">Dishonored 2: Creative Kills have never look so good</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/infinite-small.jpg" alt="Bioshock Infinite" className="responsive-img" />
            </div>
            <div className="caption">
              <span className="tag">First person shooter</span>
              <h1 className="title">Bioshock Infinite: Colorful instead of morbid</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 599px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/trine-2-large.png" />
                <source media="(min-width: 600px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/trine-2-small.png" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/trine-2-large.png" alt="Trine 2" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Review</span>
              <h1 className="title">Trine 2: Entertaining &amp; Funny</h1>
              <span className="author">by Ren Aysha</span>
            </div> 
          </div>
        </div>
        <div className="news-item standard-item">
          <div className="thumbnail">
            <div className="image-wrapper">
              <picture>
                {/*[if IE 9]><video style="display: none;"><![endif]*/}
                <source media="(max-width: 1000px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/wild-hunt-small.jpg" />
                <source media="(min-width: 1100px)" srcSet="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/wild-hunt-medium.jpg" />
                {/*[if IE 9]></video><![endif]*/}
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/53819/wild-hunt-small.jpg" alt="Witcher 3: Wild Hunt" className="responsive-img" />
              </picture>
            </div>
            <div className="caption">
              <span className="tag">Adventure</span>
              <h1 className="title">Witcher 3: Blood and Wine</h1>
              <span className="author">by Ren Aysha</span>
            </div>
          </div>
        </div>
        </Fade>
      </div>
      </section>
  );
}

export default News;