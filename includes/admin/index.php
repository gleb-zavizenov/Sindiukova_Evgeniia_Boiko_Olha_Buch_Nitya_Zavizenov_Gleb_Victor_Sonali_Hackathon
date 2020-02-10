<?php

require_once '../load.php';



function update_db($first_name,$last_name, $email, $country) {
    $pdo = Database::getInstance()->getConnection();

    $check_user_exist = 'SELECT * FROM tbl_subscribers WHERE first_name = :first_name AND last_name = :last_name AND country = :country';
    $user_set = $pdo->prepare($check_user_exist);
    $user_set->execute(
        array(
            ':first_name'=>$first_name,
            ':last_name'=>$last_name,
            ':country'=>$country
        )
    );

    if($user_update = $user_set->fetch(PDO::FETCH_ASSOC)){
        $id= $user_update['id'];
        $update_query = 'UPDATE tbl_subscribers SET email = :email WHERE id = :id';
        $update_set = $pdo->prepare($update_query);
        $update_set->execute(
            array(
            ':email'=>$email,
            ':id'=>$id
            )

        );

    $to = $email;
    $subject = "Email Ubdated";
    $message = "You email was updated to " . $email;
    $headers = [
        'From'=>'ontatiosummer@test.ca',
        'Reply-To'=>$first_name . ' ' . $last_name.'<'.$email.'>'
    ];
    mail($to, $subject, $message, $headers);


       

    } else {
        $sql = 'INSERT INTO tbl_subscribers (first_name, last_name, email, country) VALUES (:first_name, :last_name, :email, :country)';
        $sql_set = $pdo->prepare($sql);
        $sql_set->execute(
            array(
            ':first_name'=>$first_name,
            ':last_name'=>$last_name,
            ':email'=>$email,
            ':country'=>$country
            )
        );

        $to = $email;
        $subject = "Welcome " . $first_name;
        $message = "Your account was created with " . $email;
        $headers = [
            'From'=>'ontatiosummer@test.ca',
            'Reply-To'=>$first_name . ' ' . $last_name.'<'.$email.'>'
        ];
        mail($to, $subject, $message, $headers);
    } 
}

if(isset($_POST['submit'])) {
    $first_name=trim($_POST['first_name']);
    $last_name=trim($_POST['last_name']);
    $email=trim($_POST['email']);
    $country=trim($_POST['country']);

    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($country)) {
        update_db($first_name,$last_name, $email, $country);
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ontario Thing</title>
</head>
<body>
<section id="form">
<form  action="index.php" method="POST">
<label>First Name:</label>
<input type='text' name="first_name" id="first_name">
<label>Last Name:</label>
<input type='text' name="last_name" id="last_name">
<label>Email Adress:</label>
<input type='email' name="email" id="email">
<label>Country:</label>
<input type='text' name="country" id="country">
<button name="submit">Submit</button>
</form>

</section>

    
</body>
</html>