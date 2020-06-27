$(document).ready(function(){

    $("#captcha").click(function(){
        $("#captcha").attr('src',"/captcha?id=" + Math.random());
    });
    $("#captcha_a").click(function(){
        $("#captcha").attr('src',"/captcha?id=" + Math.random());
    });
});