import React, { useContext, useEffect, useState } from 'react';
import Fade from 'react-reveal/Fade';
import Tilt from 'react-tilt';
import { Container, Row, Col } from 'react-bootstrap';
import PortfolioContext from '../../context/context';
import Title from '../Title/Title';
import ProjectImg from '../../assets/Image/ProjectImg';

const Agenda = () => {
  const { agenda } = useContext(PortfolioContext);

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


  }, []);

  return (
   
      <section id="agenda">
      <Container>
      <div className="agenda-head has-border">
        <img class="agenda-icon" src="https://image.ibb.co/gpBreT/basic_alarm.png" alt="Alarm Icon" />
        <h2>&nbsp;AGENDA</h2>
      </div>

      <h2 class="agenda-subheading">• Jadwal Sidang •
      <br /> • Komisi Informasi Provinsi Sumatera Barat • 
      <br />{date.getDate()} {date.getMonth()} {date.getFullYear()} 
      <br />Auditorium</h2>
      <div class="events-container">
        <div class="event-hours-container">
          <p class="event-hours">8:00 AM</p>
          <p class="event-hours">8:30 AM</p>
          <p class="event-hours">9:00 AM - 12:00 AM</p>
          <p class="event-hours">12:30 PM - 1:30 PM</p>
          <p class="event-hours">1:30 PM - 5:30 PM</p>
          <p class="event-hours">5:00 PM</p>
          <p class="event-hours">6:00 PM - 9:00 PM</p>
          <p class="event-hours">9:00 PM</p>
          <p class="event-hours">7:30 PM - 9:00 PM</p>
        </div>

        <div class="event-title-container">
          <p class="event-title">Sidang Awal</p>
          <p class="event-title">Mediasi</p>
          <p class="event-title">Sidang ke2</p>
          <p class="event-title">Sidang ke3</p>
          <p class="event-title">Sidang ke4</p>
          <p class="event-title">Sidang ke5</p>
          <div class="featured-event">

            <img class="event-icon" src="https://image.ibb.co/frOF68/basic_todo_txt.png" alt="" />

            <p class="feat-event-heading">The Conference talks</p>
            <p class="feat-event">Oh dear! She's stuck in an infinite loop, and he's an idiot! Well, that's love for you. Uhh… also, comes with double prize money. It doesn't look so shiny to me.</p>
          </div>
          <p class="event-title">Kegiatan ke1</p>
          <p class="event-title">Kegiatan ke2</p>
        </div>
      </div>
      </Container>
    </section>
      );
};

export default Agenda;
