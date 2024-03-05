import React from 'react';

const Carrito = () => {
  // Obtener los productos del carrito desde la variable de sesión
  const carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

  return (
    <div className="container">
      <h1 className="my-4">Carrito</h1>
      <div className="row">
        {carrito.map(product => (
          <div key={product.id} className="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div className="card h-100">
              <img src={product.imagen} className="card-img-top" alt={product.nombre} />
              <div className="card-body">
                <h5 className="card-title">{product.nombre}</h5>
                <h6 className="card-subtitle mb-2 text-muted">Precio: {product.precio}$</h6>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Carrito;
