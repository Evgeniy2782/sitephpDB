<link rel="stylesheet" href="/assets/css/profile_bootstrap.min.css"/>
<link rel="stylesheet" href="/assets/css/profile_font-awesome.min.css" />
<link rel="stylesheet" href="/assets/css/styleProfile.css"/>
<script src="/assets/js/profile_jquery-1.11.3.min.js"></script>
<script src="/assets/js/profile_bootstrap.min.js"></script>

<br><br><br>

<div class="container">
<div id="main">

 <div class="row" id="real-estates-detail">
 <div class="col-lg-4 col-md-4 col-xs-12">
 <div class="panel panel-default">
 <div class="panel-heading">
 <header class="panel-title">
 <div class="text-center">
  <strong>Пользователь сайта</strong>
 </div>
 </header>
 </div>
 
 <strong>
  <form method = "post" >
    <div class="form-group">
    <div class="panel-body">
 <div class="text-center" id="author">
 <img src="<?= $user["image"]; ?>"width = 100% >
 <!--<img src="/assets/img/funny.jpg" width = 100% >-->
      </div>
    </form>
 </strong> 
 </div>
 </div>
 </div>
 </div>
 <div class="col-lg-8 col-md-8 col-xs-12">
 <div class="panel">
 <div class="panel-body">
 <ul id="myTab" class="nav nav-pills">
 <li class="active1"><H4>Профиль пользователя</H4></li>
 </ul>
 <div id="myTabContent" class="tab-content">
<hr>
 <div class="tab-pane fade active in" id="detail">
   
  <form id = "user-edite-profile" 
  method = "post"
  enctype="multipart/form-data"
  action="/api/users/<?=$user["id_user"];?>"
  >

    <div class="form-group">
      </div>
      <div class="form-group">
        <label for="email">id</label>
        <input type="text" class="form-control" disabled id="uuid" name="uuid" value="<?= $user["id_user"]; ?>">
      </div>

      <div class="form-group">
        <label for="right">Right</label>
        <input type="text" name="right" class="form-control" disabled id="right" value="<?= $user["right_id"]; ?>" >
      </div>

      <div class="form-group">
        <label for="login">Login</label>
        <input type="email" name="login" class="form-control" id="login" value="<?= $user["login"]; ?>" >
      </div>

      <div class="form-group">
        <label for="password">Введите новый пароль</label>
        <input type="password" name="password" class="form-control" id="password" value = "" autocomplete="off"> 
      </div>
      
      <div class="form-group">
      <input 
      type="file" 
      class="form-control-file" 
      id="img"
      name="picture">
      <label for="img">Загрузить фото</label>
      </div>

      <div class="form-group form-check">
            <label class="form-check-label" for="exampleCheck1">Active-</label>
            <input type="checkbox" name="active" class="form-check-input" id="exampleCheck1" <?php if ($user["active"]) echo "checked" ?>>
        </div>
     
      <button type="submit" class="btn btn-primary" >Редактировать</button>
     

      <?php if($user['right_id'] == "admin"){?>
      <a href="/users" class="btn btn-primary">usersEdite</a>
      <a href="/addItem" class="btn btn-primary">addItem</a>
      <a href="/itemsEdit" class="btn btn-primary">itemEdit</a>
      <?php }?>
  
 </div>
 <div class="tab-pane fade" id="contact">
 <p></p>
 
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
</div>

</div><!-- /.main -->
</div><!-- /.container -->

