if [ $# -eq 0 ]
then
    TASK='deploy'
else
    TASK=$@
fi
GITLOG="$(git log -3 --pretty=%s)"

TASK="$TASK" docker-compose -f ci/compose-deploy.yml run \
    -e GITLOG="$GITLOG" \
    --rm deployer
