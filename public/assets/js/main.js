window.onload = function (){

    url=window.location.href+"/";

    if(url.indexOf("product")!= -1 || url.indexOf("admin/product")!= -1){

        console.log("usao u product ili  admin product")

        $(".page-link").click(showMore);
        $(".categories").click(sortAndFilter);
        $(".sort").click(sortAndFilter);
        $(document).on("click",".deleteProduct", deleteProduct);


        $(".search").keyup(search);


    }

    if(url.indexOf("admin/users")!= -1){

        console.log("usao u users")


        $(".page-link").click(showMoreUsers);
        $(".sort").click(sortAndFilterUsers);
        $(document).on("click",".deleteUser", deleteUser);


        $(".search").keyup(searchUsers);


    }

    if(url.indexOf("activity")!= -1){
        console.log("usao u activity")
        $(".page-link").click(showMoreActivities);
        $(".date").change(showActivitiesByDate);
        $(document).on("click",".deleteActivity", deleteActivity);
    }

};

/*****************************         AKTIVNOSTI        ************************************/

var dateOfActivity;
var page;

function showMoreActivities(e){
    e.preventDefault();
    page = this.innerText;
    getFilteredActivities(page, dateOfActivity);
    $(".deleteActivity").click(deleteActivity);
}

function showActivitiesByDate() {
    dateOfActivity = $(this).val();
    getFilteredActivities(1, dateOfActivity);
}

function getFilteredActivities(page, dateOfActivity){

    const caller = arguments.callee.caller.name;
    console.log(caller);
    $.ajax({
        url: "users/activity/1/filtered",
        method: "GET",
        data: {
            page, dateOfActivity
        },
        dataType: "JSON",
        success: function (response) {

            showActivitiesForAdmin(response.data);

            if(caller == 'showActivitiesByDate'){
                changePagination(response.last_page, response.current_page, showMoreActivities);
            }
            if(caller == 'showMoreActivities'){
                changePagination(response.last_page, response.current_page, showMoreActivities);
                changeActivePageLink(response.current_page);
            }
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(data);

        }
    });
}

function deleteActivity(){
    let id = $(this).val();
    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    $.ajax({
        url: "/users/activity/"+id,
        method: "POST",
        headers:{
            "Accept":"application/json"
        },
        data: {
            "_token": csrf,
            "_method": "DELETE"
        },
        success: function () {
            $("#a_id_"+id).remove();
            $(".greskaAdmin").html("<div class='alert alert-success my-3'>Uspesno brisanje aktivnosti.</div>")
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(xhr);
            console.log(data);
            $(".greskaAdmin").html("<div class=\"alert alert-danger my-3\">Doslo je do greske prilikom brisanja aktivnosti.</div>")
        }
    });
}

function showActivitiesForAdmin(products){
    let html = "";

    function ispisDatum(datum){
        d = new Date(datum);
        var dat = d.getDate();
        var mes = d.getMonth() + 1;
        var god = d.getFullYear();

        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();

        var dateStr = dat + "." + mes + "." + god+"."+ " "+ h +":"+m +":"+ s;
        return dateStr;
    }
    for(let p of products) {
        html += `
        <tr id="a_id_${p.id}">
            <td>${p.id}</td>
            <td>${p.activity}</td>
            <td>${ispisDatum(p.lDate)}</td>
            <td>`;
        html+=`<input type="hidden" name="_token" value="${csrf}"/>
                    <button type="submit" class="btn btn-outline-secondary deleteActivity" value="${p.id}">Obriši</button>`;
        html+=`</td>

        </tr>`;
    }
    $("#adminAktivnosti").html(html);
}

/*****************************         KORISNICI        ************************************/


var usrSortValue;
var usrSortColumn;
var uName;

function getFiltersForUsers(){
    usrSortValue = $("input[name='sort']:checked").val();
    usrSortColumn = $("input[name='sort']:checked").data('id');
}


function showMoreUsers(e){
    getFiltersForUsers();
    e.preventDefault();
    page = this.innerText;
    getFilteredUsers(page, usrSortValue , usrSortColumn, uName);
    $(".deleteUser").click(deleteUser);
}

function sortAndFilterUsers() {
    getFiltersForUsers();
    getFilteredUsers(1, usrSortValue , usrSortColumn, uName);
}

function searchUsers(){
    getFiltersForUsers();
    uName = $(this).val();
    getFilteredUsers(1 ,usrSortValue ,usrSortColumn, uName);
}

function getFilteredUsers(page, usrSortValue , usrSortColumn, uName){

    const caller = arguments.callee.caller.name; //koja funkcija je pozvala
    console.log(caller);
    $.ajax({
        url: "users/filtered",
        method: "GET",
        data: {
            page, usrSortValue , usrSortColumn, uName
        },
        dataType: "JSON",
        success: function (response) {

            showUsersForAdmin(response.data);

            if(caller == 'sortAndFilterUsers' || caller=='searchUsers'){
                changePagination(response.last_page, response.current_page, showMoreUsers);
            }
            if(caller == 'showMoreUsers'){
                changePagination(response.last_page, response.current_page, showMoreUsers);
                changeActivePageLink(response.current_page);
            }
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(data);

        }
    });
}

function deleteUser(){
    let id = $(this).val();
    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    $.ajax({
        url: "users/"+ id,
        method: "POST",
        headers:{
            "Accept":"application/json"
        },
        data: {
            "_token": csrf,
            "_method": "DELETE"
        },
        success: function () {
            $("#u_id_"+id).remove();
            $(".greskaAdmin").html("<div class='alert alert-success my-3'>Uspesno brisanje korisnika.</div>")
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(xhr);
            console.log(data);
            $(".greskaAdmin").html("<div class=\"alert alert-danger my-3\">Doslo je do greske prilikom brisanja korisnika.</div>")
        }
    });
}

function showUsersForAdmin(products){
    let html = "";

    function ispisDatum(datum){
        d = new Date(datum);
        var dat = d.getDate();
        var mes = d.getMonth() + 1;
        var god = d.getFullYear();

        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();

        var dateStr = dat + "." + mes + "." + god+"."+ " "+ h +":"+m +":"+ s;
        return dateStr;
    }
    for(let p of products) {
        html += `
        <tr id="product_id_${p.id}">
            <td>${p.id}</td>
            <td>${p.uName}</td>
            <td>${p.uEmail}</td>
            <td>${p.uPass}</td>
            <td>${p.uStatus == 1 ? "Aktivan" : "Deaktiviran"}</td>
            <td>${ispisDatum(p.uRegistered)}</td>
            <td>${p.uAdmin == 1 ? "Da" : "Ne"}</td>


            <td colspan="2">
                <a href="users/${p.id}/activity" class="btn btn-outline-secondary" role="button">Aktivnost</a>

            </td>
            <td colspan="">
                <a href="users/${p.id}/edit" class="btn btn-outline-secondary" role="button">Izmeni</a>

            </td>
            <td>`;
        html+=`<input type="hidden" name="_token" value="${csrf}"/>
                    <button type="submit" class="btn btn-outline-secondary deleteUser" value="${p.id}">Obriši</button>`;
        html+=`</td>

        </tr>`;
    }
    $("#adminKorisnici").html(html);
}




/*****************************         PROIZVODI        ************************************/


var categories = [];
var sortValue;
var sortColumn;
var productName;

function getFilters(){
    categories = [];
    sortValue = $("input[name='sort']:checked").val();
    sortColumn = $("input[name='sort']:checked").data('id');
    $.each($("input[name='categories']:checked"), function(){
        categories.push($(this).val());
    });
}

function showMore(e){
    getFilters();
    e.preventDefault();
    page = this.innerText;
    getFiltered(page,categories,sortValue, sortColumn, productName);
    $(".deleteProduct").click(deleteProduct);
}

function sortAndFilter() {
    getFilters();
    getFiltered(1, categories,sortValue, sortColumn, productName);
}

function search(){
    getFilters();
    productName = $(this).val();
    getFiltered(1 ,categories,sortValue, sortColumn, productName);
}

function getFiltered(page, categories, sortValue, sortColumn, productName){

    const caller = arguments.callee.caller.name; //koja funkcija je pozvala
    console.log(caller);
    $.ajax({
        url: "product/filtered",
        method: "GET",
        data: {
            page, categories, sortValue, sortColumn, productName
        },
        dataType: "JSON",
        success: function (response) {

            showProducts(response.data);
            showProductsForAdmin(response.data);

            if(caller == 'sortAndFilter' || caller=='search'){
                changePagination(response.last_page, response.current_page, showMore); // ovde umesto show more stavis show more users/activity
                //changeActivePageLink(response.current_page); razmisljam sta je jos trebalo da zapisem
                //odvoj kod

            }
            if(caller == 'showMore'){
                changePagination(response.last_page, response.current_page, showMore);
                changeActivePageLink(response.current_page);
            }
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(data);

        }
    });
}

function deleteProduct(){
    let id = $(this).val();
    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    $.ajax({
        url: "products/"+ id,
        method: "POST",
        headers:{
        "Accept":"application/json"
        },
        data: {
            "_token": csrf,
            "_method": "DELETE"
        },
        success: function () {
            $("#product_id_"+id).remove();
            $(".greskaAdmin").html("<div class='alert alert-success my-3'>Uspesno brisanje proizvoda.</div>")
        },
        error: function (err, xhr, data){
            console.log(err);
            console.log(xhr);
            console.log(data);
            $(".greskaAdmin").html("<div class=\"alert alert-danger my-3\">Doslo je do greske prilikom brisanja proizvoda.</div>")
        }
    });
}


function changePagination(totalLinks, currentPage, onClick){
    let html = "";
    for(let i = 1; i <= totalLinks; i++){
        if(i != currentPage){
            html += `<li class="page-item"><a class="page-link" id="link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }else{
            html += `<li class="page-item active"><a class="page-link" id = "link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }
    }
    $(".pagination").html(html);
    $(".page-link").click(onClick);
}

function changeActivePageLink(currentPage){
    $('.page-item').removeClass('active');
    $('#link' + currentPage).parent().addClass('active');
}




function showProducts(products){
    let html = "";
    for(let product of products) {
        html += `
            <div class="col-lg-4 col-md-6 my-4">
                <div class="card h-100">
                  <a href="product/${product.id}"><img class="card-img-top" src="`;

        if(product.pImg != null){
            html+=`assets/img/product/${product.pImg}`;
        }else{
            html+=`assets/img/default.jpg`;
        }

            html+=`" alt="${product.pName}"></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="product/${product.id}">${product.pName}</a>
                      <p class="card-text"><small class="text-muted">${product.pEngName}</small></p>
                    </h4>
                    <h5>${product.price} din.</h5>
                    </div>
                    </div>
                </div>`;
    }
    $("#proizvodi").html(html);
}

let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showProductsForAdmin(products){
    let html = "";
    for(let p of products) {
        html += `
        <tr id="product_id_${p.id}">
            <td>${p.id}</td>
            <td>${p.pName}</td>
            <td>${p.pEngName}</td>
            <td>${p.price} din.</td>
            <td>${p.categories.cName}</td>
            <td colspan="1">
                <a href="products/${p.id}/edit" class="btn btn-outline-secondary" role="button">Izmeni</a>

            </td>
            <td>`;
/*                <form method="POST" action="products/${p.id}?_method=DELETE">
                <input type="hidden" name="_method" value="DELETE"/>*/
                html+=`<input type="hidden" name="_token" value="${csrf}"/>
                    <button type="submit" class="btn btn-outline-secondary deleteProduct" value="${p.id}">Obriši</button>`;
/*                </form>*/
            html+=`</td>

        </tr>`;
    }
    $("#adminProizvodi").html(html);
}
