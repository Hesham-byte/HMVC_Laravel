<script>
    $(function() {
        //$('.delete').click(function(e) {
        $(document).on('click', '.delete', function(e) {

            e.preventDefault();

            Swal.fire({
                title: '{{__("main.delete")}}',
                text: "{{__('main.delete_this_row')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "{{__('main.no')}}",
                confirmButtonText: "{{__('main.yes')}}"
            }).then((result) => {
                if (result.isConfirmed) {

                    let url = $(this).attr('href');
                    var link = this;

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function() {
                            $(link).closest('tr').remove();
                            Swal.fire(
                                '{{__("main.deleted")}}',
                                '',
                                'success'
                            );
                        }
                    });

                }
            });

            // if (!confirm("{{__('main.delete_this_row')}}"))
            //     return false;

            // let url = $(this).attr('href');
            // var link = this;

            // $.ajax({
            //     url: url,
            //     type: 'DELETE',
            //     success: function() {

            //         $(link).closest('tr').remove();
            //     }
            // })

        });
    });

</script>
