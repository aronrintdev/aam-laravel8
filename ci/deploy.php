<?php
namespace Deployer;

require 'recipe/laravel.php';

$packageName = 'vos-aam-' . date('Ymd_his').'.tar.gz';
// Project name
set('application', 'vos-accounts');

// Project repository
set('repository', 'https://github.com/v1-sports/aam.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Laravel shared dirs
set('shared_dirs', [
    'storage',
]);
// Laravel shared file
set('shared_files', [
    '.env',
]);

// Writable dirs by web server 
//add('writable_dirs', []);
set('allow_anonymous_stats', false);
set('user', 'ubuntu');
set('http_user', 'www-data');

// Hosts

host('45.55.60.11')
->user('ubuntu')
->identityFile('~/.ssh/id_rsa')
->multiplexing(false)
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '/home/ubuntu/aam');
    
// Tasks

task('package', function () use ($packageName) {
    runLocally("mkdir -p build/");
    runLocally("tar -czf build/$packageName public/ app/ ci/ config/ vendor/ resources/ routes/ bootstrap/ artisan docker-compose.yml docker-compose.prod.yml");
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

after('deploy:update_code', 'artisan:migrate');

task('deploy:restart', function () use ($packageName) {
    //if we don't set the project name it will always change
    //and be the numeric folder name from deployer like 1, 2, 3
    //and then we cannot just restart or rebuild.
    $dockerProjectName = 'vostest';
    run("cd {{deploy_path}} && cd current && docker-compose -f docker-compose.yml -f docker-compose.prod.yml -p $dockerProjectName up -d aam-webapp");
});

//transfer the tar to the release path so that deployer cleans
//those up after a while and we don't run out of disk space
task('deploy:update_code', function () use ($packageName) {
    runLocally("scp -oStrictHostKeyChecking=no -rC build/$packageName {{user}}@{{hostname}}:{{release_path}}/{$packageName}");
    run("cd {{release_path}} && tar -C . -zxf {$packageName}");
});

task('deploy', [
    'deploy:prepare',
    'package',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:restart',
    'deploy:unlock',
//    'cleanup',
    'success'
]);
