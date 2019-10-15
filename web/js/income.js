$(document).ready(function(){
    $('#formIncome').on('beforeSubmit', function (event, jqXHR, settings) {
        var form = $(this);
        if (form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function (data) {
                 $Y1=$("#fYear").val();
                 $Y2=$("#fYear2").val();
                 //alert($Y2>=$Y1);
                 return ($Y2>=$Y1);
            }
        });
    return false;
    })
});
function Download(url) {
    document.getElementById('my_iframe').src = url;
};
function ExportToExcel(){
    $("#progress-div").show();
    $.ajax({
        url: "/toplevel/ajax/statistics",
        type: 'post',
        data: {
            type: 'Income',
            RegionID: $("#RegionID").val(),
            AgencyID: $("#AgencyID").val(),
            fYear:  $("#fYear").val(),
            fYear2: $("#fYear2").val(),
            LabID: $("#LabID").val(),
            PaymentTypeID: $("#PaymentTypeID").val(),
            ReferralTypeAmount: $("#ReferralTypeAmount").val(),
            FeeTypeID: $("#FeeTypeID").val()
        },
        success: function (url) {
            alert("Export Is Successful!");
            console.log(url);
            Download(url);
            $("#progress-div").hide();
            return true;
        }
    });
}