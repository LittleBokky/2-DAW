// Inicio.jsx
import React from 'react';
import Navbar from '../componentes/navbar';
import UncontrolledExample from '../componentes/Carousel';
import { Carousel } from 'bootstrap';
import Carrusel from '../componentes/Carousel';
import '../App.css';

const Inicio = () => {
  return (
    <div className="container-fluid mt-5">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <div className="card p-4 text-center">
            <h1 className='mt-4'>¡Ha vuelto MotoGP Jerez!</h1>
            <Carrusel />
            <h4>El Circuito de Jerez presenta una vez más uno de los grandes premios más esperados del mundo. El Gran Premio de España de MotoGP, la competición más importante a nivel universal en cuanto a carreras del motociclismo.</h4>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Inicio;
