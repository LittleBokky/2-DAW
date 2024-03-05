import React, { useState } from 'react';
import Navbar from '../componentes/navbar';

const Login = () => {
  // Definimos el estado para almacenar el nombre de usuario y la contraseña
  const [formData, setFormData] = useState({
    username: '',
    password: ''
  });

  // Función para manejar el cambio en los campos del formulario
  const handleChange = e => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  // Función para manejar el envío del formulario
  const handleSubmit = async e => {
    e.preventDefault();
    try {
      const response = await fetch(`http://localhost:3001/users?username=${formData.username}&password=${formData.password}`);
      if (response.ok) {
        const data = await response.json();
        if (data.length > 0) {
          // Almacenar los datos del usuario en variables de sesión
          sessionStorage.setItem('loggedIn', true);
          sessionStorage.setItem('username', formData.username);
          window.location.href = '/'; // Redirigir al usuario a la página principal
        } else {
          alert('Usuario o contraseña incorrectos');
        }
      } else {
        throw new Error('Error al iniciar sesión');
      }
    } catch (error) {
      console.error(error);
      alert('Error al iniciar sesión');
    }
  };

  return (
    <div>
      <div className="container">
        <h1>Iniciar Sesión</h1>
        <p>Ingresa tus credenciales para iniciar sesión.</p>
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label htmlFor="username">Nombre de usuario</label>
            <input
              type="text"
              className="form-control"
              id="username"
              name="username"
              value={formData.username}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group">
            <label htmlFor="password">Contraseña</label>
            <input
              type="password"
              className="form-control"
              id="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required
            />
          </div>
          <button type="submit" className="btn btn-primary">Iniciar Sesión</button>
        </form>
      </div>
    </div>
  );
};

export default Login;
