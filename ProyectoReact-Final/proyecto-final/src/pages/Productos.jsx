import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';

const Productos = () => {
  // Estado para almacenar los productos
  const [products, setProducts] = useState([]);
  // Estado para indicar si el usuario ha iniciado sesión
  const [loggedIn, setLoggedIn] = useState(false);

  // Verificar si el usuario ha iniciado sesión al montar el componente
  useEffect(() => {
    const checkLoginStatus = () => {
      const userLoggedIn = sessionStorage.getItem('loggedIn');
      if (userLoggedIn) {
        setLoggedIn(true);
      }
    };

    checkLoginStatus();
  }, []);

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
    if (loggedIn) {
      const cart = JSON.parse(sessionStorage.getItem('carrito')) || [];
      cart.push(product);
      sessionStorage.setItem('carrito', JSON.stringify(cart));
      // Mostrar la alerta de agregado al carrito
      Swal.fire({
        title: 'Producto agregado',
        text: `El producto ${product.nombre} ha sido agregado al carrito.`,
        icon: 'success',
        confirmButtonText: 'OK'
      });
    } else {
      Swal.fire({
        title: '¡Inicie sesión!',
        text: `El producto ${product.nombre} no ha sido agregado porque debe iniciar sesión.`,
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
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
