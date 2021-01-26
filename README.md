V1API / Account + Academy Magt
===

This project needs 3 databases.  Main DB connection is sqlsrv for the existing ISA db.
Second DB is a new laravel DB for managing login credentials to this site.
Third DB is the V1A or lessons db, since writing a formal API for this site to hit that is a bit long in the tooth.

Some features added to that lessons db need to be over here and we just don't have the time to properly port 
the functionality from that laravel to this one and create and test live migrations for SQL server.

Local env
===
Copy `.env.example` to `.env` and add the following

```
DB_CONNECTION=sqlsrv
DB_HOST=IP of sqlserver-dev or 127.0.0.1
DB_PORT=1433
DB_DATABASE=isa_test
DB_USERNAME=SA
DB_PASSWORD='' # get this from docker-compose.yml in sqlserver-dev

BACK_DB_CONNECTION=backendmysql
BACK_DB_HOST='localhost'
BACK_DB_DATABASE='vos_account_dev'
BACK_DB_USERNAME='homestead-or-valet'
BACK_DB_PASSWORD='secret' 
```

Then, because the default database is MSSQL - and it already has a schema. 
```
php artisan migrate --database=mysql
```

Sample Data
===

The sample seeder `TestDatabase` clears out data with `TRUNCATE` on certain tables.

Do not run migrations, the SQL Server migrations are handled in dev-database project.

Production migrations are run by hand

```
php artisan db:seed --class="TestDatabaseSeeder"
```


For local work, you need swing IDs as part of "normal" seeders too.

```
php artisan db:seed
```

JSON-API
===
This project tries to adhere to the JSON-API std way of formatting responses.

This iniitally used the League's Fractal package until it became known that that package could not
represent JSON-API responses.  So Neomerx's JSON-API package was used for newer transformations.


Swagger Docs
===
use `php artisan l5-swagger:generate` to generate a usable HTML page for testing the APIs.  This 
ends up in storage/public/api-docs/.  This command always cleans out the destination folder and we
need to link the json-api.json schema.  Copy this file always after every generate, a copy is in
app/Http/Swagger/json-api.json or something close to that.
