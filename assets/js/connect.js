$(document).ready(function () {
    $('#connect').on('click', async function (e) {
        e.preventDefault();

        const wax = new waxjs.WaxJS({
            rpcEndpoint: 'https://wax.greymass.com'
        });

        wax.isAutoLoginAvailable();

        let userAccount = await wax.login();

        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            data: {'userAccount': userAccount},
            success: function () {
                window.location.href = 'http://127.0.0.1:8000/user/login?userAccount=' + userAccount
            },
            error: function (data) {
                console.log(data)
            }
        });
    });
})