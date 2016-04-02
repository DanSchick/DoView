<?php
include "top.php";


if(isset($_GET['term'])){
    $return_arr = array();
    $term = '%' + $_GET['term'] + '%';
    $search = "SELECT CONCAT(fnkCourseId, ' ', fldCourseName) as FullName FROM tblCourses WHERE FullName LIKE ?";
    $data = array($term);
    $query = $thisDatabaseReader->select($search, $data, 1, 0, 4);

    if($query){
        foreach ($query as $class){
            $return_arr[] = $class[0];
        }
    }

    echo json_encode($return_arr);
}









