<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodosController extends AbstractController
{
    public function showUnCompletedTodos(Connection $connection)
    {
		$todos = $connection->fetchAll('SELECT t.* FROM todos t WHERE completed = 0');
        
		return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }
	
	public function showAllTodos(Connection $connection)
    {
		$todos = $connection->fetchAll('SELECT t.* FROM todos t');

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }
		
    public function setCompleteTodo(Connection $connection)
    {
        $connection->executeQuery('UPDATE todos SET completed = ' . (isset($_GET['cmp']) ? 1 : 0) . ' WHERE id = ' . $_GET['id']);
		
		return $this->redirect('/');
    }
}
