import React from 'react';
import { Helmet } from 'react-helmet';
import Intro from '../components/Intro';
import { headData } from '../mock/data';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../style/main.scss';

const Default = () => {
  const { title, lang, description } = headData;

  return (
    <>
      <Helmet>
        <meta charSet="utf-8" />
        <title>{title || 'Komisi Informasi Sumatera Barat'}</title>
        <html lang={lang || 'en'} />
        <meta name="description" content={description || 'Komisi Informasi Sumatera Barat'} />
      </Helmet>
      <Intro />
    </>
  );
};
export default Default; 