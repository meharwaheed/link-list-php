<?php
class Node
{

    public function __construct(public $data, public $next = null){}
}

class SinglyLinkedList
{

    public function __construct(public $head = null, public $tail = null){}

    /**
     * Append Node as First Node
     * @param $data
     * @return void
     */
    public function preAppend($data): void
    {

        $node = new Node($data);
        if ($this->head == null) {
            $this->head = $node;
            $this->tail = $node;
        } else {
            $node->next = $this->head;
            $this->head = $node;
        }
    }


    /**
     * Push a new node after the last node (Like array push)
     * @param $data
     * @return void
     */
    public function push($data): void
    {
        $node = new Node($data);


        if ($this->head == null) {
            $this->head = $node;
        } else {
            $this->tail->next = $node;
        }
        $this->tail = $node;

    }

    /**
     * Display all nodes
     * @return void
     */
    public function traverse(): void
    {

        $current = $this->head;

        while ($current) {
            echo $current->data;

            if ($current = $current->next) {
                echo '->';
            }
        }

        echo "<br>";
    }


    /**
     * Search data from Linklist
     * @param $data
     * @return void
     */
    public function search($data) : void {

        $current = $this->head;

        while($current) {

            if($current->data == $data) {
                echo "Data Found -> ". $data;
                return;
            }

            $current = $current->next;
        }

        echo "No Data Found against ->" . $data;
        return;
    }

    /**
     * Find the length of LinkList
     * @return void
     */
    public function length(): void
    {

        $current = $this->head;
        $count = 0;

        while($current) {
            $count++;
            $current = $current->next;
        }

        echo "<br> Length of Link List is ". $count;
    }


    /**
     * Check if Link List is Empty
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->head == null;
    }

    /**
     * Remove a node at the end of the list
     * @return void
     */
    public function unshift() {

        echo "<br>";
        if($this->isEmpty()) {
            echo "Link List is Empty";
            return;
        }

        /**
         * Check if the Link List has only one Noe
         */
        if($this->head == $this->tail) {
            echo $this->head->data . " has removed from Link List";
            $this->head = null;
            $this->tail = null;
            return;
        }

        $current = $this->head;
        while($current->next != $this->tail) {
            $current = $current->next;
        }

        echo $current->next->data . " has been removed from Link List";
        $current->next = null;
        $this->tail = $current;
    }


    /**
     * Search by Data and Removed if found
     * @param $data
     * @return void
     */
    public function removeNodeByData($data): bool
    {

        if($this->isEmpty()) {
            echo "Link List is Empty";
            return false;
        }

        /**
         * Check if Link List has only One Node
         */
        if($this->head == $this->tail) {
            if($this->head->data == $data) {
                $this->head = null;
                $this->tail = null;
                echo $data ." has removed from Link List";
                return true;
            } else {
                echo $data ." not found in the Link List";
                return false;
            }
        }

        /**
         * if link list has more than one node
         */

        $current = $this->head;
        $previous = null;

        while($current) {

            if($current->data == $data) {
                break;
            }

            $previous = $current;
            $current = $current->next;
        }


        /**
         * if Node is not found
         */
        if($current == null) {
            echo $data ." not found in the Link List";
            return false;
        }

        /**
         * if node is the head (first node)
         */
        if($previous == null) {
            $this->head = $current->next;
            echo $data ." has removed from Link List";
            return true;
        } else {

            /**
             * if the node is to be removed is the tial/last node
             */
            if($current->next == null) {
                $this->tail = $current;
            }

            /**
             * If node to be removed is not head nor tail
             */
            $previous->next = $current->next;

            echo $data ." has removed from Link List";
            return true;
        }

    }

    /**
     * Remove element from the head/first node
     * @return bool
     */
    public function popFirst(): bool {

        echo "<br>";
        if($this->isEmpty()) {
            echo "Link List is Empty";
            return false;
        }

        $this->head = $this->head->next;

        echo "First node has removed from Link List";
        return true;
    }
}


$list = new SinglyLinkedList();

$list->push("A");


$list->push("B");
//$list->traverse(); // B -> A

$list->push("C");
$list->preAppend("A0");
//$list->traverse(); // B -> A -> C

//$list->unshift();
//$list->traverse(); // B -> A

//$list->push("D");
//$list->traverse(); // D -> B -> A

//$list->splice("B");
$list->traverse(); // D -> A

//echo $list->length(); // 2

$list->removeNodeByData('A');
//$list->search('A2');
//$list->unshift();
$list->popFirst();
$list->length();
$list->traverse(); // D -> A
