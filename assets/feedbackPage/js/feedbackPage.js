//сделать скриншот
$('#screenshot').click(function () {

    /*html2canvas($('.h-100')[0]).then((canvas) => {
        document.body.appendChild(canvas);
        console.log("done ... ");
        $('#out_image').append(canvas);
    });*/

    html2canvas(document.body).then(function(canvas) {
        document.body.appendChild(canvas);
    });

});


/*html2canvas($('.canvas'), {
    //width: document.documentElement.clientWidth,
    //height: document.documentElement.clientHeight,
    onrendered: function(canvas) {
        var myImage = canvas.toDataURL();
        window.open(myImage);
    }
});*/

//делаем скрин
/*function screenShot() {
    var myImage = canvas.toDataURL();
    window.open(myImage);*/
    /*var canvas = $('canvas')[0];
    var data = canvas.toDataURL('image/png').replace(/data:image\/png;base64,/, '');
    $('canvas').remove();
    $.post('/site/feedback', {data: data}, function (rep) {
        alert('Изображение ' + rep + ' сохранено');
    });*/
/*}*/


