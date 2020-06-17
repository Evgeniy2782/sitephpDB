let usersListContainer = document.getElementById('users-list');

let defaultPageSize = 6;
let pageSave = 0;

let pathUrl = document.querySelector('.url').getAttribute('data-attr');
let pathUrlProfile = document.querySelector('.urlProfile').getAttribute('data-attr');

function getUsers(limit, page) {
    return $.get(pathUrl, {limit, page});
}

function usersViewHTML(users) {

    let usersList = '';

    users.forEach(user => {
       
        usersList  += `
        
            <div class="card col-4" style="width: 18rem;">
                <img src="${user.image} " width = 10dp; class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${user.login == undefined ? user.item : user.login}</h5>
                    <p class="card-text">${user.right_id == undefined ? user.description : user.right_id}</p>
                    <a href="${pathUrlProfile}${user.id_item == undefined ? user.id_user : user.id_item}" class="btn btn-success">Редактировать</a>                </div>
            </div>`;
    });

    return usersList;
}

function renderUsers(limit, page) {
    pageSave = page;
    getUsers(limit, page).then((users) => {
        let usersHTML = usersViewHTML(users);
        usersListContainer.innerHTML = usersHTML;
    });
}

function renderNextUsers(limit) {
    getUsers(limit, pageSave+=1).then((users) => {
        let usersHTML = usersViewHTML(users);
        usersListContainer.innerHTML = usersHTML;
    });
}

function renderPreviousUsers(limit) {
       if(pageSave > 0)
       getUsers(limit, pageSave-=1).then((users) => {
        let usersHTML = usersViewHTML(users);
        usersListContainer.innerHTML = usersHTML;
    });
}

$('.page-next').on('click', function(e) {
    let params = $(e.target).data();
    renderNextUsers(params.limit);
});

$('.page-previous').on('click', function(e) {
    let params = $(e.target).data();
    renderPreviousUsers(params.limit);
});

$('.page-item').on('click', function(e) {
    let params = $(e.target).data();
    renderUsers(params.limit, params.page);
});

renderUsers(6, 0);





