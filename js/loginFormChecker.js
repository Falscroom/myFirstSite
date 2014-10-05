function checkForm() {
    var login = $('#login');
    var pass = $('#pass');

    if(!checkLogin()) {
        login.css({boxShadow:"0 0 20px rgba(217, 0, 0, 1)"});
        pass.css({boxShadow:"0 0 20px rgba(217, 0, 0, 1)"});
        return false;
    }
        return true;
}
function checkLogin() {
    var result = true;
    var login = $('#login');
    var pass = $('#pass');
    var strLogin = login.val();
    var strPass = pass.val();

    $.ajax({
        type : "POST",
        url: "checkPass.php",
        async: false, // Браузер будет подвисать на время выполнения запроса!
        data : {'l':strLogin,'p':strPass},// указываем URL и
        success: function (data) { // вешаем свой обработчик на функцию success  // обрабатываем полученные данные
            result = !data;
        },
        error : function () {
            alert('Sorry, it does not work');
        }
    });
    return result;
}
$(document).ready(function() {
    $('#loginForm').submit(checkForm);
});