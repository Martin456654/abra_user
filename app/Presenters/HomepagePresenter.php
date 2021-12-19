<?php

namespace App\Presenters;

use Nette;
use Nette\Utils\DateTime;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

    public function renderDefault(string $pageType = null, int $postId = null): void
    {
        // declare http
        $httpResponse = $this->getHttpResponse();
        $httpRequest = $this->getHttpRequest();

        // if I come from single post
        if($pageType == "single"){
            if($postId != null){
                $httpResponse->setCookie("post". $postId, "readed", "5 days");
                $this->redirect("Homepage:default");
            }
        }
        
        // if I come from all posts page
        if($pageType == "all"){
            $allPostsCookies = $this->database
                ->table('posts')
                ->where( 'dateTest', date('Y-m-d'));
            
            $cookieAdded = false;
            // foreach actual posts -> check if cookie exist -> if not, create new
            foreach($allPostsCookies as $cookie){
                $cookieExist = $httpRequest->getCookie('post' . $cookie->id);
                
                if($cookieExist == null){
                    $httpResponse->setCookie("post" . $cookie->id, "readed", "5 days");
                    $cookieAdded = true;
                }
            }

            if($cookieAdded == true){
                $this->redirect("Homepage:default");
            }
        }

        // database select
        $my_database = $this->database
            ->table('posts')
			->where( 'dateTest', date('Y-m-d'))
            ->order('date DESC')
            ->limit(50);

        $this->template->posts = $my_database;
            
        foreach($my_database as $post){
            if($httpRequest->getCookie('post' . $post->id) != null){
                $this->template->{'cookie' . $post->id} = "readed";
        }
        }
    }
}