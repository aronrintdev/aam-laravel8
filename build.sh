if [ $# -eq 0 ]
then
    ENV='test'
else
    ENV=$1
fi

echo 'building for env' $ENV '...'

echo 'decrypting env.'$ENV '...'
if [ -z $KEY ];then
	echo 'no env decryption key.  aborting.'
	exit 1
fi;

SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -T -w "/app" -e KEY=$KEY php-composer php ci/dot-vault.php decrypt ci/envs/env.$ENV > .env

echo 'publish vendor resources ...'
SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -w "/app" php-composer php artisan vendor:publish --tag=datatables-buttons --force

echo 'composer dependencies (no dev) ...'
SOURCE=../ docker-compose -f ci/compose-build.yml run --rm php-composer composer --no-ansi install --no-dev --no-progress --ignore-platform-reqs
#SOURCE=../ docker-compose -f ci/compose-build.yml run --rm node-yarn   sh -c "cd /app && yarn install && yarn $ENV"
