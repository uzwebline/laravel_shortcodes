<?php

namespace Uzwebline\Shortcodes;

use Orchestra\Testbench\TestCase;

class NamespaceTest extends TestCase
{
    public function testShouldLoadPreviousNamespaces()
    {
        $factory = app('view')->getFinder();

        app()->register('Uzwebline\Shortcodes\ShortcodesServiceProvider');

        $freshFactory = app('view')->getFinder();

        $this->assertEquals($factory, $freshFactory);
    }
}
