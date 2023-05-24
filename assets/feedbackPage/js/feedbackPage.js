$('#screenshot').click(function () {
    $(this).css("display", "none");

    addImgDiv();

    html2canvas(document.body).then(function (canvas) {
        let data = canvas.toDataURL('image/png');
        $('#screenshot_img').attr('src', data);
        //document.body.appendChild(canvas);
        //var data = canvas.toDataURL('image/png').replace(/data:image\/png;base64,/, '');
        /*$.post({
            url: '/site/index',
            data: {
                data: data,
            },
        });*/
    });

    addFormDiv();
});

$('#feedback').on('click', '.send', function () {
    let comment = $('#comment').val();
    let time = $('#time').val();
    let ip = $('#ip').val();
    let image = $('#screenshot_img').attr('src');

    $.post({
        url: '/site/index',
        data: {
            'comment': comment,
            'time': time,
            'ip': ip,
            'image': image.replace(/data:image\/png;base64,/, ''),
        },
    });
});

function addImgDiv() {
    $img_div = $('<div id="img_div" style="margin: 10px 20px"></div>');
    $img_div.append('<img id="screenshot_img"  width="1000" height="500">');
    $('#feedback').append($img_div);
}

function addFormDiv() {
    $form_div = $('<div id="form_div" style="margin: 10px 20px"></div>');
    $form = $('<form></form>');
    $form.append('<label for="comment">Комментарий</label>');
    $form.append('<br>');
    $form.append('<textarea id="comment" rows="5" cols="133" maxlength="2000" style="resize: none" required ></textarea>');
    $form.append('<br>');

    let time = curDate();
    $form.append('<label>Текущее время</label>');
    $form.append('<input id="time" type="text" style="margin: 10px" value="' + time.getHours() + ':' + time.getMinutes() + '" disabled>');
    $form.append('<label style="margin: 10px">Ваш ip-адрес</label>');
    $form.append('<input id="ip" type="text" disabled>');
    getIp();

    $form.append('<br>');
    $form.append('<input type="button" class="btn btn-primary send" value="Отправить">');

    $form_div.append($form);
    $('#feedback').append($form_div);
}

function curDate() {
    return new Date();
}

//найдено на просторах интернета
function getIp() {
    fetch('https://ipapi.co/json/')
        .then(d => d.json())
        .then(d => $('#ip').val(d.ip));
}
