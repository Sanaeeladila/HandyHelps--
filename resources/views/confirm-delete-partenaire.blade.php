<!-- resources/views/confirm-delete-partenaire.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Suppression du partenaire</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body onload="openConfirmationDialog();">
    <form id="deleteForm" action="{{ route('delete-partenaire', $partenaire->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="deleteForm" action="{{ route('delete-partenaire', $partenaire->id) }}" method="POST" style="display: none;">
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
            window.location.href = "{{ route('dashbordadmin') }}"; // Redirection vers la liste des admin
        }
    });
}
</script>
</body>
</html>
