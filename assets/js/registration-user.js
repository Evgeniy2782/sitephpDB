let form = document.getElementById("form-user-registration");

function getUserFormData() {
    let formData = new FormData(form);
    let userAttributes = {};
    formData.forEach(function (value, key) {
        userAttributes[key] = value;
    });

    return userAttributes;
}

function createUser(userAttributes) {
    $.post("/api/users", userAttributes, (user) => {
        location.pathname = '/users/' + user.id;
    });
}

$(form).on('submit', function(e) {
    e.preventDefault();
    let userAttributes = getUserFormData();

        createUser(userAttributes);
    
});

