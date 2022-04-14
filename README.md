

# Lumen + MySQL + Docker

1. Rename `.env.example` to `.env` (or use your own `.env`)

2. Build and run project with:

```
docker-compose --env-file .env up --build
```
3. Generate jwt secret in .env file 
```
docker-compose exec lumen php artisan jwt:secret
```

4. Populate database
```
docker-compose exec lumen php artisan migrate --seed
```

5. For test
```
docker-compose exec lumen php vendor/bin/codecept run api -v
```
#Note

For documentation visit: http://localhost:8000
