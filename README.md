
# POC

Laravel 9 



## Run Locally

Clone the project

```bash
  git clone https://github.com/anuragdeepxon/yhhf.git
```

Go to the project directory

```bash
  cd yhhf
```

Install dependencies

```bash
  npm install
```

Run mix

```bash
  npm run dev
```

Install PHP dependencies

```bash
  composer install
```

Generate Key

```bash
  php artisan key:generate
```

Start the server

```bash
  php artisan serve
```


## Database

Update .env with database credentials, then run migrations

```bash
  php artisan migrate
```

Run Seeder to generate random data

```bash
  php artisan db:seed
```

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`L5_SWAGGER_GENERATE_ALWAYS=true`

`L5_SWAGGER_BASE_PATH=/api/v2`

`DB_KEY=base64:abcdefghijklmnopqrstuvwxyz1234567890q`

`DB_CIPHER=aes-256-gcm`


## API 
#### Swagger Documentation
```http
  /api/docs
```


