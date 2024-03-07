import React, { useState } from 'react';
import './Login.css'; // Importa el archivo CSS para los estilos del formulario
import Swal from 'sweetalert2'; // Importa SweetAlert

const Login = () => {
  const [formData, setFormData] = useState({
    username: '',
    password: ''
  });

  const handleChange = e => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      const response = await fetch(`http://localhost:3001/users?username=${formData.username}&password=${formData.password}`);
      if (response.ok) {
        const data = await response.json();
        if (data.length > 0) {
          sessionStorage.setItem('loggedIn', true);
          sessionStorage.setItem('username', formData.username);
          // Mostrar alerta de inicio de sesión exitoso con SweetAlert
          Swal.fire({
            title: "¡Inicio de sesión exitoso!",
            text: `¡Bienvenido ${formData.username}!`,
            icon: "success"
          });
          // Esperar 2 segundos antes de redirigir al usuario al inicio
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        } else {
          Swal.fire({
            title: '¡Datos incorrectos!',
            text: `Usuario y/o contraseña incorrectos`,
            icon: 'error',
            confirmButtonText: 'OK'
          });
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
    <div className="login-container">
      <div className="login-box">
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
          <button type="submit" className="btn btn-danger">Iniciar Sesión</button>
        </form>
      </div>
    </div>
  );
};

export default Login;
