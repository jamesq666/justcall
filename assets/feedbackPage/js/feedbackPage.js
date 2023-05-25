$('#screenshot').click(function () {
    $(this).css("display", "none");

    addFormDiv();

    html2canvas(document.body).then(function (canvas) {
        let data = canvas.toDataURL('image/png');
        $('#screenshot_img').attr('src', data);
    });

    getIp();

    $('#feedback').append($form_div);
});

$('#feedback').on('click', '.send', function (e) {
    e.preventDefault();

    let comment = $('#comment').val();

    if (comment.length < 1) {
        $('#comment').css({'border': '1px solid red'})
    } else {
        $('#comment').css({'border': ''})
    }

    let time = $('#time_stamp').val();
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
        success: function (data) {
            if (data == true) {
                alert('Comment sent');
                location.reload();
            } else {
                alert('Comment not sent');
                location.reload();
            }
        }
    });
});

function addFormDiv() {
    $form_div = $('<div id="form_div"></div>');
    $form = $('<form></form>');
    $form.append('<img id="screenshot_img" width="1000" height="500" style="margin: 10px 0">');
    $form.append('<br>');
    $form.append('<label for="comment">Комментарий <span style="color: red">*</span></label>');
    $form.append('<br>');
    $form.append('<textarea id="comment" rows="5" cols="133" maxlength="2000" style="resize: none" required></textarea>');
    $form.append('<br>');
    $form.append('<label>Текущее время</label>');
    $form.append('<input id="time_stamp" type="hidden" value="' + getCurTime().getTime() + '">');
    $form.append('<input id="time" type="text" style="margin: 10px" value="' + getCurTime().getHours() + ':' + getCurTime().getMinutes() + '" disabled>');
    $form.append('<label style="margin: 10px">Ваш ip-адрес</label>');
    $form.append('<input id="ip" type="text" disabled>');
    $form.append('<br>');
    $form.append('<input type="button" class="btn btn-primary send" value="Отправить">');
    $form_div.append($form);
}

function getCurTime() {
    return new Date();
}

//найдено на просторах интернета
function getIp() {
    fetch('https://ipapi.co/json/')
        .then(d => d.json())
        .then(d => $('#ip').val(d.ip));
}

$('#feedback').on('blur', '#comment', function () {
    if ($(this).val().length > 1) {
        $('#comment').css({'border': ''})
    } else {
        $('#comment').css({'border': '1px solid red'})
    }
});
