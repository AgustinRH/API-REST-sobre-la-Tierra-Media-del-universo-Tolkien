
# API REST - Tierra Media (Universo Tolkien)

Una API REST desarrollada con **Laravel 11** que gestiona un universo fantasy basado en la Tierra Media de Tolkien, permitiendo administrar Héroes, Criaturas, Reinos, Regiones y Artefactos mágicos.

## 📋 Descripción del Proyecto

Este proyecto es una API REST completa que simula un mundo fantasy con las siguientes entidades:

- **Héroes**: Personajes principales del universo
- **Criaturas**: Entidades del mundo (enemigos, aliados, etc.)
- **Reinos**: Territorios gobernados dentro de la Tierra Media
- **Regiones**: Áreas geográficas que pertenecen a reinos
- **Artefactos**: Objetos mágicos que pueden ser equipados por héroes

## 🛠️ Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm (para desarrollo frontend)
- Base de datos MySQL/SQLite
- Laravel 11

## ⚙️ Instalación

### 1. Clonar el repositorio
```bash
git clone <tu-repositorio>
cd api-rest
```

### 2. Instalar dependencias PHP
```bash
composer install
```

### 3. Instalar dependencias JavaScript
```bash
npm install
```

### 4. Configurar variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

Esto creará las siguientes tablas:
- `cache`
- `regions` - Regiones geográficas
- `realms` - Reinos
- `creatures` - Criaturas del mundo
- `heroes` - Personajes principales
- `artifacts` - Objetos mágicos
- `artifacts_hero` - Relación entre artefactos y héroes
- `personal_access_tokens` - Tokens de Sanctum
- `sessions` - Sesiones de usuario

### 6. Rellenar base de datos con datos de ejemplo (opcional)
```bash
php artisan db:seed
```

Esto ejecutará todos los seeders y poblará las tablas con datos de ejemplo del universo de Tolkien.

### 7. Iniciar el servidor
```bash
php artisan serve
```

La API estará disponible en `http://localhost:8000`

## 📊 Estructura de Base de Datos

### Migraciones

- **`regions`**: Regiones geográficas de la Tierra Media
- **`realms`**: Reinos que gobiernan sobre regiones
- **`creatures`**: Criaturas del mundo fantasy
- **`heroes`**: Héroes y personajes principales
- **`artifacts`**: Artefactos mágicos
- **`artifacts_hero`**: Relación many-to-many entre artefactos y héroes

### Modelos

| Modelo | Descripción |
|--------|-------------|
| `Hero` | Protagonistas del universo |
| `Creature` | Entidades con vida en el mundo |
| `Realm` | Territorios gobernados |
| `Region` | Divisiones geográficas |
| `Artifact` | Objetos mágicos y tesoros |

#### Relaciones Principales

```
Hero hasMany artifacts (many-to-many)
Realm hasMany creatures
Realm hasMany regions
Region belongsTo realm
Creature belongsTo realm
```

## 🔌 API Endpoints

Los endpoints están disponibles en `routes/api.php`. La API utiliza autenticación con **Laravel Sanctum** para seguridad.

### Recursos Disponibles

- `GET/POST /api/heroes` - Gestionar héroes
- `GET/POST /api/creatures` - Gestionar criaturas
- `GET/POST /api/realms` - Gestionar reinos
- `GET/POST /api/regions` - Gestionar regiones
- `GET/POST /api/artifacts` - Gestionar artefactos

## 🌱 Seeders

El proyecto incluye seeders para rellenar la base de datos con datos de ejemplo:

### Ejecutar Seeders

#### Ejecutar todos los seeders
```bash
php artisan db:seed
```

#### Ejecutar un seeder específico
```bash
php artisan db:seed --class=RegionsSeeder
php artisan db:seed --class=RealmsSeeder
php artisan db:seed --class=CreaturesSeeder
php artisan db:seed --class=HeroesSeeder
php artisan db:seed --class=ArtifactsSeeder
php artisan db:seed --class=ArtifactHeroSeeder
```

#### Resetear y re-ejecutar seeders
```bash
php artisan migrate:refresh --seed
```

### Seeders Disponibles

| Seeder | Descripción |
|--------|-------------|
| `RegionsSeeder` | Crea regiones geográficas de la Tierra Media |
| `RealmsSeeder` | Crea reinos dentro de las regiones |
| `CreaturesSeeder` | Crea criaturas y monstruos del mundo |
| `HeroesSeeder` | Crea héroes y personajes principales |
| `ArtifactsSeeder` | Crea artefactos mágicos y tesoros |
| `ArtifactHeroSeeder` | Asigna artefactos a héroes (relación many-to-many) |

## 🚀 Desarrollo

### Build para desarrollo
```bash
npm run dev
```

### Build para producción
```bash
npm run build
```

### Ejecutar tests
```bash
php artisan test
```

### Validar código con Pint
```bash
./vendor/bin/pint
```

## 📮 Probar los Endpoints con Postman

El proyecto incluye un archivo JSON para importar en **Postman** con todos los endpoints configurados:

### Ubicación del archivo
```
JSON POSTMAN/api-rest-test.json
```

### Importar la colección en Postman

1. Abre **Postman**
2. Haz clic en **Import** (o `Ctrl+O`)
3. Selecciona **File** y busca `JSON POSTMAN/api-rest-test.json`
4. Haz clic en **Import**

### Estructura de la Colección

La colección incluye todas las pruebas organizadas por recursos:

#### 1. **Regiones** - Gestión de regiones geográficas
- `GET` Listar todas las regiones
- `GET` Ver una región específica
- `POST` Crear nueva región
- `PUT` Actualizar región
- `DELETE` Eliminar región

#### 2. **Reinos** - Gestión de reinos y territorios
- `GET` Listar todos los reinos
- `GET` Detalle del reino (incluye relaciones)
- `GET` Listar héroes de un reino
- `POST` Crear nuevo reino
- `PUT` Actualizar reino
- `DELETE` Eliminar reino

#### 3. **Héroes** - Gestión de personajes principales
- `GET` Listar todos los héroes
- `GET` Detalle del héroe (incluye reino y artefactos)
- `GET` Listar héroes vivos
- `GET` Listar artefactos de un héroe
- `POST` Crear nuevo héroe
- `PUT` Actualizar héroe
- `DELETE` Eliminar héroe

#### 4. **Criaturas** - Gestión de criaturas y monstruos
- `GET` Listar todas las criaturas
- `GET` Detalle de criatura (incluye región)
- `GET` Criaturas peligrosas (filtro por nivel de amenaza)
- `POST` Crear nueva criatura
- `PUT` Actualizar criatura
- `DELETE` Eliminar criatura

#### 5. **Artefactos** - Gestión de objetos mágicos
- `GET` Listar todos los artefactos
- `GET` Detalle del artefacto
- `POST` Crear nuevo artefacto
- `PUT` Actualizar artefacto
- `DELETE` Eliminar artefacto

### Ejemplos de Requests

Algunos ejemplos incluidos en la colección:

```json
// Crear una región
POST /api/regions
{
  "name": "Mordor"
}

// Crear un reino
POST /api/realms
{
  "name": "Gondor",
  "ruler": "Aragorn",
  "alignment": "Bien",
  "region_id": 1
}

// Crear un héroe
POST /api/heroes
{
  "name": "Legolas",
  "race": "Elfo",
  "rank": "Príncipe",
  "realm_id": 1,
  "alive": true
}

// Crear una criatura
POST /api/creatures
{
  "name": "Balrog",
  "species": "Maia",
  "threat_level": 10,
  "region_id": 1
}
```

### Consejos para usar la colección

- **URL Base**: Por defecto está configurada a `http://localhost/api/` - ajusta según tu configuración
- **Parámetros**: Reemplaza los valores de ejemplo (1, "Mordor", etc.) según tus necesidades
- **Respuestas**: Observa las respuestas JSON para entender la estructura de datos
- **Relaciones**: Los endpoints GET de detalle incluyen las relaciones (realm, artifacts, etc.)

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Http/
│   │   └── Controllers/        # Controladores de la API
│   ├── Models/                 # Modelos Eloquent
│   └── Providers/              # Service Providers
├── database/
│   ├── migrations/             # Migraciones de BD
│   ├── seeders/                # Datos de prueba
│   └── factories/              # Factories para tests
├── routes/
│   ├── api.php                 # Rutas de API
│   ├── web.php                 # Rutas web
│   └── console.php             # Comandos Artisan
├── config/                     # Archivos de configuración
├── tests/                      # Tests unitarios y feature
└── storage/                    # Almacenamiento de archivos
```

## 🔐 Seguridad

- Autenticación con **Laravel Sanctum**
- CORS configurado en `config/cors.php`
- Validación de requests en controladores
- Hash de contraseñas con bcrypt

## 🐳 Docker (opcional)

El proyecto incluye `compose.yaml` para ejecutarse con Docker:

```bash
./vendor/bin/sail up
```

## 📝 Logs

Los logs de la aplicación se encuentran en `storage/logs/`

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo licencia MIT.

## 👨‍💻 Autor

AgustínRH

## 📞 Soporte

Para reportar errores o sugerencias, abre un issue en el repositorio.

---

**Última actualización**: 19 de enero de 2026
