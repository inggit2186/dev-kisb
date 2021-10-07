import React, { useState, useEffect } from 'react';
import Header from './Header/Header';
import Hero from './Hero/Hero';
import About from './About/About';
import Agenda from './Projects/Projects';
import Contact from './Contact/Contact';
import Footer from './Footer/Footer';

import { PortfolioProvider } from '../context/context';

import { headerData, heroData, aboutData, agendaData, contactData, footerData } from '../mock/data';

function App() {
  const [header, setHeader] = useState({});
  const [hero, setHero] = useState({});
  const [about, setAbout] = useState({});
  const [agenda, setAgenda] = useState({});
  const [contact, setContact] = useState({});
  const [footer, setFooter] = useState({});

  useEffect(() => {
    setHeader({ ...headerData});
    setHero({ ...heroData });
    setAbout({ ...aboutData });
    setAgenda([...agendaData]);
    setContact({ ...contactData });
    setFooter({ ...footerData });
  }, []);

  return (
    <PortfolioProvider value={{ header, hero, about, agenda, contact, footer }}>
      <Header />
      <Hero />
      <About />
      <Agenda />
      <Contact />
      <Footer />
    </PortfolioProvider>
  );
}

export default App;
