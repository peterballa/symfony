# Symfony API platform

## Setup

1. Generate JWT keys

        > bin/console lexik:jwt:generate-keypair

2. Create User in the user table

- email: admin@gmail.com
- roles: ["ROLE_USER"]
- password: $2y$13$St/XBXIf/0qzsKpD/MCFlOW21xAVxknWlfY7TKT/m2U3oLxLKqbVW

The password is a hash value from 'admin' word. You can generate with

      > bin/console security:hash-password

Here choose actually any e.g.: [0] App\Entity\User, then add a password. Copy it into user table.
