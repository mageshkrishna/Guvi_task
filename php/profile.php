<?php

include('database.php');
require_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username'])) {

        $username = $_POST['username'];

        $filter = ['username' => $username];
       $updateData = [
    '$set' => [
        'contact' => $_POST['contact'],
        'age' => $_POST['age'],
        'email' => $_POST['email']
    ]
];


        $result = $collection->updateOne($filter, $updateData, ['upsert' => true]);


        if ($result->getModifiedCount() > 0) {
            echo "User data updated successfully!";
        } else {
            echo "Failed to update user data.";
        }
    } else {
        echo "Username parameter is not set.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['username'])) {

        $username = $_GET['username'];

       
        $userInfo = $collection->findOne(['username' => $username]);

        if ($userInfo) {

            echo json_encode($userInfo);
        } else {

            echo json_encode(['error' => 'User not found']);
        }
    } else {
        echo "Username parameter is not set.";
    }
} else {
    echo "Invalid request method.";
}
?>
