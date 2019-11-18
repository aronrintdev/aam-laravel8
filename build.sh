if [ $# -eq 0 ]
then
    ENV='test'
else
    ENV=$1
fi

echo 'building for env' $ENV '...'

if [ $ENV = "prod" ] || [ $ENV = "stage" ];then
    BRANCH='master'
    echo 'checking out master branch '
    git clean -f
    git checkout master
    git fetch origin
    git reset --hard origin/master
else
    BRANCH='develop'
    echo 'checking out develop branch '
    git clean -f
    git checkout develop
    git fetch origin
    git reset --hard origin/develop
fi;

echo 'decrypting env.'$ENV '...'
if [ -z $KEY ];then
	echo 'no env decryption key.  aborting.'
	exit 1
fi;

SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -T -w "/app" -e KEY=$KEY php-composer php ci/dot-vault.php decrypt ci/envs/env.$ENV > .env

echo "generate version from $BRANCH ... "
#set a version number
VERSION_TAG=$(git describe --abbrev=0 --tags)
VERSION_SHA=$(git rev-parse --short $BRANCH)
echo "setting APP_VERSION to  $VERSION_TAG#$VERSION_SHA ... "
echo 'APP_VERSION="'$VERSION_TAG#$VERSION_SHA'"' >> .env
echo 'MIX_APP_VERSION="'$VERSION_TAG#$VERSION_SHA'"' >> .env

echo 'publish vendor resources ...'
SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -w "/app" php-composer php artisan vendor:publish --tag=datatables-buttons --force

if [ $ENV = "test" ];then
    echo 'composer dependencies (with dev) ...'
    SOURCE=../ docker-compose -f ci/compose-build.yml run --rm php-composer composer --no-ansi install --no-progress --ignore-platform-reqs
else
    echo 'composer dependencies (no dev) ...'
    SOURCE=../ docker-compose -f ci/compose-build.yml run --rm php-composer composer --no-ansi install --no-dev --no-progress --ignore-platform-reqs
fi;
#SOURCE=../ docker-compose -f ci/compose-build.yml run --rm node-yarn   sh -c "cd /app && yarn install && yarn $ENV"
