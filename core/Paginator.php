<?php

/**
 * Description of Paginator
 *
 * @author Fake
 */
class Paginator{
    /**
     * Початковий індекс
     * @var int 
     */
    private $_startIndex;
    /**
     * Кінцевий індекс
     * @var int 
     */
    private $_endIndex;
    /**
     * Кількість сторінок
     * @var int 
     */
    private $_pages;
    /**
     * Конструктор
     * Визначає початковий, кінцевий індекси і кількість сторінок
     * @param int $page
     * @param int $itemsOnPage
     * @param int $totalItems
     */
    public function __construct($page, $itemsOnPage, $totalItems){
        $this->_startindex = ((int)$page-1)*(int)$itemsOnPage;
        $this->_endIndex = $this->_startIndex+(int)$itemsOnPage;
        $this->_pages = ceil((int)$totalItems/(int)$itemsOnPage);
    }
    /**
     * Повертає початковий індекс
     * @return int
     */
    public function getStartIndex(){
        return $this->_startIndex;
    }
    /**
     * Повертає кінцевий індекс
     * @return int
     */
    public function getEndIndex(){
        return $this->_endIndex;
    }
    /**
     * Повертає кількість сторінок
     * @return int
     */
    public function getPages(){
        return $this->_pages;
    }
    
}

