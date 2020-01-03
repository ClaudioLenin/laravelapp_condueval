$(document).ready(function () {
    $('#contenido-1').hide();
    $('#contenido-2').hide();
    $('#contenido-3').hide();
    $('#contenido-4').hide();
    $('#collapsible-panels a').click(function (e) {
        $(this).parent().next('#collapsible-panels div').slideToggle('fast');
        $(this).parent().toggleClass('active');
        //e.preventDefault();
    });

});
