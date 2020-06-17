let form = document.getElementById('user-edite-profile1');
let button = document.getElementById("btn");
let userUuidInput = document.getElementById("uuid");
let hasActiveCheckbox = document.getElementById('exampleCheck1');

function getUserFormData() {
    let formData = new FormData(form);
    let userAttributes = {};
    formData.forEach(function (value, key) {
        userAttributes[key] = value;
    });

    if (hasActiveCheckbox) {
        userAttributes.active = userAttributes.active === 'on';
    }
    return userAttributes;
}
/*
function editUser(userAttributes) {
    $.post("/api/users/" + userUuidInput.value, userAttributes, () => {
        location.reload();
    });
}
*/
$(form).on('submit', function(e) {
    e.preventDefault();
   
    let userAttributes = getUserFormData();
     //   editUser(userAttributes);
});




