<?php

namespace Uzwebline\Shortcodes;

use Orchestra\Testbench\TestCase as TestBenchTestCase;

class TestCase extends TestBenchTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->shortcode = app()->make('shortcode');
    }

    protected function getPackageProviders($app)
    {
        return ['Uzwebline\Shortcodes\ShortcodesServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Shortcode' => 'Uzwebline\Shortcodes\Facades\Shortcode'
        ];
    }
}
