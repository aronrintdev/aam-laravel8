<?php
namespace Deployer;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

require 'recipe/laravel.php';



$buildTime = date('Ymd_his');
set('new_package_name', function () use ($buildTime) {
    $stage = input()->hasArgument('stage') ? ''.input()->getArgument('stage') : 'test';
    $packageName = 'vos-aam-' . $stage . '-' . $buildTime . '.tar.gz';
    return $packageName;
});

set('package_name', function () {
    $pl = get('packages_list');
    return $pl[0];
});
set('packages_list', function (){

    $stage = input()->hasArgument('stage') ? ''.input()->getArgument('stage') : 'test';
    $app = get('application');

    // If there is no releases return empty list.
    /*
    if (!test('[ -d build ] && [ "$(ls -A build/'.$app.'-'.$stage.'-*.tar.gz)" ]')) {
        return [];
    }
     */
    // Will list only dirs in releases.
    $list = explode("\n", runLocally('cd build && ls -t -1 '.$app.'-'.$stage.'-*.tar.gz'));
    // Prepare list.
    $list = array_map(function ($release) {
        return basename(rtrim(trim($release), '/'));
    }, $list);
	return $list;
});
// Project name
set('application', 'vos-aam');

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
set('deploy_path', '/home/ubuntu/aam');

// Hosts

host('45.55.60.11')
->stage('test')
->user('ubuntu')
->identityFile('~/.ssh/id_rsa')
->multiplexing(false)
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '/home/ubuntu/aam');
    
host('159.65.180.227')
->stage('stage')
->user('ubuntu')
->identityFile('~/.ssh/id_rsa')
->multiplexing(false)
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '/home/ubuntu/aam');

// Tasks
task('build', [
    'build:package',
]);

task('build:package', function () {
    $packageName = get('new_package_name');
    $stage = input()->hasArgument('stage') ? ''.input()->getArgument('stage') : 'test';
    run("mkdir -p build/");
    $files = [
        'public/', 'app/', 'ci/', 'config/', 'vendor/', 'resources/', 'routes/', 'bootstrap/', 'artisan', 'docker-compose.yml',
    ];
    if ($stage == 'stage') {
        $files[] = "docker-compose.stage.yml";
    }
    if ($stage == 'prod') {
        $files[] = "docker-compose.prod.yml";
    }
    run("tar -czf build/$packageName " . implode(' ' , $files));
})->local();

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
after('deploy:update_code', 'artisan:migrate');

//transfer the tar to the release path so that deployer cleans
//those up after a while and we don't run out of disk space
task('deploy:update_code', function () use ($packageName) {
    $packageName = get('package_name');
    writeln("transfering  build/$packageName");
    runLocally("scp -oStrictHostKeyChecking=no -rC build/$packageName {{user}}@{{hostname}}:{{release_path}}/{$packageName}");
    run("cd {{release_path}} && tar -C . -zxf {$packageName}");
});

task('deploy:restart', function () {
    //if we don't set the project name it will always change
    //and be the numeric folder name from deployer like 1, 2, 3
    //and then we cannot just restart or rebuild.
    $stage = input()->hasArgument('stage') ? ''.input()->getArgument('stage') : 'test';
    $dockerProjectName = 'vos'.$stage;
    run("cd {{deploy_path}} && cd current && docker-compose -f docker-compose.yml -f docker-compose.$stage.yml -p $dockerProjectName up -d aam-webapp");
});

task('deploy', [
    'build',
    'deploy:prepare',
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