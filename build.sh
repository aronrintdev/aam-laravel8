if [ $# -eq 0 ]
then
    ENV='test'
else
    ENV=$1
fi


echo 'building for env' $ENV '...'

if [ "$ENV" == "stage" ];then
    BRANCH=$2
    if [ "$BRANCH" == "" ];then
        BRANCH='master'
    fi;
fi;
if [ "$ENV" == "prod" ];then
    BRANCH='master'
fi;
if [ "$ENV" == "test" ];then
    BRANCH='develop'
fi;
    echo 'checking out branch ' $BRANCH
    git fetch origin
    git checkout $BRANCH
    git reset --hard origin/$BRANCH
    if [ $? -ne 0 ];then
        echo "no such branch " $BRANCH;
        exit -1;
    fi;

echo 'decrypting env.'$ENV '...'
if [ -z $KEY ];then
	echo 'no env decryption key.  aborting.'
	exit 1
fi;

SOURCE=../ docker-compose -f ci/compose-build.yml run --rm -T -w "/app" -e KEY=$KEY php-composer php ci/dot-vault.php decrypt ci/envs/env.$ENV > .env

echo "generate version from $BRANCH ... "
#set a version number
if [[ $BRANCH == release/* ]];then
    VERSION_TAG=$(git branch | grep \* | cut -d '/' -f2)
else
    VERSION_TAG=$(git describe --abbrev=0 --tags)
fi;
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
