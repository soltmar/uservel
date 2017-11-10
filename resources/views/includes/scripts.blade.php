<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $('.uservel .alert').delay(3000).fadeOut('slow');

        var e = "";
        $('.user-nav').find('a').each(function () {
            var $a = $(this);
            if (window.location.href.includes($a.attr('href')) && $a.attr('href').length > e.length) {
                e = $a;
            }
        });
        e.removeClass('btn-default').addClass('btn-primary');

        $('.uservel .delete').on('click', function (e) {
            e.preventDefault();
            if (confirm('Do you really want to delete this item?')) {
                var link = this.href;
                $.ajax({
                    method: 'DELETE',
                    url: link,
                    async: false
                });
            }
        });
    })
</script>