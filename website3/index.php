<?php

  //Message vars
  $msg ='';
  $msgClass ='';
  //Check for submit
  if(filter_has_var(INPUT_POST,'submit')){
   //Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email =  htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //Check required fields
    if(!empty($name) && !empty($email) && !empty($message)){

      //Check email
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        //Failed
        $msg = 'Use a valid email';
        $msgClass = 'alert-danger';
      }else{
        $toEmail = 'suporte_salvador@keepinformatica.com';
        $subject = 'Contact request from ' . $name;
        $body = '<h2>Contact Request</h2>
        <h4>Name</h4><p>'  . $name . '</p>
        <h4>Email</h4><p>'  . $email . '</p>
        <h4>Message</h4><p>'  . $message . '</p>';
      
      
      //Email header
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers += "Content-Type:text/html;charset=UTF-8" . "\r\n";
      $headers += "From: " . $name ."<" . $email . ">"  . "\r\n";
        
        if(mail($toEmail, $subject, $body, $headers)){
          $msg = 'Success';
          $msgClass = 'alert-success';
        }else{
          $msg = 'Failed';
          $msgClass = 'alert-danger';
        }
      }
    }else{
      //Failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
    };
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-3Ivskwia8Fui5tbQi+RW4DgTkJ8d+hW7mLe7Yk89ibmD9482VECh0WFof8kIEjwI"
    crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a href="" class="navbar-brand">My website</a></div>
    </div>
  </nav>
  <div class="container">
    <?php if($msg != ''): ?>
    <div class="alert <?php echo $msgClass; ?>">
      <?php echo $msg; ?>
    </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class=" form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name'])? $name:''; ?>">

        <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email'])? $email:''; ?>">
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea name="message" class="form-control">
          <?php echo isset($_POST['message'])? $message:''; ?>
          </textarea>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  </div>

</body>

</html>