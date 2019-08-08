# Why this project ?
See issue MYISSUE for more details

# Install
## Docker
```bash
$ docker-compose up -d
```
to ease the use of containers you can run
```bash
$ source ./bin/functions.sh
```

## Set up database
Execute the following scripts:
  * `./docker/postgres/init.sql`
  * `./docker/postgres/fixtures.sql`

If in need to reset use the script: `./docker/postgres/reset.sql`

## Access to the test script: 
Add `127.0.0.1 local.pomm.issue` to your `/etc/hosts` then access to `http://local.pomm.issue/`

# What is expected ?
  * I expect an array of `Country`
  * For each `Country` object I expect a `province` field of type `Province`
  * For each `Province` object I expect a `city` field of type `City`

## Result
:warning: *I do not see any `city` field.*

# Mettre à jour les entitées
```bash
$ pomm pomm:generate:schema-all pomm_issue pomm --psr4 -d ./src/Persistence/Model/ -a "App\\\\Persistence\\\\Model"
```
