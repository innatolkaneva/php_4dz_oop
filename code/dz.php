<?php
class BookCase{
    protected int $numberBookcase;
    protected array $books = [];
    public array $shelf = [];
    public function __construct(int $numberBookcase) {
        $this->numberBookcase = $numberBookcase;
    }
    public function whatCase() : string {
        return "Этот шкаф номер ".$this->numberBookcase;
    }
}
class Shelf extends BookCase {
    protected int $numberShelf;
    public array $books = [];
    public function __construct(int $numberBookcase, int $numberShelf) {
        parent::__construct($numberBookcase);
        $this->numberShelf = $numberShelf;
    }
    public function whatCase() : string {
        return "Шкаф номер ". $this->numberBookcase . ", полка номер " . $this->numberShelf;
    }
}
abstract class Book{
    protected string $name;
    protected int $countPages;
    protected int $statistycReads;

    public function __construct(string $name, int $countPages)
    {
        $this->name = $name;
        $this->countPages = $countPages;
        $this->statistycReads = 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCountPages(): int
    {
        return $this->countPages;
    }

    public function setCountPages(int $countPages): void
    {
        $this->countPages = $countPages;
    }
    public function getStatisticReads(): int{
        return $this->statistycReads;
    }
    public function addReads(): void{
        $this->statistycReads += 1;
    }
}
class PaperBook extends Book{
    protected Shelf $shelf;

    public function __construct(string  $name, int $countPages, Shelf $shelf)
    {
        parent::__construct($name, $countPages);
        $this->shelf = $shelf;
    }
    public function getBook() : string {
        $this->addReads();
        return "Книга " . $this->name . " здесь: " . $this->shelf->whatCase();
    }

}
class LinkBook extends Book{
    protected string $link;

    public function __construct(string  $name, int $countPages, string $link)
    {
        parent::__construct($name, $countPages);
        $this->link = $link;
    }
    public function getBook() : string {
        $this->addReads();
        return "Книга " . $this->name . " электронная, адрес в сети". $this->link;
    }

}
$myShelf = new Shelf(1, 3);
$mybook = new PaperBook("harry potter", 575, $myShelf);
$mybook2 = new PaperBook("harry potter2", 875, $myShelf);
echo $mybook->getBook();
echo $mybook2->getBook();

//Часть 2

//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A();
//$a2 = new A();
//$a1->foo(); //1
//$a2->foo(); //2
//$a1->foo(); //3
//$a2->foo(); //4 Поскольку это статическая переменная, она сохраняет значение и при вызове всегда увеличивает на 1

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); //1
$b1->foo(); //2
$a1->foo(); //3
$b1->foo(); //4 статическая переменная определена только в общем классе, поэтому имеет общее значение для всех наследников