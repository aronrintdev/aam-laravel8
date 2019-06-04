if [ $# -eq 0 ]
then
    TASK='deploy'
else
    TASK=$@
fi
SOURCE=../ SSH_KEY=/home/mark/.ssh/id_v1deployer.pem  TASK="$TASK" docker-compose -f ci/compose-deploy.yml run --rm deployer
