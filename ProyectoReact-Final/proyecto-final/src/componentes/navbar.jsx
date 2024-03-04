import React from 'react';
import { Link } from 'react-router-dom';
import '../App.css';


const Navbar = () => {
  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container">
        <Link className="navbar-brand mx-4" to="/">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Moto_Gp_logo.svg/2560px-Moto_Gp_logo.svg.png" alt="Logo de MotoGP Jerez" style={{ width: '100px' }} />
        </Link>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav ml-auto">
            <li className="nav-item">
              <Link className="nav-link" to="/">Inicio</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/productos">Productos</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/acerca">Acerca</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/login">Iniciar Sesión</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/usuario">Regístrate aquí</Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;


