/*******************************************************************************
 * This JavaScript is Created by Eng'r Nolan Sunico 
 * to implement functionalities for Top Level Management module 
 * Inventory Submodule a part of OneLab Project nationwide
 * @DateTimeCreated November 2, 2017 11:19 AM
 */
$(document).ready(
    $("#chkItemAmount").on('change', function(e) {
       var val=this.checked;
       $("#ItemAmount").val(val ? 1:0);
       $("#formIncome").submit();
    }),
    $(".item-amount").change(function(){
        //alert(this.value);
        switch(this.value){
            case 'Item':
                $("#IsAmount").val(0);
                break;
                
            case 'Amount':
                $("#IsAmount").val(1);
                break;
        }
        $("#formIncome").submit();
    }),
    $(".quantity").change(function(){
        alert(this.value);
        switch(this.value){
            case "OnHand":
                $("#IsOnHand").val(1);
                break;
            case "Used":
                $("#IsOnHand").val(0);
                break;
        }
        $("#formIncome").submit();
    })
);