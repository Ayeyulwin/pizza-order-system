$(document).ready(function() {
    //when + button click
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = $parentNode.find('#price').text().replace("kyats", " ") * 1;
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " kyats");

        summaryCalculation();

    })

    $('.btn-minus').click(function() {
        //when - button click
        $parentNode = $(this).parents("tr");
        $price = $parentNode.find('#price').text().replace("kyats", " ") * 1;
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " kyats");

        summaryCalculation();
    })



    function summaryCalculation() {
        //total summary
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += $(row).find('#total').text().replace("kyats", " ") * 1;
        });

        $("#subTotalPrice").html($totalPrice + " kyats");
        $("#finalPrice").html($totalPrice + 3000 + " kyats");
    }
})