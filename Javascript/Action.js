<script src="./sweetalert.min"></script>

        function confirmDelete(event) {
            event.preventDefault(); // Prevent the default form submission
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById("deleteForm").submit(); // Submit the form if confirmed
                } else {
                    swal("Your data is safe!");
                }
            });
        }

        function save() {
            var save = document.getElementById('saveForm');
            save.style.display = "none";
        }