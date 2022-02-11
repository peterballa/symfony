# Symfony API platform

## Setup

1. Generate JWT keys

       > bin/console lexik:jwt:generate-keypair

2. Migrate database

       > bin/console doctrine:migrations:migrate
   
3. Create User in the user table

- email: admin@gmail.com
- roles: ["ROLE_USER"]
- password: $2y$13$St/XBXIf/0qzsKpD/MCFlOW21xAVxknWlfY7TKT/m2U3oLxLKqbVW

The password is a hash value from 'admin' word. You can generate with

    > bin/console security:hash-password

Here choose actually any e.g.: [0] App\Entity\User, then add a password. Copy it into user table.

4. Run local server

       > symfony server:start

## API usage

Call the `http://127.0.0.1:8000/api/login_check` with POST method with paylod:

```json
{
    "username": "admin@gmail.com",
    "password": "admin"
}
```
![postman_auth](.docs/postman_auth.png)

Response:

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDQ1NjQ3ODQsImV4cCI6MTY0NDU2ODM4NCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiYWRtaW5AZ21haWwuY29tIn0.VOIEfOSTyA2ewsi5aSn8ikTtmiBzWkUg-Nwk-XuEHzQNmeNPkc40OFqG0mPpspmh5NM6ZSBVTiFQl7BOkPpNweFPzDSwwk2AGqydV4ko7JN5KK1eFllPkdM-Bh73qU1NUGUQEkX5UUx8UZyrA9n_hB3QbskGR14IkO3HiL-SzVUAFcKgtyYZ8Pl1l9r6jugtExqk9hhnpPWjMYTqhImlxZ-pAYWkT09OEErCI2IqP_45RAQThgd-LH1mvoXY-d8FsFHw8HtMIU7RyCUMcBRA1H9pmFoebUoCaCLf9ay_o3VG1jOxR3FcAmSHt1wtLI7i9FM0AKfO7CWhAf009jjNVw",
    "refresh_token": "ce02b244523a710d085aae7c2581f8f9f0f660d12049daac9cc7e1f6e0d0a90bdfe2c1c0cf2e8021e601ec37a6b092d0ac4858473a0236118f49ef0138429a59"
}
```

Use the given token to call api requests with Authorization header Bearer: ${token} e.g.:

![postman_request](.docs/postman_request.png)