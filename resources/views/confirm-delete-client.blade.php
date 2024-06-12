<!-- resources/views/clients/confirm-delete-client.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Suppression du Client</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body onload="openConfirmationDialog();">
    <form id="deleteForm" action="{{ route('delete-client', $client->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="deleteForm" action="{{ route('delete-client', $client->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function openConfirmationDialog() {
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous ne pourrez pas revenir en arrière!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimez-le!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        } else {
            window.location.href = "{{ route('adminclient') }}"; // Redirection vers la liste des clients
        }
    });
}
</script>
</body>
</html>
