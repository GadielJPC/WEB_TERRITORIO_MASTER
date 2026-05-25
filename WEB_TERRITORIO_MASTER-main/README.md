<p align="center">
  <img src="./MasterMedic/assets/images/Logoemp.png" alt="MasterMedic Logo" width="150">
</p>

> **Excelencia Médica Aplicada.** La plataforma definitiva para la gestión de formación sanitaria especializada.

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479a1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952b3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-f7df1e?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/es/docs/Web/JavaScript)

---

## 🌟 Resumen del Proyecto

**MasterMedic** es una solución web integral diseñada para centros de formación médica. Permite a las instituciones gestionar su oferta académica de másteres y cursos especializados, mientras ofrece a los potenciales alumnos una experiencia de navegación moderna, fluida y profesional para la consulta de programas y solicitud de información.

---

## 🚀 Funcionalidades Clave

### 💎 Experiencia del Usuario (Frontend)
- 📱 **Diseño Ultra-Responsive:** Navegación perfecta en móviles, tablets y escritorio gracias a Bootstrap 5.
- 🎓 **Catálogo Inteligente:** Los másteres se cargan dinámicamente desde la BD, asegurando que la información esté siempre actualizada.
- 📄 **Fichas Técnicas:** Detalle exhaustivo de cada curso (ECTS, duración, precios, programa modular).
- 📩 **Captación de Leads:** Sistema de contacto directo que almacena interesados en tiempo real.

### 🔐 Gestión Administrativa (Backend)
- 🛠️ **Panel CRUD Completo:** Crea, modifica o elimina másteres sin tocar una sola línea de código.
- 🔑 **Acceso Seguro:** Sistema de login para administradores con gestión de sesiones.
- 📊 **Base de Datos Robusta:** Estructura MySQL optimizada para escalabilidad.
- ⚡ **Actualización Instantánea:** Los cambios en el panel se reflejan en el menú y catálogo de la web pública al instante.

---

## 🛠️ Tech Stack

| Categoría | Tecnología |
| :--- | :--- |
| **Backend** | PHP (Procedural & MySQLi) |
| **Base de Datos** | MySQL |
| **Frontend** | HTML5, CSS3, JavaScript (Vanilla) |
| **Framework CSS** | Bootstrap 5.3 + Bootstrap Icons |
| **Tipografía** | Montserrat (Google Fonts) |

---

## 📁 Estructura de Carpetas

```bash
MasterMedic/
├── 📂 assets/          # Imágenes de cursos, banners y logos
├── 📂 css/             # Estilos modulares (login, cursos, styles)
├── 📂 js/              # Lógica de cliente y menús
├── 📂 pages/           # Núcleo PHP (Frontend + Admin)
│   ├── header.php      # Cabecera dinámica y conexión DB
│   ├── index.php       # Home principal
│   ├── nuevo.php       # Dashboard de administración
│   └── ...             # Controladores y vistas
└── 📄 academia.sql     # Script de despliegue de base de datos
```

---

## ⚙️ Instalación y Configuración

Sigue estos pasos para tener **MasterMedic** corriendo en menos de 2 minutos:

1.  **Preparar el entorno:** Utiliza **XAMPP** o **Laragon**.
2.  **Clonar el repo:** Copia la carpeta en `htdocs` o `www`.
3.  **Base de Datos:**
    - Abre `phpMyAdmin`.
    - Crea la DB `academia`.
    - Importa el archivo `academia.sql`.
4.  **Lanzar:** Navega a `http://localhost/MasterMedic/pages/index.php`.

### 🔑 Credenciales de Administración
> [!IMPORTANT]
> **Usuario:** `admin`  
> **Password:** `admin123`  
> *Acceso en: `pages/login.php`*

---

## 📈 Roadmap & Próximas Mejoras

- [ ] **Seguridad Pro:** Implementar `password_hash()` y sentencias preparadas (Prepared Statements).
- [ ] **Arquitectura:** Centralizar conexión en `config/db.php`.
- [ ] **UX/UI:** Añadir animaciones de carga y transiciones suaves (AOS Library).
- [ ] **SEO:** Generar URLs amigables mediante `.htaccess`.
- [ ] **Módulos:** Completar la integración del *Aula Virtual*.

---

## 📬 Contacto & Autor

**MasterMedic** es un proyecto enfocado a la digitalización del sector salud.

- **Nombre del Proyecto:** MasterMedic
- **Tipo:** Académico / Profesional
- **Estado:** 🟢 Funcional / En mejora continua

---
Developed with ❤️ for the Medical Community.
