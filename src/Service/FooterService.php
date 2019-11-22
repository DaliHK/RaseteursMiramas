<?php

namespace App\Service;
use Doctrine\Common\Persistence\ObjectManager;

class PaginationService {

private $entityClass;
private $limit = 6;
private $currentPage = 1;
private $manager;

public function __construct(ObjectManager $manager){

    $this->manager = $manager;
    
}

public function setContact($page) {

        $this->currentPage = $page;
    
        return $this;
    }
    
public function getPage(){
        
        return $this->currentPage;
    }

}