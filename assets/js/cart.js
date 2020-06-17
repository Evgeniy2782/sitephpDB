let itemsListContainer = document.getElementById('users-list');

function getItems() {
    return $.get('/api/cart/');
}

function itemsViewHTML(items) {

    let itemList = '';

    items.forEach(item => {
        if(item.active == true)
     
        itemList  += `
        
        <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="${item.image}" alt=""></a>
          <div class="card-body">
            <h6>${item.description}</h6>
            <h6>${item.quantity}шт.</h6>
            <h6>${item.price} руб.</h6>
            <h6>Итого:${parseInt(item.price)*item.quantity} руб.</h6>
            <a href="javascript:deleteItemToCart(${item.id_item})" type="button" class="btn btn-outline-primary">Удалить</a>
          </div>
        </div>
      </div>`

    });

    return itemList;
}


function deleteItemToCart(itemID){
  
   return $.ajax({
   type: 'DELETE',
   url: '/api/cart/'+ itemID,

statusCode: {
    200: function(){
        location.reload();
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

function renderItems() {

    getItems().then((items) => {
        let itemsHTML = itemsViewHTML(items);
        itemsListContainer.innerHTML = itemsHTML;
    });
}

renderItems();





