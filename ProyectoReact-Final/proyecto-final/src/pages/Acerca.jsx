import React from 'react';

const Acerca = () => {
  return (
    <div className="container-fluid mt-5 d-flex justify-content-center align-items-center">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <div className="card p-4">
            <h1 className='h1acerca'>Acerca de MotoGP Jerez 2024</h1>
            <p className='pacerca'>¡Bienvenido a MotoGP Jerez 2024! Somos la plataforma oficial en línea para todo lo relacionado con el emocionante Gran Premio de Motociclismo que se llevará a cabo en el famoso Circuito de Jerez-Ángel Nieto este año.</p>
            <br />
            <h1 className='h1acerca'>Nuestra Misión</h1>
            <p className='pacerca'>En MotoGP Jerez 2024, nuestra misión es proporcionar a los fanáticos del motociclismo un destino centralizado donde puedan encontrar toda la información relevante sobre el evento, incluyendo noticias, horarios, resultados, imágenes, y mucho más. Nos esforzamos por ser la fuente más confiable y completa para los entusiastas del MotoGP que desean seguir de cerca todas las emociones y emociones de esta prestigiosa competencia.</p>
            <br />
            <h1 className='h1acerca'>Únete a la emoción</h1>
            <p className='pacerca'>Ya sea que sea un apasionado seguidor del motociclismo o simplemente esté interesado en descubrir más sobre el emocionante mundo del MotoGP, ¡MotoGP Jerez 2024 es su destino definitivo! Únase a nosotros mientras celebramos la velocidad, la habilidad y la emoción de una de las competencias más emocionantes del mundo del deporte de motor. ¡Gracias por acompañarnos en esta emocionante aventura!</p>
            <br />
            <div className="text-center">
              <img
                className="d-block rounded mx-auto" // Añade la clase mx-auto para centrar horizontalmente
                src="https://www.lavozdelsur.es/uploads/s1/40/26/0/domingo-motos-mundial-motogp88.jpeg"
                style={{ maxWidth: '80%', maxHeight: '80%' }}
                />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Acerca;
