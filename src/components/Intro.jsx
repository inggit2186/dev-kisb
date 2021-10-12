import React, { useState, useEffect } from 'react';
import Hero from './Hero/Hero';

import { PortfolioProvider } from '../context/context';

import  { heroData } from '../mock/data';

function Intro() {
  const [hero, setHero] = useState({});

  useEffect(() => {
    setHero({ ...heroData });
  }, []);

  return (
    <PortfolioProvider value={{ hero }}>
      <Hero />
    </PortfolioProvider>
  );
}

export default Intro;