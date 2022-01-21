document.addEventListener('DOMContentLoaded', function() {
    $(document).ready(function() {
        $('#lugar_evento_ubicacion').on('change', function() {
            $.ajax({
                url: 'ajax_getSalas.php',
                method: 'POST',
                dataType: 'html',
                data: {
                    lugar_evento_ubicacion: $(this).val()
                },
                success: (data, textStatus) => {
                    $('#id_lugar_evento').html(data);
                },
            });
        });
    });
});