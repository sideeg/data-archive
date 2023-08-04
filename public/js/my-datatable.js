var APP_URL = window.location.origin + "/";

$(document).ready(function() {
 
    let tables = {
        orders: [
            "id", 
            "pation_name",
            "phone",
            "prescription_photo",
            "medicine_name",
            "insurance",
            "insurance_card_photo",
            "status",
            "created_at",
            "view",
            "edit"
        ],
    };

    for (var table in tables) {
        let columns = [];
        tables[table].forEach(col => {
            if (col == "view" || col == "edit")
                columns.push({
                    data: col,
                    name: col,
                    orderable: false,
                    searchable: false
                });
            else columns.push({ data: col, name: col });
        });

        $(`#data-table-${table}`).DataTable({
            processing: true,
            paging: true,
            ajax: {
                url: APP_URL + `${table}/index/data`,
                type: "GET",
                data:
                    table == "orders" 
                        ? function(d) {
                              let e = document.getElementById("status");
                              if (e) d.status = e.options[e.selectedIndex].value;
                          }
                        : {}
            },
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            columns,
          
        });
    }

    $(".order_status").change(function() {
        $("#data-table-orders")
            .DataTable()
            .ajax.reload();
    });

});
