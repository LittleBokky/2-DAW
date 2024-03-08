import React from 'react';
import Carousel from 'react-bootstrap/Carousel';

function Carrusel() {
  return (
    <div style={{ margin: '20px 0' }}>
      <Carousel>
        <Carousel.Item>
          <img
            className="d-block w-100 rounded"
            src="https://www.diariodejerez.es/2023/04/29/motos-jerez/gp-jerez/Carrera-spring-MotoGP-Jerez_1788432503_183298771_1920x1080.jpg"
            style={{ maxHeight: '575px', objectFit: 'cover', boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)' }} // Ajusta el tamaño de la imagen y añade sombreado
          />
        </Carousel.Item>
        <Carousel.Item>
          <img
            className="d-block w-100 rounded"
            src="https://www.diariodejerez.es/2023/05/01/galerias_graficas/Fotos-MotoGP-Circuito-Jerez-Angel_1789031080_183374160_1920x1080.jpg"
            style={{ maxHeight: '575px', objectFit: 'cover', boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)' }} // Ajusta el tamaño de la imagen y añade sombreado
          />
        </Carousel.Item>
        <Carousel.Item>
          <img
            className="d-block w-100 rounded"
            src="https://img.remediosdigitales.com/f6bcff/jerez-motogp/1366_2000.jpeg"
            style={{ maxHeight: '575px', objectFit: 'cover', boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)' }} // Ajusta el tamaño de la imagen y añade sombreado
          />
        </Carousel.Item>
      </Carousel>
    </div>
  );
}

export default Carrusel;
