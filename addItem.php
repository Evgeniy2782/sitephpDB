<link rel="stylesheet" href="assets/css/bootstrap.css"/>

<div class = "container">
<h2>Добавте товар</h2>
<form id = "form-addItem" 
method="post" 
action="/api/items"
enctype="multipart/form-data">
<div class="form-group">
  </div>

  <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">User picture</span>
            </div>
            <div class="custom-file">
                <input type="file"
                       class="custom-file-input"
                       id="inputGroupFile01"
                       name="picture"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
      
  <div class="form-group">
    <label for="item">Наименование товара</label>
    <input name="item" type="text" class="form-control" id="item" placeholder="Введите наименование товара" value="">
  </div>

  <div class="form-group">
    <label for="description">Описание товара</label>
    <input name="description" type="text" class="form-control" id="description" placeholder="Описание товара" value="">
  </div>


  <div class="form-group">
    <label for="price">Цена товара</label>
    <input name="price" type="number" class="form-control" id="price" placeholder="Описание товара" value="">
  </div>
 
  <button type="submit" class="btn btn-primary">Добавить товар</button>

</form>
</div> 

