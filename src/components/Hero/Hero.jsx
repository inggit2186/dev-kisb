import React, { useContext, useState, useEffect } from 'react';
import { Container } from 'react-bootstrap';
import Fade from 'react-reveal/Fade';
import { Link } from 'gatsby';
import PortfolioContext from '../../context/context';
import endwalker from '../../assets/video/endwalker.mp4';

import AniLink from "gatsby-plugin-transition-link/AniLink";

const Header = () => {
  const { hero } = useContext(PortfolioContext);
  const { title, name, subtitle, cta } = hero;

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
    <section id="hero" className="jumbotron">
      
      <video id="background-video" loop autoPlay muted>
        <source src={endwalker} type="video/mp4" />
        Your browser does not support the video tag.
      </video>
      

      <Container>
        <Fade left={isDesktop} bottom={isMobile} duration={1000} delay={500} distance="30px">
          <h1 className="hero-title">
            {title || 'Selamat datang di Website'}{' '}<br />
            <span className="text-color-main">{name || 'Komisi Informasi'}</span>
            <br />
            {subtitle || "Provinsi Sumatera Barat"}
          </h1>
        </Fade>
        <Fade left={isDesktop} bottom={isMobile} duration={1000} delay={1000} distance="30px">
          <p className="hero-cta">
            <span className="cta-btn cta-btn--hero">
              <AniLink paintDrip to='../home' duration={1}>
                {cta || 'Selengkapnya..'}
              </AniLink>
            </span>
          </p>
        </Fade>
      </Container>
    </section>
  );
};

export default Header;
