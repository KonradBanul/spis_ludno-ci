<?php 
    $pages = ['home', 'form', 'omnie', 'jeremi'];
    $page = 'home';
    if (isset($_GET['page'])) $page = $_GET['page'];
    if (isset($_POST['page'])) $page = $_POST['page'];
    if (!in_array($page, $pages)) $page = $pages[0];

    require_once('model/people.php');
    require_once('model/db.php');
    require_once('model/peopledb.php');

    $db = new Db();
    $obiekt = new PeopleDB($db);
    $obiekt->load();

    if (!empty($_GET['listPeople'])) {
        $data = $obiekt->getData();
        $rows = include_once('views/rows.php');
        exit;
    }

    if (!empty($_GET['allPeople'])) {
        $order = $_POST['order'] ?? [];
        $data = $db->list('people', $order);
        $rows = include_once('views/rows.php');
        exit;
    }

    $row = [];
    if (!empty($_GET['editPeopleID'])) {
        $row = $obiekt->findById($_GET['editPeopleID']);
    } 

    if (!empty($_GET['editPeopleIDJS'])) {
        $row = $obiekt->findById($_GET['editPeopleIDJS']);
        $r = json_encode($row);
        print_r($r);
        exit;
    } 

    if (!empty($_GET['removePeopleID'])) {
        $obiekt->deleteRecord($_GET['removePeopleID']);
    }

    if (!empty($_POST['addPeople']) || !empty($_GET['addPeople'])) {
        $id = $_POST['id'] ?? 0;
        $r = ['imie'=>$_POST["imie"], 'nazwisko'=>$_POST["nazwisko"], 'adres'=>$_POST["adres"], 'email'=>$_POST["email"]];
        if ($id > 0) {
            $obiekt->editPeople($id, $r);
        } else {
            $obiekt->addPeople($r);
            if (isset($_GET['addPeople'])) exit;
        }
        $obiekt->save();
    }

    require_once('views/header.php');
    require_once('views/'.$page.'.php');
    require_once('views/footer.php');
?>
