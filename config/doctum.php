<?php
namespace config;
use Doctum\Doctum;
use Doctum\Parser\Filter\TrueFilter;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Version\GitVersionCollection;

$root = dirname(__DIR__);

return new Doctum($root . '/src', [
    'title'                => 'StudyRoom Documentation',
    'build_dir'            => $root . '/docs',
    'cache_dir'            => $root . '/docs/cache',
    'default_opened_level' => 2,
]);