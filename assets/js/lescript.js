$(function () {
    $("#addRowBtn").hide();
    $(".addRowBtn45").hide();
    $("#btncacher").click(function () {
        $(this).hide();
        $("#addRowBtn").show(1000);
        $(".addRowBtn45").show(1000);
    });



    $("#createProduit").unbind('submit').bind('submit', function () {

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
               
                $("#reset").click();

            } // /success
        }); // /ajax	

    }); // submit categories form function


    $(".decl").click(function () {
        var ref = $(this).attr("cont");
        $.ajax({
            url: "http://localhost:81/20hectares.com/controllers/app.php",
            type: "POST",
            data: {ref: ref},
            success: function (res) {
                $(".album").html(res);
                $('html, body').animate({scrollTop: $('.album').offset().top}, 'slow');
            }
        });
    });

    $(".confir").click(function () {
        var ref = $(this).attr("cont");
        $.ajax({
            url: "http://localhost:81/20hectares.com/controllers/app.php",
            type: "POST",
            data: {conf: ref},
            success: function (res) {
                //window.history.back();
                location.reload();
            }
        });
    });

    $(".trait").click(function () {
        var ref = $(this).attr("conte");
        $.ajax({
            url: "http://localhost:81/20hectares.com/controllers/app.php",
            type: "POST",
            data: {trait: ref},
            success: function (res) {
                //window.history.back();
                location.reload();
            }
        });
    });


    $(".paipai").click(function () {
        var Id = $(this).attr("der");

        if (Id) {
            $.ajax({
                url: "http://localhost:81/20hectares.com/controllers/app.php",
                type: "POST",
                data: {com: Id},
                dataType: "json",
                success: function (response) {
                    var m = Number(response.order[0][4]) - Number(response.order[0][5]);
                    $(".reste").val(m);
                    $(".commande").val(response.order[0][0]);
                    $(".paymentOrderModal").modal('show');
                } // /success
            }); // fetch order data
        } else {
            alert("Erreur ! Veuillez rafraîchir la page !");
        }
    });
});

function addRow() {
    $("#addRowBtn").button("loading");
    var tableLength = $(".roro .col-md-6").length;

    var tableRow;
    var arrayNumber;
    var count;

    if (tableLength > 0) {
        tableRow = $(".roro .col-md-6:last").attr('id');
        arrayNumber = $(".roro .col-md-6:last").attr('num');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        count = 1;
        arrayNumber = 0;
    }

    $("#addRowBtn").button("reset");
    var tr = '<div class="col-md-6" num="' + arrayNumber + '" id="row' + count + '">' +
            '<div class="form-group" id="image">' +
            '<label>Image :</label>' +
            '<div class="form-group form-inline">' +
            '<input type="file" class="form-control" name="sai_photo[]">' +
            '<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="fa fa-trash"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';

    if (tableLength > 0) {
        $(".roro .col-md-6:last").after(tr);
    } else {
        $(".roro").append(tr);
    }

}

function removeProductRow(row = null) {
    if (row) {
        $("#row" + row).remove();
    } else {
        alert('Erreur! Veuillez rafraîchir la page !');
}
}


function affformphoto(id = null) {
    if (id) {
        $("#formphoto" + id).toggle(500);
}

}
function chnagerphoto(id = null) {
    if (id) {
        var form = $("#formphoto" + id).serialize();
        var form_data = new FormData();
        var idr = $("#formphoto" + id + " #id").val();
        var fichier = $("#formphoto" + id + " #photor").prop('files')[0];
        form_data.append('file', fichier);
        form_data.append('ide', idr);
        $.ajax({
            url: "http://localhost:81/20hectares.com/controllers/appp.php",
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (res) {
                $(".album").html(res);
            }

        });
}

}
function suppphoto(id = null) {
    if (id) {
        $.ajax({
            url: "http://localhost:81/20hectares.com/controllers/app.php",
            type: "POST",
            data: {sup: id},
            success: function (res) {
                console.log("photo supprimée...");
                $(".album").html(res);
            }

        });
}

}