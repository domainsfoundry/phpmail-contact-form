<!doctype html>
<html>

<head>
  <meta charset="utf-8">
    <title>An example of a simple Contact Form using PHP mail() function</title>
</head>
<body>
  <?php
  
  // The email address where the message will be sent to. Can be any email address.
  $to = "hello@example.com";
  
  // The email address the message will be sent from. Must be an email created in cPanel.
  $from = "postmaster@example.com";
  
  //The subject of your email message.
  $subject    = "An example of a simple Contact Form using PHP mail() function";
  
  // If the email contains HTML. Set to falkse if plain-text.
  $send_html  = true;
  
  
  $headers = "From: $from" . "\r\n";
  
  // Always set content-type when sending HTML email
  if ( $send_html ) {
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  }
  
  if ( isset( $_POST['submit'] ) ) {
    
    //send email
    $email    = $_POST['email'];
    $name     = $_POST['name'];
    $message  = $_POST['message'];
    
    if ( $send_html ) {
      
      
      //Build html message
      
      ob_start();
      ?>
      <p>Congratulations! You've received a new message from your Contact Form using the PHP mail() function.</p>
      <?php if ( ! empty( $name ) ) :?>
        <p>Name: <?= $name;?></p>
      <? endif; ?>
      <?php if ( ! empty( $email ) ) :?>
        <p>Email: <?= $email;?></p>
      <? endif; ?>
      <?php if ( ! empty( $message ) ) :?>
        <p><?= $message;?></p>
      <? endif; ?>
      
      <?php
      $msg = ob_get_clean();
      
    } else {
      
      //Build plain text message
      if ( ! empty( $name ) ) {
        $msg = "Name: ".$name."\n\n";
      }
      if ( ! empty( $email ) ) {
        $msg .= "Email: ".$email."\n\n";
      }
      if ( ! empty( $message ) ) {
        $msg .= $message;
      }
    }
    
    /*
     * use php mail() function to sent email
     * syntax mail(to,subject,message,headers,parameters);
     */
    mail( $to, $subject, $msg, $headers);
    echo "Your message was sent successfully!";
  } else {  
    //if "email" is not filled out, display the form
    ?>
    
    <form method="post">
      <input name="redirect" type="hidden" value="myform.php" >
      <fieldset>
        <legend>Example Contact Form</legend>
        <dl>
          <dt><label for="name">Name</label></dt>
          <dd><input type="text" name="name"/></dd>
          <dt><label for="email">E-mail</label></dt>
          <dd><input type="text" name="email"/></dd>
          <dt><label for="message">Comments</label></dt>
          <dd><textarea name="message"></textarea></dd>
        </dl>
        <input type="submit" name="submit" value="Submit"/>
      </fieldset>
    </form>
    
    <?php
  }
  ?>
</body>

</html>
