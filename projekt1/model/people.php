<?php 

    class People {

        public $data = [];

        private function generateID() {
            $id = count($this->data)+1;
            foreach ($this->data as $human) {
                if($human['id'] >= $id) {
                    $id = $human['id'] + 1;
                }
            }
            return $id;
        }

        function getData() {
            return $this->data;
        }

        public function addPeople($people) { 
            if(empty($people['id'])) {
                $people['id'] = $this->generateID();
            }
            $this->data[] = $people;
        }

        public function save() {
            // file_put_contents('model/people.json',  serialize($this->data));

            $filename = 'model/people.csv';
            $fp = fopen($filename, 'w');
            fwrite($fp, "ID;Imie;Nazwisko;Adres;E-mail\n");
            foreach ($this->data as $row) {
                $line = $row['id'].';'.$row['imie'].';'.$row['nazwisko'].';'.$row['adres'].';'.$row['email']."\n";
                fwrite($fp, $line);
            }
            fclose($fp);
        }

        public function findById($id) {
            foreach ($this->data as $i => $row) {
                if ($row['id'] == $id) {
                    return $row;
                }
            }
            return [];
        }

        public function deleteRecord($id) {
            foreach ($this->data as $i => $row) {
                if ($row['id'] == $id) {
                    unset($this->data[$i]);
                    break;
                }
            }
            $this->save();
        }

        public function editPeople($id, $newArray) {
            foreach ($this->data as $i => $row) {
                if ($row['id'] == $id) {
                    $this->data[$i] = $newArray;
                    $this->data[$i]['id'] = $id;
                    break;
                }
            }
            $this->save();
        }

        public function load() {
            $this->data = [];
            // if (is_file('model/people.json')) $this->data = unserialize(file_get_contents('model/people.json'));

            if (is_file('model/people.csv')) {
                $people = file('model/people.csv');
                foreach ($people as $i => $line) {
                    if ($i <= 0) continue;
                    $t = str_getcsv($line,';');
                    $this->data[] = ['id' => $t[0], 'imie' => $t[1], 'nazwisko' => $t[2], 'adres' => $t[3], 'email' => $t[4]];
                }
            }
        }
    }
     
    
    

