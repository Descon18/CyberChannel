<?php
   require "db.php"
?>
<?php
   $data = $_POST;
   if( isset($data['do_signup']) )
   {

      $errors = array();
      if( trim($data['login']) == '' )
      {
      	$errors[] = 'Введите логин!';
      }

      if( trim($data['email']) == '' )
      {
      	$errors[] = 'Введите Email!';
      }      

      if( $data['password'] == '' )
      {
      	$errors[] = 'Введите пароль!';
      }

      if( $data['password2'] != $data['password'] )
      {
      	$errors[] = 'Пароли не совпадают!';
      }

      if( R::count('users', "login = ?", array($data['login'])) > 0 )
      {
      	$errors[] = 'Пользователь с таким логином уже  зарегистрирован!';
      }      

      if( R::count('users', "email = ?", array($data['email'])) > 0 )
      {
      	$errors[] = 'Пользователь с таким Email уже зарегистрирован!';
      }    

      if( empty($errors) )
      {

        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        R::store($user);
        echo '<div style="color: red;">Возникла ошибка, сообщите администиратору!</div><hr>';

      } else {
      	   echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
      	}
      }
      
      
?>

<html>
<div align=center class="form">
<form action="/index.php" method="POST">
	
     <p>
   	   <p><strong>Логин:</strong></p>
   	   <input type="text" name="login" value="<?php echo @$data['login']; ?>">
     </p>

      <p>
   	   <p><strong>Email:</strong></p>
   	   <input type="text" name="email" value="<?php echo @$data['email']; ?>">
     </p>

      <p>
   	   <p><strong>Пароль:</strong></p>
   	   <input type="password" name="password" value="<?php echo @$data['password']; ?>">
     </p>

      <p>
   	   <p><strong>Повторите пароль:</strong></p>
   	   <input type="password" name="password2" value="<?php echo @$data['password2']; ?>">
     </p>

     <p>
     	<p>
     	<button type="submit" name="do_signup">Зарегистрироваться</button>
        </p>
     </p>

</form>
</div>