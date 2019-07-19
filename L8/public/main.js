function addItem(id) {
    $.ajax({
        type: "POST",
        url: `?id=${id}&pages=cart&func=addItem`,
        success: function (date) {
            $("#quantity").html(date);
        }
    })
}

