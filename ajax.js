<script>
// ketika tombol View Details ditekan
$('#cutomerDetailsModal').on('show.bs.modal', function (event) {
    
    var button = $(event.relatedTarget); // tombol yang men-trigger modal
    
    // Ambil data dari tombol
    var lokomotif = button.data('lokomotif');
    var depo = button.data('depo');
    var sifat = button.data('sifat');
    var tgl_selesai = button.data('tgl_selesai');

    // Masukkan data ke modal
    var modal = $(this);
    modal.find('#lokomotif').text(lokomotif);
    modal.find('#id_depo').text(depo);
    modal.find('#sifat').text(sifat);
    modal.find('#tgl_selesai').text(tgl_selesai);

    
});
</script>
