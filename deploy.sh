if [ $# -eq 0 ]
then
    TASK='deploy'
else
    TASK=$@
fi

GITLOG="$(git log -3 --pretty=%s)"

SOURCE=../ SSH_KEY=/home/mark/.ssh/id_v1deployer.pem  TASK="$TASK" docker-compose -f ci/compose-deploy.yml run -e GITLOG="$GITLOG" --rm deployer
