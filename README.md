# 🏋️‍♂️ FitBoost - Sistema de Gestión de Entrenamientos y Nutrición

FitBoost es una plataforma web desarrollada en **Laravel** diseñada para automatizar la gestión de programas de acondicionamiento físico, rutinas de ejercicios, valoraciones antropométricas y planes nutricionales.

El sistema cuenta con una interfaz administrativa moderna basada en **AdminLTE** con estilos visuales tipo **Glassmorphism**.

---

# 📋 Requisitos Previos

Antes de iniciar el proyecto, asegúrate de tener instalado lo siguiente:

* **PHP** >= 8.2
* **Composer**
* **MySQL o MariaDB**
* **Node.js y NPM**
* **Git**
* Un entorno local como:

  * XAMPP
  * Laragon
  * DBngin

---

# 🚀 Instalación del Proyecto

Sigue estos pasos para ejecutar FitBoost en tu entorno local.

---

## 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/camilo522/Fitboost.git
cd Fitboost
```

---

## 2️⃣ Instalar dependencias de PHP

Instala todas las dependencias del proyecto usando Composer:

```bash
composer install
```

---

## 3️⃣ Instalar y configurar AdminLTE

El proyecto utiliza la plantilla administrativa AdminLTE.

Ejecuta los siguientes comandos:

```bash
composer require jeroennoten/laravel-adminlte
php artisan adminlte:install
```

---

## 4️⃣ Configurar el archivo `.env`

Copia el archivo de entorno:

```bash
cp .env.example .env
```

Luego abre el archivo `.env` y configura tu conexión a MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitboost
DB_USERNAME=root
DB_PASSWORD=
```

> Si utilizas XAMPP, normalmente la contraseña de MySQL está vacía.

---

## 5️⃣ Generar la clave de Laravel

```bash
php artisan key:generate
```

---

## 6️⃣ Instalar dependencias del frontend

Instala los paquetes de Node.js:

```bash
npm install
```

---

## 7️⃣ Compilar assets del proyecto

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

---

## 8️⃣ Ejecutar migraciones y seeders

Este comando:

* crea todas las tablas,
* ejecuta migraciones,
* inserta datos de prueba,
* crea usuarios iniciales,
* carga ejercicios y demostraciones GIF.

```bash
php artisan optimize:clear
php artisan migrate:fresh --seed
```

---

## 9️⃣ Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en:

```txt
http://127.0.0.1:8000
```

---

# 👥 Usuarios de Prueba

El sistema crea automáticamente usuarios iniciales mediante `UsersSeeder`.

## 🔑 Contraseña para todos los usuarios

```txt
12345678
```

## 👤 Administrador

```txt
Correo: admin@fitboost.com
```

## 👤 Entrenador

```txt
Correo: trainer@fitboost.com
```

---

# 🧹 Limpieza de Caché

Si Laravel no reconoce cambios en rutas, vistas o configuraciones:

```bash
php artisan optimize:clear
```

---

# 🏗️ Tecnologías Utilizadas

* Laravel
* PHP 8.2
* MySQL
* AdminLTE
* Bootstrap
* JavaScript
* Node.js
* NPM

---

# 📂 Funcionalidades Principales

✅ Gestión de usuarios
✅ Rutinas de entrenamiento
✅ Planes nutricionales
✅ Valoraciones antropométricas
✅ Panel administrativo
✅ Sistema de autenticación
✅ Seeders automáticos
✅ Gestión de ejercicios con GIFs

---

# 📌 Autor

Proyecto desarrollado por el equipo de desarrollo de **FitBoost**.
