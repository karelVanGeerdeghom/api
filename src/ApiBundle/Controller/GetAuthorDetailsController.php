<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetAuthorDetails

class GetAuthorDetailsController extends Controller
{
	public function getAction() {
		$answer = [];

		$appId = 5;
		$id = 1;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:AuthorEntity');
		$repository->setAppId($appId);

		$authors = $repository->findById($id);
		foreach ($authors as $id => $author) {
			$author->setMeta($repository->getMeta());
			array_push($answer, $author->export());
		}

		return $answer;
	}
}
