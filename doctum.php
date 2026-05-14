<?php

use Doctum\Doctum;
use Doctum\Parser\Filter\TrueFilter;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Version\GitVersionCollection;

$dir = __DIR__;

return new Doctum($dir . '/src', [
    'title'                => 'StudyRoom Documentation',
    'build_dir'            => $dir . '/docs',
    'cache_dir'            => $dir . '/docs/cache',
    'default_opened_level' => 2,
]);
