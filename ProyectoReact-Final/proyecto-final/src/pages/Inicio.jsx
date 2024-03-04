// Inicio.jsx
import React from 'react';
import Navbar from '../componentes/navbar';
import UncontrolledExample from '../componentes/Carousel';
import { Carousel } from 'bootstrap';
import Carrusel from '../componentes/Carousel';
import '../App.css';

const Inicio = () => {
  return (
    <div>
      <div className="container">
        <h1 className="mt-4">¡Ha vuelto MotoGP Jerez!</h1>
        <Carrusel />
        <h4>El Circuito de jerez presenta una vez más uno de los grandes premios más esperados del mundo. El Gran Premio de España de MotoGP, la competición mas importante a nivel universal en cuanto
            a carreras del motociclismo.
        </h4>
      </div>
    </div>
  );
};

export default Inicio;
