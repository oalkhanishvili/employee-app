
## License
docker-compose --env-file .env up --build



# Lumen + MySQL + Docker

1. Rename `.env.example` to `.env` (or use your own `.env`)

2. In `.env`, change `DB_HOST=127.0.0.1` to `DB_HOST=your_mysql_container_name` (`DB_HOST=db` in this example)

3. php artisan jwt:secret

4. Build and run project with:

```
docker-compose --env-file .env up --build
```
