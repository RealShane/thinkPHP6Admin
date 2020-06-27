function modaldemo(){
    console.log("ss");
    $("#modal-demo").modal("show")
}
function modalalertdemo() {
    $("body").Huimodalalert({
        content: '我是消息框，2秒后我自动滚蛋！',
        speed: 2000
    })
}