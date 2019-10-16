if [ $# -eq 0 ]
then
    ENV='test'
else
    ENV=$1
fi

echo 'building for env' $ENV '...'

if [ $ENV = "prod" ];then
    BRANCH='master'
	echo 'checking out master branch '
    git clean -X
    git checkout master
else
    BRANCH='develop'
	echo 'checking out develop branch '
    git clean -X
    git checkout develop
fi;


echo 'decrypting env.'$ENV '...'
if [ -z $KEY ];then
	echo 'no env decryption key.  aborting.'
	exit 1
fi;

SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -T -w "/app" -e KEY=$KEY php-composer php ci/dot-vault.php decrypt ci/envs/env.$ENV > .env

echo "generate version from $BRANCH ... "
#set a version number
VERSION_TAG=$(git describe --abbrev=0 --tags 2&>/dev/null)
VERSION_SHA=$(git rev-parse --short $BRANCH)
echo "setting APP_VERSION to  $VERSION_TAG#$VERSION_SHA ... "
echo 'APP_VERSION="'$VERSION_TAG#$VERSION_SHA'"' >> .env
echo 'MIX_APP_VERSION="'$VERSION_TAG#$VERSION_SHA'"' >> .env

echo 'publish vendor resources ...'
SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -w "/app" php-composer php artisan vendor:publish --tag=datatables-buttons --force

echo 'composer dependencies (no dev) ...'
SOURCE=../ docker-compose -f ci/compose-build.yml run --rm php-composer composer --no-ansi install --no-dev --no-progress --ignore-platform-reqs
#SOURCE=../ docker-compose -f ci/compose-build.yml run --rm node-yarn   sh -c "cd /app && yarn install && yarn $ENV"
