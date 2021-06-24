<?php
class Book {
    private $id;
    public $bookCode;
    public $name;
    public $author;
    public $publishYear;
    public $status;
    public $categoryId;

    public function __construct($bookCode, $name, $author, $publishYear, $status, $categoryId){
        $this->bookCode = $bookCode;
        $this->name = $name;
        $this->author = $author;
        $this->publishYear = $publishYear;
        $this->status = $status;
        $this->categoryId = $categoryId;
    }
    
    public function toString(){
        echo "<br/>Book: Code: $this->bookCode; Name: $this->name; Author: $this->author; Publish Year: $this->publishYear; Status: $this->status; Category Id: $this->categoryId";
    }
}
?>