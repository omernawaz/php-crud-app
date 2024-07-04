function displayUsers(filter_query)
{
    let user = JSON.parse(sessionStorage.getItem('user'));
    
    getUsers(filter_query).done(function (response){
       let users = response;

        for (let i = 0; i < users.length; i++) {

            if(users[i].id == user['id'])
                continue;
                

            let admin_badge = users[i].is_admin ? `<span class="badge bg-success m-3 admin-control">Admin</span>` : '';
            let delete_button = user['is_admin'] && admin_badge === '' ? `<button id="delete-${users[i].id}" class ="btn btn-danger m-1">Delete User</button>` : '';
            let admin_button = user['is_admin'] && admin_badge === '' ? `<button id="admin-${users[i].id}" class ="btn btn-success m-1">Make Admin</button>` : '';

            let html = `
            <div class="card m-1" id='profile-card' style="width:300px">
                <img class="card-img-top" id = 'pfp-image' src="${users[i].pfp_path}" alt="Card image">

                <div class="card-body bg-dark text-white d-flex flex-column">
                    <h4 class="card-title p-1" id ='username-field'>${users[i].name}</h4>
                    <p class="card-text p-1" id ='email-field'>${users[i].email}</p>
                    ${admin_badge}
                    ${delete_button}
                    ${admin_button}
                </div>
            </div>
            `;

            $("#cards-parent").append(html);

            $(`#delete-${users[i].id}`).on('click', function (e) {
                deleteUser(users[i].id);
            });

            $(`#admin-${users[i].id}`).on('click', function (e) {
                makeAdmin(users[i].id);
            });
        }

    });  
}

function clearUsers(){
    $(".card").remove();
}