import React, { useState } from "react";
import "./Usuario.css"; // Importa el archivo CSS para los estilos del formulario
import Swal from "sweetalert2"; // Importa SweetAlert

const Usuario = () => {
  // Definimos el estado para almacenar los valores del formulario
  const [formData, setFormData] = useState({
    username: "",
    password: "",
  });

  // Función para manejar el cambio en los campos del formulario
  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  // Función para manejar el envío del formulario
  const handleSubmit = async (e) => {
    e.preventDefault();
    const checkUserResponse = await fetch(
      `http://localhost:3001/users?username=${formData.username}`
    );

    const existingUser = await checkUserResponse.json();

    if (existingUser.length > 0) {
      Swal.fire({
        title: "¡Error de registro!",
        text: `El nombre de usuario "${formData.username}" ya existe`,
        icon: "error",
      });
    } else {
      try {
        const response = await fetch("http://localhost:3001/users", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        });
        if (response.ok) {
          // Mostrar alerta de registro exitoso con SweetAlert
          Swal.fire({
            title: "¡Registro exitoso!",
            text: `¡Bienvenido ${formData.username}! Usuario registrado exitosamente.`,
            icon: "success",
          });
          // Limpia los campos del formulario después del registro exitoso
          setFormData({
            username: "",
            password: "",
          });
        } else {
          throw new Error("Error al registrar usuario");
        }
      } catch (error) {
        console.error(error);
        alert("Error al registrar usuario");
      }
    }
  };

  return (
    <div className="login-container">
      <div className="login-box">
        <h1>Regístrate aquí</h1>
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
          <button type="submit" className="btn btn-danger">
            Registrarse
          </button>
        </form>
      </div>
    </div>
  );
};

export default Usuario;
