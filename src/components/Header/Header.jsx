import React, { useContext } from 'react';
import { Container } from 'react-bootstrap';
import { Link } from 'react-scroll';
import PortfolioContext from '../../context/context';
import { useEffect, useState } from 'react';

const Header = () => {

  const { header } = useContext(PortfolioContext);
  const { menu, submenu } = header;

  const [headerClassName, setHeaderClassName] = useState('');

    const handleScroll = (headerClassName) => {
        if (headerClassName !== 'nav-scrolled' && window.pageYOffset >= 100) {
            setHeaderClassName('nav-scrolled');
        } else if (headerClassName === 'nav-scrolled' && window.pageYOffset < 100) {
            setHeaderClassName('nav-default');
        }
    }

    React.useEffect(() => {
        window.onscroll = () => handleScroll(headerClassName);
    }, [headerClassName]);

  
    return (
        <div>
        <div className="menu-btn">Menu</div>
        <nav className={headerClassName} >
          <Link to="top" smooth duration={1000}>
            {menu || 'Home'}
          </Link>
          <Link to="about" smooth duration={1000}>
            {menu || 'About'}
          </Link>
          <Link to="agenda" smooth duration={1000}>
            {menu || 'Schedule'}
          </Link>
          <Link to="news" smooth duration={1000}>
            {menu || 'News'}
          </Link>
          <Link to="gallery" smooth duration={1000}>
            {menu || 'Gallery'}
          </Link>
          <Link to="footer" smooth duration={1000}>
            {menu || 'Kontak'}
          </Link>
        </nav>
      </div>
    );
}

export default Header;