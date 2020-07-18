$(function () {
    $('#second').hide();
    $('#b2').hide();

    $('#b1').click(function () {
        $('#second').show(1000);
        $('#first').hide();
        $('#b2').show(1000);
        $('#b1').hide();

        $.ajax({
            url: 'http://localhost:81/20hectares.com/search/transaction/depot_retrait',
            method: 'POST',
            data: {code: 1},
            success: function (data) {
                $("#conf").html(data);
            }
        });

        
    });


    

    
});