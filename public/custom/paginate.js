(function ($) { 
 
    var filters = $('.filters');
    var colspan = $('tbody').find('tr').last().find('td').attr('colspan');
    var data = {};

    var colCount = 0;
    $('tr:nth-child(1) td').each(function () {
        if ($(this).attr('colspan')) {
            colCount += +$(this).attr('colspan');
        } else {
            colCount++;
        }
    });
    
     $(document).ready(function() {
        $(document).on('click', '.page-link',function(e)
        {
            e.preventDefault(); 
            $('li').removeClass('active');
            $(this).parent('li').addClass('active'); 
     
            var page    = $(this).attr('href').split('page=')[1];  
            //alert(page)
            search(page, page, baseUrl);
        });
    });

    /*search data as per keyword input & other filters*/
    function search(count, pagecount, controller) {
        data.search = "";
        data._token =  _token;
        filters.each(function (i, value) {
            $this = $(this);
            if ($this.val()) {
                data[$this.attr('name')] = $this.val();
            }
        });

        data.page = pagecount;
        $('#chkAll').prop("checked", false);

        $.post(baseUrl, data, function (data) {
            $('tbody').html(data);
            window.scrollTo(0, 0);
        });
    }

    filters.on('keyup', function (e) {
        e.preventDefault();
        var url = baseUrl;
        var query_str = '?xcel=1';

        filters.each(function (i, value) {
            $this           = $(this);
            data["_token"]  =  _token;
            data["page"]    =  1;
            data[$this.attr('name')] = $this.val();
            query_str += '&' + $this.attr('name') + '=' + $this.val();
        });

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            beforeSend: function (xhr, opts) {
                $('#tbody').html('<tr><td colspan="' + colspan + '"><center><b>Searching....</b></center></td><tr>');
            },
            success: function (data) {
                //console.log(data.total);
                if ($('#chkAll').length) { 
                    $('#chkAll').prop("checked", false);
                } 
                $('#tbody').html(data);
                $('.total').html($('#total').text());
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Oops ! there might be some problem, please try after some time');
            }
        })

    });

})(jQuery);



