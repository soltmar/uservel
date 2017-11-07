<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('.user-nav').find('a[href="'+window.location.href+'"]').removeClass('btn-default').addClass('btn-primary');

        $('.uservel .delete').on('click', function (e) {
            e.preventDefault();
            if (confirm('Do you really want to delete this user?')) {
                var link = this.href;
                $.ajax({
                    method: 'DELETE',
                    url: link
                })
                    .done(function () {
                        location.reload();
                    });
            }
        });
    })
</script>