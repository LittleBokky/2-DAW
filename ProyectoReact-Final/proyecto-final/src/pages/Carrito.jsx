import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';

const Carrito = () => {
  // Obtener los productos del carrito desde la variable de sesión
  const [carrito, setCarrito] = useState(JSON.parse(sessionStorage.getItem('carrito')) || []);

  // Función para calcular el precio total del carrito
  const calcularPrecioTotal = () => {
    let total = 0;
    carrito.forEach(producto => {
      total += producto.precio;
    });
    return total;
  };

  // Función para eliminar un producto del carrito
  const eliminarProducto = (id, nombre) => {
    const indice = carrito.findIndex(producto => producto.id === id);
    if (indice !== -1) {
      const nuevoCarrito = [...carrito];
      nuevoCarrito.splice(indice, 1);
      setCarrito(nuevoCarrito);
      sessionStorage.setItem('carrito', JSON.stringify(nuevoCarrito));
      // Mostrar la alerta de eliminación
      Swal.fire({
        title: 'Producto eliminado',
        text: `El producto ${nombre} ha sido eliminado del carrito.`,
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
  };

  return (
    <div className="container">
      <h1 className="my-4">Carrito</h1>
      <h4>Total: {calcularPrecioTotal()}€</h4> <br/>
      <div className="row">
        {carrito.map(product => (
          <div key={product.id} className="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div className="card h-100">
              <img src={product.imagen} className="card-img-top" alt={product.nombre} />
              <div className="card-body">
                <h5 className="card-title">{product.nombre}</h5>
                <h6 className="card-subtitle mb-2 text-muted">Precio: {product.precio}$</h6>
                <button onClick={() => eliminarProducto(product.id, product.nombre)} className="btn btn-danger">Eliminar del carrito</button>
              </div>
            </div>
          </div>
        ))}
      </div>
      
    </div>
  );
};

export default Carrito;
