<?php
    session_start();
    $auth=$_SESSION['auth'];
    $arr=array(1,2);
    if(!in_array($auth,$arr)){
        header('location:../login/login.php');
    }
    include('../DBConnection.php');
    if(isset($_GET['search'])){
        $keyword = $_GET['keyword'];
        $fetchData = fetch_data($conn,$keyword);
    }else{
        $keyword = "";
        $fetchData = fetch_data($conn,$keyword);
    }
    function fetch_data($conn,$keyword){
        if(!empty($keyword)){
            $query="SELECT * from stock WHERE menu_name like "."'".$keyword."%'"." ORDER BY menu_id ASC";
        }else{
            $query="SELECT * from stock ORDER BY menu_id ASC";
        }
        $exec=mysqli_query($conn,$query);
        if(mysqli_num_rows($exec)>0){
            $row=mysqli_fetch_all($exec,MYSQLI_ASSOC);
            return $row;
        }else{
            return $row=[];
        }
    }
?>
