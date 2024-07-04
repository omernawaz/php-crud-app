function getUsers(filter_query)
{
    return $.ajax({
        type: "POST",
        url: "../../php/actions/get-user.php",
        data: {
            id: '*',
            filter: filter_query
        },
        dataType: "json",
    });
}


$(document).ready(function () {
    
    let html = `
        <form class="d-flex" id = 'filter'>
            <input class="form-control me-2" type="text" name = 'filter' placeholder="Search">
            <button class="btn btn-primary" id='btn-filter' type="submit">Search</button>
        </form>
      `
    $(".navbar").append(html);

    $("#filter").submit(function (e) {
        let formData = new FormData(this);
        let filter_query = formData.get('filter');
        e.preventDefault();
        console.log("Users Cleared" + filter_query);
        clearUsers();
        displayUsers(filter_query);
    });
});