<?php

namespace Deployer;

require 'contrib/rsync.php';
require 'recipe/codeigniter.php';

set('keep_releases', 5);
set('copy_dirs', ['css', 'demo', 'images', 'js', 'vendors']);
set('application', 'cci');
set('rsync_src', __DIR__);
set('rsync_dest', '{{release_path}}');

add('shared_files', ['demo/includes/connect.php']);

add('rsync', [
    'exclude' => [
        '*.csv',
        '*.log',
        '.idea',
        '.DS_Store',
        '.env',
        '.gitignore',
        '*.md',
        'deploy.php',
    ],
]);

// Hosts

host('10.194.73.95')
    ->set('remote_user', 'root')
    ->set('labels', ['stage' => 'staging'])
    ->set('deploy_path', '/usr/share/nginx/{{application}}')
    ->set('rsync_dest', '{{release_path}}');

host('10.194.73.94')
    ->set('remote_user', 'root')
    ->set('labels', ['stage' => 'prod'])
    ->set('deploy_path', '/usr/share/nginx/{{application}}')
    ->set('rsync_dest', '{{release_path}}');

// Tasks
desc("Deployment Task");
task('deploy', [
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'deploy:copy_dirs',
    'rsync',
    'deploy:shared',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup',
    'restart-nginx-fpm',
    'deploy:success'
]);

task('restart-nginx-fpm', function () {
    run('systemctl restart nginx');
    run('systemctl restart php-fpm');
});

after('deploy:failed', 'deploy:unlock');

after('deploy:success', 'create-sym-link');

task('create-sym-link', function () {
    run ('cd /usr/share/nginx/ps/ && ln -sfn {{current_path}} dcpcr_fln');
});