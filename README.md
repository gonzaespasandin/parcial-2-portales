## Liga de Cohetes

Un portal de comercio electrónico inspirado en Rocket League con un toque de parodia.

### Descripción General

Liga de Cohetes es una aplicación web desarrollada en **Laravel 11** que simula un portal de comercio electrónico para un juego de fútbol futurista.  
Permite a los usuarios:

- Registrarse e iniciar sesión.
- Explorar productos (juego base y complementos).
- Gestionar un carrito de compras.
- Realizar pagos a través de **Mercado Pago**.
- Consultar noticias del juego y paneles informativos.
- Administrar usuarios y estadísticas desde un panel de administración.

---

## Tecnologías Utilizadas

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade, HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5
- **Base de datos**: MySQL / SQLite (según configuración)
- **Pagos**: SDK oficial de Mercado Pago
- **Servidor local recomendado**: XAMPP / Laragon / similar

---

## Instalación y Puesta en Marcha

1. **Clonar el repositorio**
2. **Instalar dependencias PHP**

   ```bash
   composer install
   ```

3. **Configurar el entorno**

   - Copiar `.env.example` a `.env`.
   - Configurar conexión a base de datos (`DB_...`).
   - Configurar claves de Mercado Pago en `config/mercadopago.php` o variables de entorno:
     - `MERCADOPAGO_ACCESS_TOKEN`
     - `MERCADOPAGO_PUBLIC_KEY`
     - `MERCADOPAGO_SECRET_KEY`
     - `MERCADOPAGO_NGROK_URL` (para callbacks en entorno local).

4. **Generar key de la app**

   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones**

   ```bash
   php artisan migrate
   ```

6. **Ejecutar seeders (datos de prueba)**

   ```bash
   php artisan db:seed
   ```

7. **Levantar el servidor de desarrollo**

   ```bash
   php artisan serve
   ```

---

## Recorrida Funcional de la App

### 1. Home / Catálogo (`/`)

- **Ruta**: `GET /` → `HomeController@home`
- **Vista**: `resources/views/home.blade.php`
- Muestra el listado de **productos** (`Product`):
  - Juego base y complementos.
  - Imagen, título, subtítulo, descripción y precio.
  - Botón **“Agregar al carrito”** que envía el producto al carrito del usuario autenticado.
- Secciones informativas:
  - Nueva temporada.
  - Colaboración con Sonic (enlace a una noticia específica).

### 2. Autenticación (`/login`, `/register`, `/logout`)

- **Controlador**: `AuthController`
- **Rutas principales**:
  - `GET /login` → formulario de login.
  - `POST /login` → procesa credenciales.
  - `GET /register` → formulario de registro.
  - `POST /register` → crea usuario y loguea.
  - `POST /logout` → cierra sesión.
- **Validaciones**:
  - Email y contraseña obligatorios.
  - Email único en registro.
  - Contraseña mínima de 4 caracteres, con confirmación.
- Tras login/registro exitoso, redirige a **Home** con mensajes de feedback.

### 3. Noticias (`/news`)

- **Controlador**: `NewsController`
- **Modelo**: `News` (relacionado con `Category`)
- **Rutas públicas**:
  - `GET /news` → listado de noticias.
  - `GET /news/{id}` → detalle de una noticia.
- **Rutas sólo admin** (middleware `EnsureUserIsAdmin`):
  - `GET /news/create` → formulario de alta.
  - `POST /news/create` → creación.
  - `GET /news/{id}/edit` → edición.
  - `POST /news/{id}/edit` → actualización.
  - `GET /news/{id}/delete` → confirmación de borrado.
  - `POST /news/{id}/delete` → eliminación definitiva.
- Soporta:
  - Imagen opcional con descripción accesible.
  - Categorías con color y nombre.
  - Validaciones personalizadas en español.

### 4. Carrito de Compras (`/cart`)

- **Controlador**: `CartController`
- **Almacenamiento**: sesión (`session('cart')`).
- **Rutas (todas requieren usuario autenticado)**:
  - `GET /cart` → detalle del carrito.
  - `POST /cart/add` → agrega un producto.
  - `POST /cart/remove/{id}` → quita un producto.
  - `POST /cart/clear` → vacía el carrito.
- Reglas de negocio:
  - Un mismo producto no puede agregarse dos veces al carrito.
  - No permite agregar productos ya comprados previamente por el usuario.
  - Muestra subtotal y total con precios formateados.

### 5. Pagos con Mercado Pago

- **Controlador**: `MercadoPagoController`
- **Middleware especial**: `VerifyMercadoPagoCallback` para validar callbacks.
- **Rutas**:
  - `POST /mercadopago/create` → crea preferencia de pago y redirige al checkout.
  - `GET /mercadopago/success` → pago aprobado (limpia carrito, muestra pantalla de éxito).
  - `GET /mercadopago/failure` → pago fallido.
  - `GET /mercadopago/pending` → pago pendiente.
  - `POST /mercadopago/confirmar-pago` → endpoint para verificar firmas de notificación (webhooks).
- Integra:
  - Items construidos a partir del carrito (título, cantidad, precio unitario).
  - `back_urls` configuradas para redireccionar correctamente según resultado de pago.

### 6. Perfil de Usuario (`/profile`)

- **Controlador**: `ProfileController`
- **Rutas** (todas con middleware `auth`):
  - `GET /profile` → muestra datos del usuario y su historial de compras.
  - `GET /profile/edit` → formulario de edición de perfil.
  - `POST /profile/edit` → actualización de nombre y email.
- Vista de perfil:
  - Nombre, email, fecha de registro.
  - Cantidad total de compras.
  - Tabla con historial de compras (producto, tipo, fecha).

### 7. Panel de Administración (`/admin`)

- **Controlador**: `AdminController`
- **Middleware**: `EnsureUserIsAdmin`
- **Ruta**:
  - `GET /admin` → panel principal.
- Muestra:
  - Producto más vendido (con imagen y cantidad).
  - Mes con más ventas y monto recaudado.
  - Recaudación total.
  - Cantidad total de órdenes.
  - Tabla paginada de usuarios (rol `user`) con:
    - Indicadores si compró el juego base.
    - Indicadores si compró complementos.
    - Fecha de última compra.
    - Total gastado.
    - Detalle expandible de compras por usuario.

---

## Modelos y Relaciones

- **`User`**
  - Campos: `name`, `email`, `password`, `role`.
  - Relaciones:
    - `hasMany(Purchase)` → compras del usuario.
  - Helpers:
    - `isAdmin()`, `hasPurchasedProduct()`, `hasGame()`, `hasComplements()`, `getLastPurchaseDate()`.

- **`Product`**
  - Campos: `title`, `subtitle`, `image_route`, `image_description`, `content`, `price`.
  - El `price` se almacena en centavos en BD y se expone en pesos mediante un **cast de atributo**.
  - Relación: `hasMany(Purchase)`.

- **`News`**
  - Campos: `title`, `content`, `image`, `image_description`, `category_fk_id`.
  - Relación: `belongsTo(Category)`.

- **`Category`**
  - Usada para clasificar noticias (nombre, color, etc.).

- **`Purchase`**
  - Campos: `user_id`, `product_id_fk`, `payment_method`, `purchased_at`, `updated_at`.
  - Relaciones:
    - `belongsTo(User)`
    - `belongsTo(Product)`

---

## Estructura del Proyecto (resumen)

- `app/Http/Controllers/`
  - `HomeController`, `AuthController`, `NewsController`, `CartController`, `MercadoPagoController`, `ProfileController`, `AdminController`.
- `app/Http/Middleware/`
  - `EnsureUserIsAdmin`, `VerifyMercadoPagoCallback`.
- `app/Models/`
  - `User`, `Product`, `News`, `Category`, `Purchase`.
- `resources/views/`
  - `home.blade.php`, `admin/*`, `auth/*`, `cart/*`, `news/*`, `profile/*`, `mercadopago/*`.
  - Componentes de layout: `components/layouts/main.blade.php`, `components/nav-link.blade.php`.
- `database/migrations/`
  - Tablas para usuarios, noticias, productos, categorías, compras, tipos de productos, etc.
- `database/seeders/`
  - Datos iniciales de usuarios (incluye admin), productos, noticias, categorías y compras.
- `public/css/`
  - Estilos específicos por sección: `home.css`, `news.css`, `cart.css`, `admin.css`, `profile.css`, `forms.css`, etc.

---

## Credenciales por Defecto (seeders)

- **Usuario administrador**
  - Email: `admin@admin.com`
  - Contraseña: `admin`

---

## Funcionalidades Implementadas

- ✅ Sistema de autenticación (login, registro, logout).
- ✅ CRUD completo de noticias con categorías e imágenes (solo admin).
- ✅ Catálogo de productos con precios formateados y distinción entre juego base y complementos.
- ✅ Carrito de compras con restricciones de negocio (no duplicados, no productos ya comprados).
- ✅ Integración con Mercado Pago (checkout, pantallas de éxito/fallo/pendiente, verificación de firmas).
- ✅ Perfil de usuario con historial de compras.
- ✅ Panel de administración con métricas, usuarios, y detalle de compras.
- ✅ Diseño responsive y moderno con Bootstrap 5 y estilos personalizados.
- ✅ Navegación dinámica con componentes Blade reutilizables.

---

## Autor

Gonzalo Emanuel Espasandin