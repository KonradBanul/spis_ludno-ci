<?php
    class Db {
        private $dbHost;
        private $dbUser;
        private $dbPass;
        private $dbName;
        private $conn;
        
        function __construct() {
            $this->dbHost = 'host-kb.localhost';
            $this->dbUser = 'root';
            $this->dbPass = 'root';
            $this->dbName = 'peopledb';

            $this->conn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass);
            mysqli_select_db($this->conn, $this->dbName);
        }

        function add($table, $values) {
            $set = '';
            $names = '';
            foreach($values as $name=>$value) {
                $set .= "'$value',";
                $names .= "$name,";
            }
            $set = substr($set, 0, -1);
            $names = substr($names, 0, -1);
            return $this->conn->query("INSERT INTO $table ($names) VALUES ($set)") === TRUE;
        }

        function get($table, $id) {
            $select = $this->conn->query("SELECT * FROM $table WHERE id=$id");
            return $select->fetch_assoc();
        }

        function list($table, $order = []) {
            $orderString = '';
            if(!empty($order)){
                $orderBy = " ORDER BY ";
                foreach($order as $name => $value) {
                    if(empty($value)) continue;
                    $orderString .= "$name $value, ";
                }
                if(!empty($orderString)) $orderString = $orderBy . $orderString;
                $orderString = substr($orderString, 0, -2);
            }
            $select = $this->conn->query("SELECT * FROM $table $orderString");
            while($row = $select->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }

        function delete($table, $id) {
            return $this->conn->query("DELETE FROM $table WHERE id=$id") === TRUE;
        }

        function update($table, $values, $id) {
            $set = '';
            foreach($values as $name=>$value) {
                $set .= "$name='$value',";
            }
            $set = substr($set, 0, -1);
            return $this->conn->query("UPDATE $table SET $set WHERE id=$id") === TRUE;
        }
    }
    