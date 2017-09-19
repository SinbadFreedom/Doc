/**
 * Created by Lijianhua on 2015/9/18.
 * @email ljhdhr@gmail.com
 */

function outputHeader() {
    var url = $("#string_input").val();
    $.ajax({
        url: 'outputHeader.php?url=' + $("#string_input").val(),
        success: function (data, status) {
            $("#string_output").text(data);
        }
    });
}