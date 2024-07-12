<?php

use App\Gists\GistConfig;

class GistConfigTest extends BrowserKitTestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('8f5ea4d44dbc5ccb77a3.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertEquals('A test preview.', $config['preview']);
        $this->assertEquals('2015-05-15', $config['published_on']->format('Y-m-d'));
        $this->assertTrue($config['published']);
        $this->assertTrue($config['include_files']);
    }

    /** @test */
    public function it_returns_default_values_when_no_gistlog_yml_is_present()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertNull($config['preview']);
        $this->assertNull($config['published_on']);
        $this->assertFalse($config['published']);
        $this->assertFalse($config['include_files']);
    }

    /** @test */
    public function it_returns_default_values_when_gistlog_yml_does_not_provide_them()
    {
        $githubGist = $this->loadFixture('9e5ea4d44dbc5ccb77b4.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertNull($config['preview']); // excluded
        $this->assertFalse($config['published']); // excluded
        $this->assertFalse($config['include_files']); // excluded
        $this->assertEquals('2015-05-15', $config['published_on']->format('Y-m-d')); // provided
    }

    /** @test */
    public function it_returns_a_null_value_when_a_date_value_is_invalid()
    {
        $githubGist = $this->loadFixture('bb5ea4d44dbc5ccb77s7.json');

        $config = GistConfig::fromGitHub($githubGist);

        $this->assertNull($config['published_on']);
    }
}
