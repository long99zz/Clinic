<script type="text/javascript">
    // Sử dụng delegation để gán sự kiện cho các nút edit
    $(document).on('click', '.edit-appointment', function() {
        // Lấy dữ liệu từ thuộc tính data-info và tách chúng thành mảng
        var details = $(this).data('info').split(',');
        fillmodalData(details);
        // Hiển thị modal edit
        $('#editAppointment').modal('show');
    });

    // Hàm điền dữ liệu vào modal
    function fillmodalData(details) {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#description').val(details[2]);
        $('#time').val(details[3]);
        $('#doctor_id').val(details[4]);
        $('#patient_id').val(details[5]);
        $('#date').val(details[6]);
    }
</script>