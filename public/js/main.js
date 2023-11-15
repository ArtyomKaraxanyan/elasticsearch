 $(document).on('click','.search',function (e){
        e.preventDefault();
        let value=$('.form-search').val();
        let url=$('.search-form').attr('action');
        $.ajax({
            url: url,
            method: 'GET',
            data:{q:value},
            success: function(data){
                $('.articles-content').html(data.view);
                $('.paginate').html(data.paginate);
                $('.articles-count-content').html('('+data.count+')');
            }
        });

    }).on("click",".paginate .pagination .page-item a",function(event){
        event.preventDefault();
        var url = $(this).attr("href");
        var value=$('.form-search').val();
        var append = url.indexOf("?") == -1 ? "?" : "&"+'q='+value;
        var finalURL = url + append + $("#pagination_data").serialize();
        window.history.pushState({}, null, finalURL.slice(0,-1));
        $.get(finalURL, function(data) {
            $('.articles-content').html(data.view);
            $('.paginate').html(data.paginate);
            $('.articles-count-content').html('('+data.count+')');
            window.scrollTo(0,0);
        });
        return false;
    })


