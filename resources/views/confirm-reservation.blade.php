<!-- resources/views/services/confirm-delete.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Suppression</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body onload="openConfirmationDialog();">

<script>
var id_user = {!! json_encode($id_client) !!}; // Ensure this contains the correct user ID

function openConfirmationDialog() {
    Swal.fire({
        title: 'Success!',
        text: "You have successfully booked a service! You will receive a confirmation email shortly.",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Notice the corrected route name here
            window.location.href = "{{ route('dashbordClient', ['id_user' => ':id_user']) }}".replace(':id_user', id_user);
        }
    });
}
</script>


</body>
</html>
