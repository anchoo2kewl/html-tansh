# html-tansh
Runs the HTML and some PHP in a docker container.

To run the container, cd into the directory and build and run.


```
$ docker build -t biswas/tansh-html:v0.1-SNAPSHOT .
$ docker run --name html -d -p 80:80 -p 443:443 -v "$PWD/src:/usr/share/nginx/html" biswas/tansh-html:v0.1-SNAPSHOT
```

This is a PHP application but depends on the `go-tansh` project which depends on the postgres db.

We need to create an event before using it.

```
$ curl --request POST \
  --url http://localhost:3000/events \
  --header 'Content-Type: application/json' \
  --data '{"name": "Baby Shower", "location": "Caesars Palace", "address": "3570 S Las Vegas Blvd, Las Vegas, NV 89109, United States", "description": "Baby shower for Tanya.", "event_time": "2022-10-30T11:00:00.000Z"}'
  ```

Run Postgres with the correct environment variables:

```
$ docker run --name postgres -p 5432:5432 --env-file ../.env -d postgres
# Then run the migration script to create the proper tables
$ export $(xargs < ../.env)
export POSTGRESQL_URL="postgres://$POSTGRES_USER:$POSTGRES_PASSWORD@$POSTGRES_HOST:5432/$POSTGRES_DB?sslmode=disable"
$ migrate -database ${POSTGRESQL_URL} -path ../backend/migrations up
```