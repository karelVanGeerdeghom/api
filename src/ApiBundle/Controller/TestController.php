<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\EntityMap\Author;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		$author = new Author();

		return $author->getTable();

		return $answer;
	}
}
