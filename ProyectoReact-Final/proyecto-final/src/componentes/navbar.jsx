import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import '../App.css';

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  const toggleNavbar = () => {
    setIsOpen(!isOpen);
  };

  // Verificar si hay una sesión iniciada
  const loggedIn = sessionStorage.getItem('loggedIn');

  // Función para cerrar sesión
  const handleLogout = () => {
    sessionStorage.clear(); // Borrar todas las variables de sesión
    window.location.href = '/'; // Redirigir a la página principal
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container">
        <Link className="navbar-brand mx-4" to="/">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Moto_Gp_logo.svg/2560px-Moto_Gp_logo.svg.png" alt="Logo de MotoGP Jerez" style={{ width: '100px' }} />
        </Link>
        <button className="navbar-toggler" type="button" onClick={toggleNavbar}>
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className={`collapse navbar-collapse ${isOpen ? 'show' : ''}`} id="navbarNav">
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
            
            {loggedIn ? (
              <>
                <li className="nav-item">
                  <button className="nav-link btn btn-link d-flex justify-content-center" onClick={handleLogout}>Cerrar Sesión</button>
                </li>
                <li className="nav-item">
                  <Link className="nav-link" to="/carrito">
                    <img src="https://static.vecteezy.com/system/resources/previews/017/196/580/non_2x/shopping-cart-icon-on-transparent-background-free-png.png" alt="Carrito" style={{ width: '40px' }} /> {/* Imagen del icono del carrito */}
                  </Link>
                </li>
              </>
            ) : (
              <>
                <li className="nav-item">
                  <Link className="nav-link" to="/login">Iniciar Sesión</Link>
                </li>
                <li className="nav-item">
                  <Link className="nav-link" to="/usuario">Regístrate aquí</Link>
                </li>
              </>
            )}
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
