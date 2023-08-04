{{--jquery--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

{{--  Datatable  --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="{{URL::asset('/js/my-datatable.js') }}"></script>
{{-- <script src="https://gist.github.com/soufianeEL/3f8483f0f3dc9e3ec5d9.js"></script> --}}
<script>
    $(document).ready(function(){
        $("select.insurance_status").change(function(){
            var selectedStatus = $(this).children("option:selected").val();
            if(selectedStatus == "1") $('.insurance_input').show();
            else $('.insurance_input').hide();
        });


        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
    
        var x = $(".ques_card").length; //initlal text box count
        $(add_button).click(function(e) {
            //on add input button click
            e.preventDefault();
            x++; //text box increment
            $(wrapper).append(
                '</br><div id="ques_card_' +
                    x +
                    '" class="ques_card">' +
                    '<input class="form-control child" type="text" placeholder="اسم الجار" name="medicine_names[]" />' +
                    '<input type="text" placeholder=" الحهة التي يحدها" name="materials[]" class="form-control" dir="auto" />'+
                    '<input type="text" placeholder="اي معلومات اضافية عن الجار قد تكون مفيدة" name="companies[]" class="form-control" dir="auto" /><br>'+
                    '<button href="#" class="btn btn-danger remove_field">Remove</button></div>'
            ); //add input box
        });
    
        $(wrapper).on("click", ".remove_field", function(e) {
            //user click on remove text
            e.preventDefault();
            $(this)
                .parent("div")
                .remove();
            x--;
        });
    });
</script>
