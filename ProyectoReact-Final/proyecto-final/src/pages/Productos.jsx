import React, { useState, useEffect } from 'react';

const Productos = () => {
  // Estado para almacenar los productos
  const [products, setProducts] = useState([]);

  // Cargar los productos al montar el componente
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch("http://localhost:3001/products");
        if (!response.ok) {
          throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        setProducts(data);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    };

    fetchData();
  }, []);

  // Función para agregar un producto al carrito
  const addToCart = (product) => {
    const cart = JSON.parse(sessionStorage.getItem('carrito')) || [];
    cart.push(product);
    sessionStorage.setItem('carrito', JSON.stringify(cart));
  };

  return (
    <div className="container">
      <h1 className="my-4">Productos</h1>
      <div className="row">
        {products.map(product => (
          <div key={product.id} className="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div className="card h-100">
              <img src={product.imagen} className="card-img-top" alt={product.nombre} />
              <div className="card-body">
                <h5 className="card-title">{product.nombre}</h5>
                <h6 className="card-subtitle mb-2 text-muted">Precio: {product.precio}$</h6>
                <button onClick={() => addToCart(product)} className="btn btn-primary">Agregar al carrito</button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Productos;
