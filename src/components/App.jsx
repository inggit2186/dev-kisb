import React, { useState, useEffect } from 'react';
import Header from './Header/Header';
import Top from './Top/Top';
import About from './About/About';
import Agenda from './Projects/Projects';
import News from './News/News';
import Gallery from './Gallery/Gallery';
import Contact from './Contact/Contact';
import Footer from './Footer/Footer';

import { PortfolioProvider } from '../context/context';

import { headerData, topData, aboutData, agendaData, newsData, galleryData, contactData, footerData } from '../mock/data';

function App() {
  const [header, setHeader] = useState({});
  const [top, setTop] = useState({});
  const [about, setAbout] = useState({});
  const [agenda, setAgenda] = useState([]);
  const [news, setNews] = useState({});
  const [gallery, setGallery] = useState({});
  const [contact, setContact] = useState({});
  const [footer, setFooter] = useState({});

  useEffect(() => {
    setHeader({ ...headerData});
    setTop({ ...topData });
    setAbout({ ...aboutData });
    setAgenda([...agendaData]);
    setNews({...newsData});
    setGallery({...galleryData});
    setContact({ ...contactData });
    setFooter({ ...footerData });
  }, []);

  return (
    <PortfolioProvider value={{ header, top, about, agenda, news, gallery, contact, footer }}>
      <Header />
      <Top />
      <About />
      <Agenda />
      <News />
      <Gallery />
      <Contact />
      <Footer />
    </PortfolioProvider>
  );
}

export default App;
