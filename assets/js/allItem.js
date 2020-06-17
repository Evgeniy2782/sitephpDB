let itemsListContainer = document.getElementById('users-list');
let pathUrl = document.querySelector('.url').getAttribute('data-attr');

let defaultPageSize = 6;
let pageSave = 0;

function getItems(limit, page) {
    return $.get(pathUrl, {limit, page});
}

function itemsViewHTML(items) {

   let header = `
   <div class="container">
   <div class = "jumbotron">
      <h1 class="display-6 text-center" >My shop</h1>
      <p class = "lead text-center">Information</p>
    </div>
  
      <div class="col-lg-12 md-5">

        <div class="row">
  `

    let itemList = '';

    items.forEach(item => {
        if(item.active == true)
     
        itemList  += `
        
        <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="${item.image}" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <h4>
                  <?=$user["login"];?>
            </h4>
            <p class="card-text">${item.description}</p>
            <h6>${item.price} руб.</h6>
            <a href="javascript:addItemToCart(${item.id_item})" type="button" class="btn btn-outline-primary">В корзину</a>
          </div>
        </div>
      </div>`

    });

    return header + itemList;
}


function addItemToCart(cart){

    return $.ajax({
    type: 'POST',
    url: '/api/cart/'+ cart,
 
 statusCode: {
     200: function(){
        alert('Товар добавлен в корзину!');
     },
     404: function(){
         console.log('error: 400');
     },
     500: function(){
        console.log('error: 500');
     }
 }
 
    });
 
}

function renderItems(limit, page) {
    pageSave = page;
    getItems(limit, page).then((items) => {
        let itemsHTML = itemsViewHTML(items);
        itemsListContainer.innerHTML = itemsHTML;
    });
}

function renderNextItems(limit) {
    getItems(limit, pageSave+=1).then((items) => {
        let itemsHTML = itemsViewHTML(items);
        itemsListContainer.innerHTML = itemsHTML;
    });
}

function renderPreviousItems(limit) {
       if(pageSave > 0)
       getItems(limit, pageSave-=1).then((items) => {
        let itemsHTML = itemsViewHTML(items);
        itemsListContainer.innerHTML = itemsHTML;
    });
}

$('.page-next').on('click', function(e) {
    let params = $(e.target).data();
    renderNextItems(params.limit);
});

$('.page-previous').on('click', function(e) {
    let params = $(e.target).data();
    renderPreviousItems(params.limit);
});

$('.page-item').on('click', function(e) {
    let params = $(e.target).data();
    renderItems(params.limit, params.page);
});

renderItems(6, 0);






