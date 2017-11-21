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
        if (e.length > 0) {
            e.removeClass('btn-default').addClass('btn-primary');
        }

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

        $

        $('.uservel-permissions').on('click', '.assign,.revoke', function (e) {
            $this = $(this);

            var type = $this.attr('data-uservel-role') ? 'role' : 'perm';
            var action = $this.hasClass('assign') ? 'assign' : 'revoke';

            if (action === 'assign') {
                var oposite = 'revoke';
                var remove = action + ' btn-primary';
                var add = oposite + ' btn-warning';
            } else {
                var oposite = 'assign';
                var remove = action + ' btn-warning';
                var add = oposite + ' btn-primary';
            }
            var val = action === 'assign' ? $this.attr('data-uservel-' + type) : '';
            var appendTo = '.' + action + '-' + type + 's-group';

            $this.removeClass(remove)
                .addClass(add)
                .text(oposite.charAt(0).toUpperCase() + oposite.slice(1).toLowerCase())
                .parent().appendTo(appendTo)
                .find('input').attr('name', 'roles[]').val(val);
        });
    })
</script>