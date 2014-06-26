<?php

require_once __DIR__ . '/CommandAbstract.php';
require_once __DIR__ . '/PostProviderFactory.php';

class ListCommand extends CommandAbstract
{
    protected static $validArguments = array(
        '--posts',
        '--pages',
    );

    /**
     * Execute list command and return the response
     *
     * @return array Response
     * @throws InvalidCommandArgumentException If has any invalid arguments
     */
    public function execute()
    {
        $this->checkArgumentsValid();

        return array(
            'list' => $this->getPostList(),
        );
    }

    protected function getPostList()
    {
        $posts = PostProviderFactory::make();

        $postList = array();
        foreach ($posts as $post) {
            $postList[] = $post->postname;
        }
    }
}
