import React, { useContext, useState, useEffect } from 'react';
import Fade from 'react-reveal/Fade';
import { Container, Row, Col } from 'react-bootstrap';
import Title from '../Title/Title';
import AboutImg from '../../assets/Image/AboutImg';
import PortfolioContext from '../../context/context';

import aboutImg from '../../assets/images/about.png'
import tugasImg from '../../assets/images/tugas.png'
import wewenangImg from '../../assets/images/wewenang.png'
import visiImg from '../../assets/images/visi.jpg'
import misiImg from '../../assets/images/misi.png'

const About = () => {
  const { about } = useContext(PortfolioContext);
  const { img, paragraphOne, paragraphTwo, paragraphThree, resume } = about;

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
    <section id="about">
        <div className="about-head has-border">
          <h2>&nbsp;PROFIL</h2>
        </div>
        <div className="main-speaker">
        <Fade left duration={1000} delay={800} distance="30px">
          <div className="main-speaker-img-container">
            <img src={aboutImg} alt="Tentang KI" />
          </div>
          </Fade>
          <Fade right duration={1000} delay={800} distance="30px">
          <div className="main-speaker-info">
            <h3>Tentang Komisi Informasi</h3>
            <p>Komisi Informasi adalah Lembaga Negara yang menjalankan <b>Undang-Undang no. 14 tahun 2008</b> tentang <b>Keterbukaan Informasi Publik</b> dan peraturan Pelaksanaannya.
            <br />Menetapkan petunjuk teknis standar layanan Informasi Publik.
            <br />Dan Menyelesaikan Sengketa Informasi Publik melalui Mediasi dan/atau Ajudikasi non-litigasi.</p>
            <span className="tip1" />
          </div>
          </Fade>
        </div>

        <Fade left duration={1000} delay={800} distance="30px">
        <div className="speakers-container">
          <div className="speaker">
            <div className="speaker-img-container">
              <img src={tugasImg} alt="Tugas KI" />
            </div>
            <div className="speaker-info">
              <h3>Tugas</h3>
              <div className="flip">
               <p>Komisi Informasi Mempunyai Tugas sebagai berikut : </p>
               <p>Menerima, memeriksa, dan memutus permohonan penyelesaian Sengketa Informasi Publik melalui Mediasi dan/atau Ajudikasi non-litigasi yang diajukan oleh setiap Pemohon Informasi Publik</p>
               <p>berdasarkan alasan sebagaimana dimaksud dalam Undang-Undang Keterbukaan Informasi.</p> 
               <p>Menetapkan kebijakan umum pelayanan Informasi Publik.</p> 
               <p>Menetapkan petunjuk pelaksanaan dan petunjuk teknis.</p>
               <p>Dan lain sebagainya yang masih dalam ruang lingkup <b>Undang-Undang no:14</b> tahun <b>2008</b></p>
              </div>
              <span className="tip2" />
            </div>
          </div>
          <div className="speaker">
            <div className="speaker-img-container">
              <img src={wewenangImg} alt="Wewenang KI" />
            </div>
            <div className="speaker-info">
              <h3>Wewenang</h3>
              <div className="flip">
               <p>Komisi Informasi Mempunyai Wewenang sebagai berikut : </p>
               <p>Memanggil dan/atau mempertemukan para pihak yang bersengketa,</p>
               <p>Meminta catatan atau bahan yang relevan yang dimiliki oleh Badan Publik terkait untuk mengambil keputusan dalam upaya menyelesaikan Sengketa Informasi Publik,</p> 
               <p>Meminta keterangan atau menghadirkan pejabat Badan Publik ataupun pihak yang terkait sebagai saksi dalam penyelesaian Sengketa Informasi Publik,</p> 
               <p>Mengambil sumpah setiap saksi yang didengar keterangannya dalam Ajudikasi nonlitigasi penyelesaian Sengketa Informasi Publik,</p>
               <p>Membuat kode etik yang diumumkan kepada publik sehingga masyarakat dapat menilai kinerja.</p>
              </div>
              <span className="tip3" />
            </div>
          </div>
        </div>
        </Fade>

        <Fade right duration={1000} delay={800} distance="30px">
        <div className="speakers-container">
          <div className="speaker">
            <div className="speaker-info">
              <h3>Visi</h3>
              <p>???Terwujudnya Masyarakat Informasi yang Maju, Partisipatif, dan Berkepribadian Bangsa melalui Komisi Informasi yang Mandiri dan Berkeadilan menuju Indonesia Cerdas dan Sejahtera???.</p>
                <span className="tip4" />
            </div>
            <div className="speaker-img-container">
              <img src={visiImg} alt="Visi KI" />
            </div>
          </div>
          <div className="speaker">
            <div className="speaker-info">
              <h3>Misi</h3>
              <div className="flip">
               <p>Meningkatkan kesadaran kritis masyarakat agar mampu mengakses dan menggunakan informasi secara bertanggungjawab </p>
               <p>dan aktif berpartisipasi dalam proses pembuatan serta pelaksanaan kebijakan publik dengan mengoptimalkan pemanfaatan teknologi informasi.</p>
               <p>Menguatkan kelembagaan Komisi Infomasi melalui konsolidasi, publikasi dan pendalaman wawasan, kompetensi serta distribusi tanggungjawab sesuai prinsip kesetaraan dan keadilan.</p> 
               <p>Mengoptimalkan kualitas kebijakan dan penyelesaian sengketa informasi publik dengan mengedepankan prinsip cepat, tepat waktu, biaya ringan dan sederhana.</p> 
               <p>Membangun kemitraan dengan stakeholders demi mengakselerasi masyarakat informasi menuju Indonesia cerdas dan sejahtera.</p>
               <p>Meningkatkan kapasitas dan peran badan publik agar lebih proaktif dalam memberikan pelayanan informasi publik.</p>
              </div>
              <span className="tip5" />
            </div>
            <div className="speaker-img-container">
              <img src={misiImg} alt="Misi KI" />
            </div>
          </div>
        </div>
        </Fade>
      </section>
  );
};

export default About;
