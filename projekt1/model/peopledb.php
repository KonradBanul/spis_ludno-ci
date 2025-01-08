<?php
    
    class PeopleDB {

        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        public function findById($id) {
            $row = $this->db->get('people', $id);
            return $row;
        }

        public function getData() {
            return $this->db->list('people');
        }

        public function addPeople($people) {
            $this->db->add('people', $people);
            // $this->data[] = $people;
        }

        public function save() {
           // $people = $this->db->list('people');
           // $this->data = $people;
        }

        public function deleteRecord($id) {
            $this->db->delete('people', $id);
            // foreach($this->data as $index=>$row) {
            //     if($row['id'] == $id) {
            //         unset($this->data[$index]);
            //         break;
            //     }
            // }
        }

        public function editPeople($id, $newArray) {
            $this->db->update('people', $newArray, $id);
            // foreach($this->data as $index=>$row) {
            //     if($row['id'] == $id) {
            //         $this->data[$index] = $newArray;
            //         $this->data[$index]['id'] = $id;
            //         break;
            //     }
            // }
        }

        public function load() {
        //    $people = $this->db->list('people');
        //    $this->data = $people;
        }
    }