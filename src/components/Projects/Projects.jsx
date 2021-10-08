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
      <div className="calendar">
        <div className="timeline">
          <div className="spacer" />
          <div className="time-marker">08:00</div>
          <div className="time-marker">09:00</div>
          <div className="time-marker">10:00</div>
          <div className="time-marker">11:00</div>
          <div className="time-marker">12:00</div>
          <div className="time-marker">13:00</div>
          <div className="time-marker">14:00</div>
          <div className="time-marker">15:00</div>
          <div className="time-marker">16:00</div>
          <div className="time-marker">17:00</div>
        </div>
        <div className="days">
          <div className="day mon">
            <div className="date">
              <p className="date-num">9</p>
              <p className="date-day">Senin</p>
            </div>
            <div className="events">
              <div className="event start-9 end-11 securities">
                <p className="title">Sidang Register KI/09/21/002</p>
                <p className="time">09:00 - Selesei</p>
              </div>
            </div>
          </div>
          <div className="day tues">
            <div className="date">
              <p className="date-num">10</p>
              <p className="date-day">Selasa</p>
            </div>
            <div className="events">
              <div className="event start-11 end-13 corp-fi">
                <p className="title">Sidang Register KI/09/21/002</p>
                <p className="time">11:00 - Selesei</p>
              </div>
              <div className="event start-13 end-14 ent-law">
                <p className="title">Sidang Register KI/09/21/003</p>
                <p className="time">13:00 - Selesei</p>
              </div>
            </div>
          </div>
          <div className="day wed">
            <div className="date">
              <p className="date-num">11</p>
              <p className="date-day">Rabu</p>
            </div>
            <div className="events">
              <div className="event start-9 end-11 writing">
                <p className="title">Sidang Register KI/09/21/004</p>
                <p className="time">09:00 - Selesei</p>
              </div>
              <div className="event start-15 end-16 securities">
                <p className="title">Sidang Register KI/09/21/005</p>
                <p className="time">13:00 - Selesei</p>
              </div>
            </div>
          </div>
          <div className="day thurs">
            <div className="date">
              <p className="date-num">12</p>
              <p className="date-day">Kamis</p>
            </div>
            <div className="events">
              <div className="event start-10 end-12 corp-fi">
                <p className="title">Sidang Register KI/09/21/006</p>
                <p className="time">10:00 - Selesei</p>
              </div>
              <div className="event start-14 end-17 ent-law">
                <p className="title">Sidang Register KI/09/21/007</p>
                <p className="time">13:00 - Selesei</p>
              </div>
            </div>
          </div>
          <div className="day fri">
            <div className="date">
              <p className="date-num">13</p>
              <p className="date-day">Jum'at</p>
            </div>
            <div className="events">
            </div>
          </div>
        </div>
      </div>
      
      </Container>
    </section>
      );
};

export default Agenda;
