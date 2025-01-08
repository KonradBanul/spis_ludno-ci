const toastLiveExample = document.getElementById('mainToast');
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
$("#addbtnjs").on('click', () => {
    $(".toast-body").html("Wiersz został dodany!");
    toastBootstrap.show();
})
$("#colorbtn").on('click', () => {
    $(".toast-body").html("Tło zostało zmienione!");
    toastBootstrap.show();
})

function clock() {
    let time = new Date();
    let hour = time.getHours();
    if (hour<10) hour = "0"+hour;
    let minute = time.getMinutes();
    if (minute<10) minute = "0"+minute;
    let second = time.getSeconds();
    if (second<10) second = "0"+second;
    $("#clock").html(hour+":"+minute+":"+second);
    //document.getElementById('clock').innerHTML = hour+":"+minute+":"+second;
    setTimeout("clock()", 1000);
}

if(localStorage.getItem("bgColor")) {
    document.body.style.background = localStorage.getItem("bgColor");
}

function changeColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i=0;i<6;i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    document.body.style.background = color;
    localStorage.setItem("bgColor", color);
}

function changeDolor() {
    let lorem = document.getElementById("lorem").innerHTML;
    let bold = lorem.replace(/\bdolor\b/g, '<span class="bold">dolor</span>');
    document.getElementById("lorem").innerHTML = bold;
}
changeDolor();

function changeAmet() {
    let lorem = document.getElementById("lorem").innerHTML;
    let red = lorem.replace(/\bamet\b/g, '<span class="red">amet</span>');
    document.getElementById("lorem").innerHTML = red;
}
changeAmet();

// function deleteRow(id) {
//     if (confirm("Czy na pewno chcesz usunąć wiersz?")) {
//         var xhttp = new XMLHttpRequest();
//         xhttp.open("POST", "index.php?page=home&removePeopleID=" + id, true);
//         xhttp.send();
//         xhttp.onload = function() {
//             fetchRows(); 
//         }
//     }
// }

function deleteRow(id) {
    if (confirm("Czy na pewno chcesz usunąć wiersz?") == true) {
        $.ajax({
            type: "POST",
            url: "index.php?page=home&removePeopleID=" + id,
            success: function() {
                $(".toast-body").html("Wiersz został usunięty!");
                toastBootstrap.show();
                fetchRows();
            }
        });
    }
}

// function addRow() {
//     let form = document.getElementById('form');
//     let vorname = form.querySelector('input[name=imie]').value;
//     let name = form.querySelector('input[name=nazwisko]').value;
//     let adress = form.querySelector('input[name=adres]').value;
//     let email = form.querySelector('input[name=email]').value;
//     let id = form.querySelector('input[name=id]').value;
//     let post = "&id="+id+"&imie="+vorname+"&nazwisko="+name+"&adres="+adress+"&email="+email;
//     var xhttp = new XMLHttpRequest();
//     xhttp.open("POST", "index.php?addPeople=1", true);
//     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhttp.send(post);
//     xhttp.onload = function() {
//         fetchRows();
//     }
// }

function addRow() {
    let vorname = $("#imie").val();
    let name = $("#nazwisko").val();
    let adress = $("#adres").val();
    let email = $("#email").val();
    let id = $("#id").val();
    let post = "&id="+id+"&imie="+vorname+"&nazwisko="+name+"&adres="+adress+"&email="+email;
    $("button:contains('Edytuj JS')").on('click', () => {
        $(".toast-body").html("Wiersz został edytowany!");
        toastBootstrap.show();
        $("#h3").html("Formularz");
        $("#addbtn").html("Wyślij");
        $("#addbtnjs").html("Wyślij JS");
    })
    $.ajax({
        type: "POST",
        url: "index.php?addPeople=1",
        data: post,
        success: function() {
            fetchRows(true);
            $("#form")[0].reset();
            setTimeout(function() {
                $('tr:last').removeClass('d-none',);
                $('tr:last').addClass('fade-in-row');
            }, 100);
        }
    });
}


// function editRow(id) {
//     let newh3 = "Formularz edycji";
//     let newbutton1 = "Edytuj";
//     let newbutton2 = "Edytuj JS";
//     document.querySelector("#h3").innerHTML = newh3;
//     document.querySelector("#addbtn").innerHTML = newbutton1;
//     document.querySelector("#addbtnjs").innerHTML = newbutton2;
//     var xhttp = new XMLHttpRequest();
//     xhttp.open("GET", "index.php?page=home&editPeopleIDJS="+id, true);
//     xhttp.send();
//     xhttp.onload = function() {
//         let response = JSON.parse(xhttp.responseText);
//         let form = document.getElementById('form');
//         form.querySelector('input[name=id]').value = response.id;
//         form.querySelector('input[name=imie]').value = response.imie;
//         form.querySelector('input[name=nazwisko]').value = response.nazwisko;
//         form.querySelector('input[name=adres]').value = response.adres;
//         form.querySelector('input[name=email]').value = response.email;
//     }
// }

function editRow(id) {
    $.ajax({
        type: "GET",
        url: "index.php?page=home&editPeopleIDJS="+id,
        success: function(response) {
            let response1 = JSON.parse(response);
            $("#h3").html("Formularz edycji");
            $("#addbtn").html("Edytuj");
            $("#addbtnjs").html("Edytuj JS");
            $("#id").val(response1.id);
            $("#imie").val(response1.imie);
            $("#nazwisko").val(response1.nazwisko);
            $("#adres").val(response1.adres);
            $("#email").val(response1.email);
        }
    });
}

function updateTable(rows, hideLast=false) {
    // rows.forEach(row => {
    //     let element =`<tr>
    //                     <td>${row.id}</td>
    //                     <td>${row.imie}</td>
    //                     <td>${row.nazwisko}</td>
    //                     <td>${row.adres}</td>
    //                     <td>${row.email}</td>
    //                     <td>
    //                         <a href="index.php?page=home&removePeopleID=${row.id}">Usuń</a>
    //                         <a href="index.php?page=home&editPeopleID=${row.id}">Edytuj</a>
    //                         <button class="btn btn-primary" onclick="deleteRow(${row.id})">Usuń</button>
    //                         <button class="btn btn-primary" onclick="editRow(${row.id}">Edytuj</button>
    //                     </td>
    //                 </tr>`;
    //     html += element;
    // });
    //document.querySelector("#tbody").innerHTML = rows;
    if(hideLast) {
        let newrows = $('<tbody>'+rows+'</tbody>');
        let tr = $(newrows).find('tr').last();
        $(tr).addClass('d-none');
        $("#tbody").html(newrows.html());
    }
    else {
        $("#tbody").html(rows);
    }
}

// function fetchRows() {
//     var xhttp = new XMLHttpRequest();
//         xhttp.open("POST", "index.php?page=home&listPeople=1" , true);
//         xhttp.onreadystatechange = ()=>{
//             if(xhttp.readyState===4) {
//                 if(xhttp.status===200) {
//                     response = xhttp.responseText;
//                     updateTable(response);
//                 }
//             }
//         }
//         xhttp.send();
// }

function fetchRows(hideLast=false) {
    $.ajax({
        type: "POST",
        url: "index.php?page=home&listPeople=1",
        success: function(response) {
            updateTable(response, hideLast);
        }
    });
}

$('.sort').each(function() {
    let count = 0;
    const icon = $(this).find('.fa');
    $(this).click(function() {
        console.log(count);
        count++;
        if (count % 3 === 1) icon.removeClass().addClass('fas fa-chevron-up');
        else if (count % 3 === 2) icon.removeClass().addClass('fas fa-chevron-down');
        else {
            icon.removeClass();
        }
    });
});

function sort(event) {
    let target = event.target;
    let data = {};
    let dataOrder = $(target).attr('data-order');
    if (dataOrder == '') dataOrder = 'ASC';
    else if (dataOrder == 'ASC') dataOrder ="DESC";
    else dataOrder = '';
    $(target).attr('data-order', dataOrder);
    $("th[data-order]").each(function() {
        let name = $(this).attr('name');
        dataOrder = $(this).attr('data-order');
        data[name] = dataOrder;
    });
    $.ajax({
        type: "POST",
        url: "index.php?page=home&allPeople=1",
        data: {order: data},
        success: function(response) {
            updateTable(response);
        }
    });
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function generateSnow() {
    for(let i=1; i<=100; i++) {
        var img = new Image();
        img.src = 'assets/platek.png';
        img.width = 100;
        img.height = 75;
        img.style.position = 'absolute';
        let platek = {
            x: getRandomInt(0, window.innerWidth - img.width),
            y: -getRandomInt(100, window.innerHeight - img.height),
            z: getRandomInt(0, 10),
            dx: getRandomInt(-1, 1),
            dy: getRandomInt(1, 5),
            img: img
        }
        img.style.left = platek.x + 'px';
        img.style.top = platek.y + 'px';
        img.style.zIndex = platek.z;
        img.style.pointerEvents = 'none';
        stars.push(platek); 
        document.body.appendChild(img);
    }
}

var stars = [];
let isActive = true;
function toggle() {
    if (isActive) {
        generateSnow();
        anime = setInterval(wlacz, 10);
        document.getElementById('wlacz').innerHTML= 'Wyłącz śnieg';
    }
    else {
        clearInterval(anime);
        stars.forEach(platek => {
            document.body.removeChild(platek.img);
        });
        stars = [];
        document.getElementById('wlacz').innerHTML= 'Włącz śnieg';
    }
    isActive = !isActive;
}

let p = $(".container").offset()

function wlacz() {
    stars.forEach( (platek, index) => {
        let y = platek.y;
        let x = platek.x;
        let z = platek.z;
        y += platek.dy;
        x += platek.dx;
        platek.img.style.left = x + 'px';
        platek.img.style.top = y + 'px';
        if(y > window.innerHeight) {
            x = getRandomInt(0, window.innerWidth - platek.img.width);
            y = -getRandomInt(0, window.innerHeight - platek.img.height);
        }
        // if (y > p.top - platek.img.height && x > p.left - platek.img.width && x < (p.left + 1320) && z >= 8) {
        //     x = getRandomInt(0, window.innerWidth - platek.img.width);
        //     y = -getRandomInt(0, window.innerHeight - platek.img.height);
        // }        
        platek.x = x;
        platek.y = y;
    });
}



console.log('dziala');