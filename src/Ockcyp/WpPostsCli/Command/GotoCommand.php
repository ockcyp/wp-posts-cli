<?php

namespace Ockcyp\WpPostsCli\Command;

use Ockcyp\WpPostsCli\PostProvider\PostProviderFactory;
use Ockcyp\WpPostsCli\Exception\MissingCommandArgumentException;

class GotoCommand extends CommandAbstract
{
    public function execute()
    {
        $this->checkArgumentsValid();

        $post = $this->findPost($this->arguments[0]);
        if ($post === false) {
            return null;
        }

        return array(
            'url' => $post->getPostUrl(),
        );
    }

    protected function findPost($postname)
    {
        $posts = PostProviderFactory::make();

        foreach ($posts as $post) {
            if ($postname === $post->postname) {
                return $post;
            }
        }

        return false;
    }

    protected function checkArgumentsValid()
    {
        if (!$this->arguments) {
            throw new MissingCommandArgumentException('Missing argument: postname');
        }
    }
}