SOURCE=../ SSH_KEY=/home/mark/.ssh/id_v1deployer.pem  CMD="$@" docker-compose -f ci/compose-deploy.yml run --rm deployer
