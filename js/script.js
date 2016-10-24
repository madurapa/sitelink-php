$(document).ready(function () {
    //http://bootsnipp.com/snippets/featured/easy-table-filter
    $('.btn-filter').on('click', function () {
        $('.btn-filter').removeClass('disabled');
        var all = $(this).data('all');
        var sizefrom = parseInt($(this).data('sizefrom'));
        var sizeto = parseInt($(this).data('sizeto'));
        if (all != 'all') {
            $('.table tbody tr').css('display', 'none');
            var table = $("#mprDetailDataTable tbody");
            table.find('tr').each(function (i, el) {
                var size = parseInt($(this).data('size'));
                if (sizeto == 300 && sizefrom <= size) {
                    $(this).fadeIn('slow');
                } else if (sizefrom <= size && sizeto >= size) {
                    $(this).fadeIn('slow');
                }
            });
        } else {
            $('.table tbody tr').css('display', 'none').fadeIn('slow');
        }
        $(this).addClass('disabled');
    });

    $('#rental-date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '1d'
    }).on("changeDate", function () {
        $("input[name='date']").val($(this).datepicker('getFormattedDate'));
    });

});