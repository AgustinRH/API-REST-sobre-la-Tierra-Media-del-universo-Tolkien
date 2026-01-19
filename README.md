
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

### 6. Rellenar base de datos (opcional)
```bash
php artisan db:seed
```

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

```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar seeder específico
php artisan db:seed --class=HeroesSeeder
```

### Seeders Disponibles

- `RegionsSeeder`
- `RealmsSeeder`
- `CreaturesSeeder`
- `HeroesSeeder`
- `ArtifactsSeeder`
- `ArtifactHeroSeeder`

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

Agustín

## 📞 Soporte

Para reportar errores o sugerencias, abre un issue en el repositorio.

---

**Última actualización**: 19 de enero de 2026
