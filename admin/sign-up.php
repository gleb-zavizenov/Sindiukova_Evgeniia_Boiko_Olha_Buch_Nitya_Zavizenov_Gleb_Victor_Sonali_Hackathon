<?php


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
        $update_query = 'UPDATE tbl_subscribers SET email = :email, last_update_date = now() WHERE id = :id';
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

    
    if(mail($to, $subject, $message, $headers)) {
        echo "I sent you an email";
    } else{
        echo "Mail Not Sent";
    };


    // add redirect back to index.html
    header('Refresh:5; url=index.html');
    exit;
       

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
        if(mail($to, $subject, $message, $headers)) {
            echo "I sent you an email";
        } else{
            echo "Mail Not Sent";
        };

        // add redirect back to index.html
        header('Refresh:5; url=index.html');
        exit;
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
